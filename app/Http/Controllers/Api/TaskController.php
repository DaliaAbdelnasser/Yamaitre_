<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\Lawyer;
use App\Models\Chat;
use App\Models\User;
use App\Models\Task;
use App\Models\Review;
use App\Models\Info;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{

    // show all tasks
    public function index()
    {
        $user_id = auth()->user()->id;
        $query = Task::query()->whereHas('user', function($q) use($user_id){
            $q->where('user_id', '!=', $user_id);
        });

        if( request()->filled('offset') ){
            $query->offset( request('offset') );
        }

        // By Applicants Count
        if( request()->filled('count') && request('count') <= 4 ){
            $query->where('applicants_count', '<', 5 );
        }
        
        if (request()->filled('count') && request('count') <=  10 && request('count') >=  5  ) {
            $query->where('applicants_count', '>', 5 )->where('applicants_count', '<', 10 );
        }

        if ( request()->filled('count') && request('count') >= 11 ) {
            $query->where('applicants_count', '>', 10 );
        }

        // By City
        if ( request()->filled('city') ) {
            $query->where('governorates', '=', request('city'));
        }

        // Order By
        if ( request()->filled('order_by') && request('order_by') == 'lowest price' ) {
            $query->orderBy('price', 'asc');
        }

        if ( request()->filled('order_by') && request('order_by') == 'highest price' ) {
            $query->orderBy('price', 'desc');
        }

        if ( request()->filled('order_by') && request('order_by') == 'newest' ) {
            $query->orderBy('created_at', 'desc');
        }

        if ( request()->filled('order_by') && request('order_by') == 'oldest' ) {
            $query->orderBy('created_at', 'asc');
        }

        $query->limit( request('limit') ?? 10 );
        
        $data['tasks'] = $query->orderBy('created_at', 'desc')->with('user.userable')->where('status', 'todo')->get();
    
        return response()->json($data);
    }
    
    //create a task
    public function store(Request $request)
    {
        $messages = $this->getMessages();
        $title = Validator::make($request->all(), ['title' => 'required'], $messages);

        if ($title->fails()) {
            return response([
                'success' => false,
                'type' => 'noTitleAdded',
                'errors'=>$title->errors()->first(),
            ], 422);
        }

        $titlemax = Validator::make($request->all(), ['title' => 'max:40'], $messages);

        if ($titlemax->fails()) {
            return response([
                'success' => false,
                'type' => 'exceededMaxTitleLength',
                'errors'=>$titlemax->errors()->first(),
            ], 422);
        }

        $titlemin = Validator::make($request->all(), ['title' => 'min:5'], $messages);

        if ($titlemin->fails()) {
            return response([
                'success' => false,
                'type' => 'exceededMinTitleLength',
                'errors'=>$titlemin->errors()->first(),
            ], 422);
        }

        $price = Validator::make($request->all(), ['price'  => 'required'], $messages);

        if ($price->fails()) {
            return response([
                'success' => false,
                'type' => 'noPriceAdded',
                'errors'=>$price->errors()->first(),
            ], 422);
        }

        $pricenum = Validator::make($request->all(), ['price'  => 'numeric'], $messages);

        if ($pricenum->fails()) {
            return response([
                'success' => false,
                'type' => 'priceNotInteger',
                'errors'=>$pricenum->errors()->first(),
            ], 422);
        }


        $date = Validator::make($request->all(), ['starting_date'=> 'required'], $messages);

        if ($date->fails()) {
            return response([
                'success' => false,
                'type' => 'noStartingDateAdded',
                'errors'=>$date->errors()->first(),
            ], 422);
        }

        $dateformat = Validator::make($request->all(), ['starting_date'=> 'date_format:Y-m-d'], $messages);

        if ($dateformat->fails()) {
            return response([
                'success' => false,
                'type' => 'incorrectDateFormat',
                'errors'=>$dateformat->errors()->first(),
            ], 422);
        }

        $court = Validator::make($request->all(), ['court' => 'required'], $messages);

        if ($court->fails()) {
            return response([
                'success' => false,
                'type' => 'noCourtAdded',
                'errors'=>$court->errors()->first(),
            ], 422);
        }

        $gov = Validator::make($request->all(), ['governorates' => 'required'], $messages);

        if ($gov->fails()) {
            return response([
                'success' => false,
                'type' => 'noGovernorateAdded',
                'errors'=>$gov->errors()->first(),
            ], 422);
        }

        $des = Validator::make($request->all(), ['description'  => 'required'], $messages);

        if ($des->fails()) {
            return response([
                'success' => false,
                'type' => 'noDescriptionAdded',
                'errors'=>$des->errors()->first(),
            ], 422);
        }

        $desmax = Validator::make($request->all(), ['description'  => 'max:1500'], $messages);

        if ($desmax->fails()) {
            return response([
                'success' => false,
                'type' => 'exceededMaxDescriptionLength',
                'errors'=>$desmax->errors()->first(),
            ], 422);
        }

        $desmin = Validator::make($request->all(), ['description' => 'min:5'], $messages);

        if ($desmin->fails()) {
            return response([
                'success' => false,
                'type' => 'exceededMinDescriptionLength',
                'errors'=>$desmin->errors()->first(),
            ], 422);
        }
    
        $user = auth()->user();

        if($user->userable_type == 'App\Models\Lawyer')
        {
            $lawyer = Lawyer::where('id', $user->userable->id)->first();
            
            if($lawyer->status == 0 )
            {

                return response()->json([
                    'success' => false,
                    'type' => "notActive",
                    'errors' => __('messages.lawyer_forbidden')], 403);  
            }

            // check accept terms 
            if($user->accept_terms < 2)
            {
                return response()->json([
                    'success' => false,
                    'type'    => "notAcceptedYet",
                    'message' => "مازلت لم توافق على شروط الخصوصية بعد",
                ], 422);
            }

            if($lawyer->status == 1 )
            {
                $task = Task::create($request->all());
                $task->status = 'todo';
                $task->save();
                $user->tasks()->attach($task->id);
                $msg = " قام ". $user->first_name ." بنشر مهمة عمل جديدة.";
               

                return response()->json([
                    'success' => true,
                    // 'message' => __('messages.create_task')
                    'message' =>  app('App\Http\Controllers\NotificationController')->sendNotificationToTopic('تم نشر مهمة جديدة', $msg, 'tasks', 'task', $task->id)
                ]);
            }

        }

        elseif($user->userable_type == 'App\Models\Client')
        {
            $client = Client::where('id', $user->userable_id)->first();
            
            // check accept terms 
            if($user->accept_terms < 2)
            {
                return response()->json([
                    'success' => false,
                    'type'    => "notAcceptedYet",
                    'message' => "مازلت لم توافق على شروط الخصوصية بعد",
                ], 422);
            }
            $task = Task::create($request->all());
            $task->status = 'todo';
            $task->save();
            $user->tasks()->attach($task->id);

            return response()->json([
                'success' => true,
                'message' => __('messages.create_client_task')]);
            
        }
    }

    public function update(Request $request, $id)
    {

        $messages = $this->getMessages();

        $titlemax = Validator::make($request->all(), ['title' => 'max:40'], $messages);

        if ($titlemax->fails()) {
            return response([
                'success' => false,
                'type' => 'exceededMaxTitleLength',
                'errors'=>$titlemax->errors()->first(),
            ], 422);
        }

        $titlemin = Validator::make($request->all(), ['title' => 'min:5'], $messages);

        if ($titlemin->fails()) {
            return response([
                'success' => false,
                'type' => 'exceededMinTitleLength',
                'errors'=>$titlemin->errors()->first(),
            ], 422);
        }

        $dateformat = Validator::make($request->all(), ['starting_date'=> 'date_format:Y-m-d'], $messages);

        if ($dateformat->fails()) {
            return response([
                'success' => false,
                'type' => 'incorrectDateFormat',
                'errors'=>$dateformat->errors()->first(),
            ], 422);
        }


        $desmax = Validator::make($request->all(), ['description'  => 'max:1500'], $messages);

        if ($desmax->fails()) {
            return response([
                'success' => false,
                'type' => 'exceededMaxDescriptionLength',
                'errors'=>$desmax->errors()->first(),
            ], 422);
        }

        $desmin = Validator::make($request->all(), ['description' => 'min:5'], $messages);

        if ($desmin->fails()) {
            return response([
                'success' => false,
                'type' => 'exceededMinDescriptionLength',
                'errors'=>$desmin->errors()->first(),
            ], 422);
        }
    

        $user = auth()->user();
        if($user->userable_type == 'App\Models\Lawyer')
        {
            $lawyer = Lawyer::where('id', $user->userable->id)->first();
            if($lawyer->status == 1){
                $user->tasks()->find($id)->update($request->all());
                return response([
                    'success' => true,
                    'message' =>__('messages.update_task')]);
            }
            else
            {
                return response()->json([
                    'success' => false,
                    'type' => "notActive",
                    'errors' => __('messages.lawyer_forbidden')], 403); 
            }
        }
        elseif($user->userable_type == 'App\Models\Client')
        {
            $client = Client::where('id', $user->userable->id)->first();
                $user->tasks()->find($id)->update($request->all());
                return response([
                    'success' => true,
                    'message' =>__('messages.update_task')]);
        }
    }

    public function show($id)
    {
        $task = Task::with('user.userable')->find($id);

        if($task->status != 'todo')
        {
            
            $chat = Chat::where(['reciever_id' => $task->assignedlawyers->first()->userable->id, 'sender_id' => $task->user->first()->id ])->first();
        }
        
        unset($task['assignedlawyers']);

        if(isset($chat)){
            return response()->json([
                'task' => $task,
                'chat' => $chat,
            ]);
        }else{
            return response()->json([
                'task' => $task,
            ]);
        }
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $user = auth()->user();
        if($user->userable_type == 'App\Models\Lawyer')
        {
            $lawyer = Lawyer::where('id', $user->userable->id)->first();
            if($lawyer->status == 1){
                $user->tasks()->detach($task);
                $task->delete();
                return response()->json([
                    'success' => true,
                    'message' => __('messages.delete_task')]);
            }
            else
            {
                return response()->json([
                    'success' => false,
                    'type' => "not allowed",
                    'errors' => __('messages.lawyer_forbidden')], 403); 
            }
        }
        elseif($user->userable_type == 'App\Models\Client')
        {
            $client = Client::where('id', $user->userable->id)->first();
            $user->tasks()->detach($task);
            $task->delete();
            return response()->json([
                'success' => true,
                'message' => __('messages.delete_task')]);
        }
    }
 
    // طلباتي من الغير 
    public function mytodoTasks()
    {
        
        $lawyer = auth()->user();
        $user_id = $lawyer->id;
        $query = Task::query();

        if( request()->filled('status') && request('status') == 'todo' ){
            $query->where('status', request('status'))->whereHas('user', function ($query) use($user_id){
                $query->where('user_id', '=' , $user_id);
            })->get();
        }

        elseif( request()->filled('status') ){
            $query->where('status', request('status'))->with('assignedlawyers.userable')->whereHas('assignedlawyers', function ($query) use($user_id){
                $query;
            })->get();
        }

        if( request()->filled('offset') ){
            $query->offset( request('offset') );
        }

        $query->limit( request('limit') ?? 10 );

        $tasks = $query->orderBy('created_at', 'DESC')->whereHas('user', function ($query) use($user_id){
            $query->where('user_id', '=' , $user_id);
        })->get();

        $data['tasks'] = $tasks;
        
        if(request('status') == 'inprogress')
        {
            $data['tasks'] = $tasks;
            foreach($data['tasks'] as $key => $task){
                $task->user[0]->chat = Chat::where([
                    ['reciever_id', $task->assignedlawyers[0]->pivot->user_id],
                    ['sender_id', $task->assignedlawyers[0]->pivot->assigner_id]
                    ])
                    ->orWhere([
                        ['reciever_id', $task->assignedlawyers[0]->pivot->assigner_id],
                        ['sender_id', $task->assignedlawyers[0]->pivot->user_id]
                    ])->get();
            }        
        }

        $data['fees'] = [
            'task_fees'  =>  Info::where('info_name', 'cash_in')->first()->info_value . "%",
            'refund_fees'=>  Info::where('info_name', 'refund')->first()->info_value . "%",
        ];


        return response()->json($data);

    }

    public function showSingle($id)
    {
        $user = auth()->user();
        $lawyer_id = $user->id;
        $task = Task::whereHas('user', function ($query) use($lawyer_id){
            $query->where('user_id', '=' , $lawyer_id);
        })->find($id);
        if($task != null)
        {
            if( $task->status == 'todo'){
                if($task->applicantlawyers->first() != null)
                {
                    foreach($task->applicantlawyers as $applicantlawyer)
                    {
                        $applicantlawyers = $applicantlawyer->userable;
                        $cost = $applicantlawyer->pivot->cost;
                    }
                }
            }
            else{
                if($task->assignedlawyers->first() != null)
                {
                    foreach($task->assignedlawyers as $assignlawyer)
                    {
                        $assignedlawyers = $assignlawyer->userable;
                        $chat = $user->chat->where('reciever_id', $assignlawyer->userable->id)->first();
                    }
                }

            }
            // return $chat;
        }
        else
        {
            return response()->json([
                'success' => false,
                'type' => "noAccess",
                'errors' => 'ليست من مهماتك، من فضلك أعد المحاولة'
            ], 403); 

        }

        $fees = [
            'task_fees'  =>  Info::where('info_name', 'cash_in')->first()->info_value . "%",
            'refund_fees'=>  Info::where('info_name', 'refund')->first()->info_value . "%",
        ];
      
        if(isset($chat)){
            return response()->json([
                'task' => $task,
                'chat' => $chat,
                'fees' => $fees,
            ]);
        }else{
            return response()->json([
                'task' => $task,
                'fees' => $fees,
            ]);
        }
       
    }


    // main lawyer make it completed
    public function completeTask(Request $request, $id)
    {

        $messages = $this->getMessages();
        $valrate = Validator::make($request->all(), ['rating' => 'required'], $messages);

        if ($valrate->fails()) {
            return response([
                'success' => false,
                'type' => 'noRatingAdded',
                'errors'=>$valrate->errors()->first(),
            ], 422);
        }
        $intrate = Validator::make($request->all(), ['rating' => 'numeric'], $messages);

        if ($intrate->fails()) {
            return response([
                'success' => false,
                'type' => 'notInteger',
                'errors'=>$intrate->errors()->first(),
            ], 422);
        }
        $rate = Validator::make($request->all(), ['rating' => 'numeric|between:1,5'], $messages);

        if ($rate->fails()) {
            return response([
                'success' => false,
                'type' => 'notBetween1And5',
                'errors'=>$rate->errors()->first(),
            ], 422);
        }

        $user = auth()->user();
        // $lawyer = Lawyer::where('id', $user->userable->id)->first();
        $user_id = $user->id;

        $task = Task::with('assignedlawyers.userable')->where('status', 'inreview')->whereHas('assignedlawyers', function ($query) use($user_id){
            $query->where('assigner_id', '=' , $user_id);
        })->find($id);
        
        if($task != null)
        {
            
            $lawyer_id = $task->assignedlawyers()->first()->userable->id;

            if($task->task_file != null)
            {
                $task->update(['status' => 'completed']);

                $review = Review::create([
                    'rating'    => $request->rating,
                    'lawyer_id' => $lawyer_id,
                ]);
                $assignedlawyer = Lawyer::where('id', $lawyer_id,)->first();
                $assignedlawyer->update(['rate' => Review::where('lawyer_id', $lawyer_id)->avg('rating') ]);
                $assignedlawyer->tasks_count += 1;
                $assignedlawyer->user->balance->balance += $task->assignedlawyers()->first()->pivot->cost;
                $assignedlawyer->user->balance->save();
                
                if($user->userable_type == 'App\Models\Lawyer')
                {
                    $msg = 'قام المحامي '. $user->first_name .' بإنهاء المهمة وتقييمك على تنفيذ المهمة ';
                }
                else
                {
                    $msg = 'قام الموكل '. $user->first_name .' بإنهاء المهمة وتقييمك على تنفيذ المهمة ';
                }
                app('App\Http\Controllers\NotificationController')->sendNotification($assignedlawyer->device_token, 'إنهاء مهمة عمل وتقييم المحامي', $msg, $user_id, $assignedlawyer->id, 'lawyer/others-tasks', 'completedTask', $task->id);

                return response()->json([
                    'success' => true,
                    'message' => __('messages.completed_success')]); 
            }

        }
        else
        {
            return response()->json([
                'success' => false,
                'type' => 'notAllowedToCompleted',
                'message' => 'هذه المهمة ليست متاحة للاكتمال',
            ]); 
        }
        
    }

    // invite lawyer to take a specific task
    public function recommendedTask(Request $request, $id)
    {
        $messages = $this->getMessages();
        
        $valid = Validator::make($request->all(), ['id'  => 'required'], $messages);

        if ($valid->fails()) {
            return response([
                'success' => false,
                'type' => 'noTaskIdAdded',
                'errors'=>$valid->errors()->first(),
            ], 422);
        }


        $idexist = Validator::make($request->all(), ['id'  => 'exists:tasks,id'], $messages);

        if ($idexist->fails()) {
            return response([
                'success' => false,
                'type' => 'notExistInTasks',
                'errors'=>$idexist->errors()->first(),
            ], 422);
        }

        $user = auth()->user();
        if($user->userable_type == 'App\Models\Lawyer')
        {
            $lawyer = Lawyer::where('id', $user->userable->id)->first();
            if($lawyer->status == 1)
            {
                // find the task by its id
                $task = $user->tasks()->find($request->id);
                $Invitedlawyer = User::find($id);

                if($Invitedlawyer->invitedtasks()->find($request->id) != null)
                {
                    return response([
                        'success' => false,
                        'type' => 'repeatedInvitation',
                        'errors'=> 'لقد تم إرسال هذه الدعوة من قبل',
                    ], 422);
                }
                $Invitedlawyer->invitedtasks()->attach($request->id);
                $user->recommendedtasks()->attach($request->id);

                $msg = 'قام '. $user->first_name .' بدعوتك لمهمة العمل '.$task->title.' للعمل على تنفيذها ';
                app('App\Http\Controllers\NotificationController')->sendNotification($Invitedlawyer->device_token,'دعوة لتنفيذ مهمة عمل', $msg, $user->id, $Invitedlawyer->id, 'lawyer/offers-tasks', 'invitedTask', $task->id);

                return response()->json([
                    'success' => true,
                    'message' => __('messages.recommended_success')]); 
            }
            else
            {
                return response()->json([
                    'success' => false,
                    'type' => "notActive",
                    'errors' => __('messages.lawyer_forbidden')], 403); 
            }
        }  
        else
        {
            $task = $user->tasks()->find($request->id);
            $Invitedlawyer = User::find($id);
    
            if($Invitedlawyer->invitedtasks()->find($request->id) != null)
            {
                return response([
                    'success' => false,
                    'type' => 'repeatedInvitation',
                    'errors'=> 'لقد تم إرسال هذه الدعوة من قبل',
                ], 422);
            }
            $Invitedlawyer->invitedtasks()->attach($request->id);
            $user->recommendedtasks()->attach($request->id);
            
            $msg = 'قام '. $user->first_name .' بدعوتك لمهمة العمل '.$task->title.' للعمل على تنفيذها ';
            app('App\Http\Controllers\NotificationController')->sendNotification($Invitedlawyer->device_token,'دعوة لتنفيذ مهمة عمل', $msg, $user->id, $Invitedlawyer->id, 'lawyer/offers-tasks', 'invitedTask', $task->id);

            return response()->json([
                'success' => true,
                'message' => __('messages.recommended_success')]); 
        }
    }

     //  عروض مقدمة م الغير
     public function invitedTasks()
     {
        $user = auth()->user();   
        // $lawyer= Lawyer::where('id', $user->userable->id)->first();
        $user_id =  $user->id;

        $query1 = Task::query();

        if( request()->filled('offset') ){
            $query1->offset( request('offset') );
        }

        $query1->limit( request('limit') ?? 10 );
        $data['tasks'] = $query1->with('recommenderlawyers.userable')->orderBy('created_at', 'desc')->whereHas('invitedlawyers.userable', function ($query) use($user_id){
            $query->where('user_id', '=' , $user_id);
        })->get();

        return response()->json($data);
     }
     
    
    ////////////////////////////////////////// Others Tasks ///////////////////////////////////////////

    //  مهام لحساب الغير
    public function appliedTasks()
    {
        // $user = auth()->user();
        // $lawyer = Lawyer::where('id', $user->userable->id)->first();
        // $tasks = $lawyer->appliedtasks()->with('lawyers.user')->get();
        
        // return response()->json([
        //     'applied tasks' => $tasks]);

        $user = auth()->user();
        $user_id = $user->id;
        $query = Task::query();
        

        if( request()->filled('status') && request('status') == 'todo' ){
            $query->where('status', request('status'))->with('user.userable')->whereHas('applicantlawyers', function ($query) use($user_id){
                $query->where('user_id', '=' , $user_id);
            })->get();
        }

        elseif( request()->filled('status') ){
            $query->where('status', request('status'))->with('user.userable')->whereHas('applicantlawyers', function ($query) use($user_id){
                $query->where('user_id', '=' , $user_id);
            })->get();
        }

        // if( request()->filled('status') && request('status') == 'todo' ){
        //     $query->where('status', request('status'))->whereHas('user', function ($query) use($user_id){
        //         $query->where('user_id', '=' , $user_id);
        //     })->get();
        // }

        // elseif( request()->filled('status') ){
        //     $query->where('status', request('status'))->with('assignedlawyers.userable', 'user.chat')->whereHas('assignedlawyers', function ($query) use($user_id){
        //         $query;
        //     })->get();
        // }

        if( request()->filled('offset') ){
            $query->offset( request('offset') );
        }

        $query->limit( request('limit') ?? 10 );

        $tasks = $query->orderBy('created_at', 'desc')->get();
        $data['tasks'] = $tasks;

        if(request('status') == 'inprogress')
        {
            $data['tasks'] = $query->orderBy('created_at', 'desc')->get();
            foreach($data['tasks'] as $key => $task){
                $task->user[0]->chat = Chat::where([
                    ['reciever_id', $task->assignedlawyers[0]->pivot->user_id],
                    ['sender_id', $task->assignedlawyers[0]->pivot->assigner_id]
                ])
                ->orWhere([
                    ['reciever_id', $task->assignedlawyers[0]->pivot->assigner_id],
                    ['sender_id', $task->assignedlawyers[0]->pivot->user_id]
                ])->get();
                // $task->user[0]->chat = str_replace(array('[',']'), '', $chat_list);
            }        
        }

        

        return response()->json($data);

    }

    // apply for a task - Done
    public function applyFor(Request $request, $id)
    {
        // choose a task by its id
        $task = Task::with('user')->find($id);
        
        // check if it's a todo task 
        if($task->status == 'todo'){
            $user = auth()->user();
            $messages = $this->getMessages();
            $valcost = Validator::make($request->all(), ['cost' => 'required'], $messages);

            if ($valcost->fails()) {
                return response([
                    'success' => false,
                    'type' => 'noCostAdded',
                    'errors'=>$valcost->errors()->first(),
                ], 422);
            }

            $pricenum = Validator::make($request->all(), ['cost'  => 'numeric'], $messages);
    
            if ($pricenum->fails()) {
                return response([
                    'success' => false,
                    'type' => 'priceNotInteger',
                    'errors'=>$pricenum->errors()->first(),
                ], 422);
            }
            // check accept terms 
            if($user->accept_terms < 2)
            {
                return response()->json([
                    'success' => false,
                    'type'    => "notAcceptedYet",
                    'message' => "مازلت لم توافق على شروط الخصوصية بعد",
                ], 422);
            }

            if($user->userable_type == 'App\Models\Lawyer')
            {
                // $lawyer = Lawyer::where('id', $user->userable->id)->first();
                // $lawyer = $user->id;

                // return $user->userable;

                if($user->userable->status == 1)
                {
                    if($user->appliedtasks()->where('task_id', $id)->first() == null)
                    {
                        $task->applicants_count += 1;
                        $task->save();
                        $user->appliedtasks()->attach($id, array('cost' => $request->cost));
                        $msg = 'قام '. $user->first_name .' بالتقدم لتنفيذ مهمة العمل ' . $task->title . ' ';
                        if($task->user[0]->userable_type == 'App\Models\Lawyer')
                        {
                            $url = 'lawyer/tasks'.$task->id;
                        }
                        else
                        {
                            $url = 'client/tasks/'.$task->id;
                        }
                        app('App\Http\Controllers\NotificationController')->sendNotification($task->user[0]->device_token, 'التقدم لتنفيذ مهمة عمل', $msg, $user->id, $task->user[0]->id,  $url, 'myTodoTask', $task->id);
                        
                        return response([
                            'success' => true,
                            'message' =>__('messages.task_pending'),
                        ]);

                    }
                    else
                    {
                        return response()->json([
                            'success' => false,
                            'type' => "alreadyAppliedBefore",
                            'errors' => __('messages.task_applied')], 403);
                    }
                }
                else
                {
                    return response()->json([
                        'success' => false,
                        'type' => "notActive",
                        'errors' => __('messages.lawyer_forbidden')], 403); 
                }
            }
        }
    }


    public function refuseInvitation($id)
    {
       $user = auth()->user();   
       $task = $user->invitedtasks()->find($id);
       $recommender = Task::find($id)->recommenderlawyers[0];
        // $task->delete();

        DB::beginTransaction();
        DB::table('invited_task')->where('task_id', $task->id)->delete();
        DB::commit();

        $msg = 'قام المحامي '. $user->first_name .' برفض دعوتك المرسلة لتنفيذ المهمة ';
        app('App\Http\Controllers\NotificationController')->sendNotification($recommender->device_token,'رفض الدعوة لمهمة عمل', $msg, $user->id, $recommender->id, 'lawyer/tasks', 'myTodoTask', $task->id);

       return response()->json([
           'success' => true,
           'message' => __('messages.refuse_invitation'),
       ]);
    }

    // attach task file for inprogress task - to be inreview
    public function changeStatus(Request $request, $id)
    {
        $messages = $this->getMessages();


        $assigner_id = Task::where('id', $id)->with('assignedlawyers')->first()->assignedlawyers[0]->pivot->assigner_id;
        $assigner = User::find($assigner_id);

        $valtask = Validator::make($request->all(), ['task_file' => 'required'], $messages);

        if ($valtask->fails()) {
            return response([
                'success' => false,
                'type' => 'noTaskFileAdded',
                'errors'=>$valtask->errors()->first(),
            ], 422);
        }

        $valfile = Validator::make($request->all(), ['task_file' => 'mimes:png,jpg,jpeg,csv,txt,xlx,xls,pdf'], $messages);

        if ($valfile->fails()) {
            return response([
                'success' => false,
                'type' => 'notValidTaskFile',
                'errors'=>$valfile->errors()->first(),
            ], 422);
        }

        $user = auth()->user();
        $task = $user->assignedtasks()->find($id);
        $task->update([
            'task_file' => $request->task_file,
            'status' => 'inreview'
        ]);
        $task->update(['task_file' => $task->setTaxFileAttribute($request->file('task_file'))]);

        $msg = 'قام المحامي '. $user->first_name .' بإنهاء المهمة ورفع ملفاتها';
        if($assigner->userable_type == 'App\Models\Lawyer')
        {
            $url = 'lawyer/tasks';
        }
        else
        {
            $url = 'client/tasks';
        }
        app('App\Http\Controllers\NotificationController')->sendNotification($assigner->device_token,'رفع الملفات الخاصة بالمهمة', $msg, $user->id, $assigner->id, $url, 'inreviewTask', $task->id);
    

        return response()->json([
            'success' => true,
            'message' => __('messages.inreview_success')]); 
        

    }


    public function updateTaskStatus($id, $status)
    {
        $task = Task::find($id);
        $task->update([
            'status' => $status
        ]);
    }
    

    protected function getMessages(){
        return $message = [
            'title.required'           => 'من فضلك حدد عنوان المهمة',
            'starting_date.required'   => 'من فضلك أدخل تاريخ التنفيذ',
            'starting_date.date_format'=> 'ينبغي أن يكون التاريخ بهذا الشكل : السنة - الشهر - اليوم ',
            'price.required'           => 'من فضلك حدد سعر المهمة', 
            'price.numeric'           => 'يجب ان يكون السعر رقم',  
            'cost.numeric'           => 'يجب ان يكون السعر رقم',    
            'court.required'           => 'من فضلك اختر المحكمة المختصة',
            'governorates.required'    => 'من فضلك اختر المحافظة',
            'description.required'     => 'من فضلك اكتب وصفا لمهمتك',
            'title.max'                => 'يجب ألا يتعدى العنوان 40 حرفا ',
            'title.min'                => 'يجب ألا يقل العنوان عن 5 حروف',
            'description.max'          => 'يجب ألا يتعدى الوصف 1500 حرفا',  
            'description.min'          => 'يجب ألا يقل الوصف عن 5 حروف',  
            'rating.required'          => 'من فضلك أدخل تقييمك',
            'rating.numeric'           => 'يجب أن يكون التقييم رقما',
            'rating.between'           => 'يجب آن تختار قيمة بين ال ١ وال ٥',
            'cost.required'            => 'يجب إضافة التكلفة التي تقدّرها لتلك المهمة',
            'cost.numeric'             => 'من فضلك أدخل قيمة رقمية للتكلفة',
            'id.required'              => 'من فضلك أدخل المهمة المراد ترشيحها',
            'id.exists'                => 'هذه المهمة غير موجودة، حاول مجددا',
            'task_file.required'       => 'من فضلك أدخل الملف المهمة',
            'task_file.mimes'          => 'الملف الذي أدخلته ليس صالحا',
            'task_id.exists'           => 'هذه المهمة غير موجودة، حاول مجددا',
            'user_id.exists'           => 'هذا المحامي غير موجود، حاول مجددا',
            'user_id.required'         => 'من فضلك اختر المحامي المراد إسناد المهمة له',
            'task_id.required'         => 'من فضلك اختر المهمة المراد إسنادها',
        ];
    }
}
