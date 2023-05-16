<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Lawyer;
use App\Models\User;
use App\Models\Task;
use App\Models\Info;
use App\Models\Review;
use Illuminate\Support\Facades\Validator;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

        $price = Validator::make($request->all(), ['price'  => 'required'], $messages);

        if ($price->fails()) {
            return response([
                'success' => false,
                'type' => 'noPriceAdded',
                'errors'=>$price->errors()->first(),
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
        if($user->userable_type == 'App\Models\Client')
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = auth()->user();
        $client_id = $user->id;
        // $task = $user->tasks()->find($id);
        $task = Task::whereHas('user', function ($query) use($client_id){
                $query->where('user_id', '=' , $client_id);
            })->find($id);
        // return $task;
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

        return response()->json([
            'task' => $task,
            'fees' => $fees,
            
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        if($user->userable_type == 'App\Models\Client')
        {
            $client = Client::where('id', $user->userable->id)->first();
                $user->tasks()->find($id)->update($request->all());
                return response([
                    'success' => true,
                    'message' =>__('messages.update_task')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $user = auth()->user();
        if($user->userable_type == 'App\Models\Client')
        {
            $client = Client::where('id', $user->userable->id)->first();
            $user->tasks()->detach($task);
            $task->delete();
            return response()->json([
                'success' => true,
                'message' => __('messages.delete_task')]);
        }
    }


    //////////////////////////////////////// Client Posted Tasks ////////////////////////////////////


    // assign task to a specific lawyer
     public function assign_task(Request $request)
     {
        $messages = $this->getMessages();

        $validre = Validator::make($request->all(), ['user_id' => 'required'], $messages);

        if ($validre->fails()) {
            return response([
                'success' => false,
                'type' => 'noUserIdAdded',
                'errors'=>$validre->errors()->first(),
            ], 422);
        }

        $valid = Validator::make($request->all(), ['user_id' => 'exists:users,id'], $messages);

        if ($valid->fails()) {
            return response([
                'success' => false,
                'type' => 'notExistInUsers',
                'errors'=>$valid->errors()->first(),
            ], 422);
        }

        $taskre = Validator::make($request->all(), ['task_id' => 'required'], $messages);

        if ($taskre->fails()) {
            return response([
                'success' => false,
                'type' => 'noTaskIdAdded',
                'errors'=>$taskre->errors()->first(),
            ], 422);
        }

        $intasks = Validator::make($request->all(), ['task_id' => 'exists:tasks,id'], $messages);

        if ($intasks->fails()) {
            return response([
                'success' => false,
                'type' => 'notExistInTasks',
                'errors'=>$intasks->errors()->first(),
            ], 422);
        }

        $id = $request->user_id;
        $task_id = $request->task_id;
        
        $user = auth()->user();
        $client = Client::where('id', $user->userable->id)->first();

        // find the task by its id
        $task = Task::find($task_id);
        $task->update(['status' => 'inprogress']);
        $lawyer = User::find($id);
        $cost = $lawyer->appliedtasks->find($task_id)->pivot->cost;
        $lawyer->assignedtasks()->attach($task_id, array('assigner_id' => $user->id, 'cost' => $cost));
        return response()->json([
            'success' => true,
            'message' => __('messages.assigned_success')]); 
    }

    // client make it completed
    public function complete_task(Request $request, $id)
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
        $client = Client::where('id', $user->userable->id)->first();
        $user_id = $user->id;

        $task = Task::where('status', 'inreview')->with('assignedlawyers.userable')->whereHas('assignedlawyers', function ($query) use($user_id){
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
                $assignedlawyer->save();
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

      // طلباتي من الغير - Done
    public function my_posted_tasks()
    {
        
        $client = auth()->user();
        $user_id = $client->id;
        $query = Task::query();

        if( request()->filled('status') && request('status') == 'todo' ){
            $query->where('status', request('status'))->withCount('applicantlawyers')->whereHas('user', function ($query) use($user_id){
                $query->where('user_id', '=' , $user_id);
            })->get();
        }

        elseif( request()->filled('status') ){
            $query->where('status', request('status'))->with('assignedlawyers.userable')->whereHas('assignedlawyers', function ($query) use($user_id){
                $query->where('assigner_id', '=' , $user_id);
            })->get();
        }


        if( request()->filled('offset') ){
            $query->offset( request('offset') );
        }

        $query->limit( request('limit') ?? 10 );

        $tasks = $query->orderBy('created_at', 'desc')->get();

        $data['tasks'] = $tasks;
        
        $data['fees'] = [
            'task_fees'  =>  Info::where('info_name', 'cash_in')->first()->info_value . "%",
            'refund_fees'=>  Info::where('info_name', 'refund')->first()->info_value . "%",
        ];

        return response()->json($data);

    }

    protected function getMessages(){
        return $message = [
            'title.required'           => 'من فضلك حدد نوع المساعدة المطلوبة المهمة',
            'starting_date.required'   => 'من فضلك أدخل تاريخ التنفيذ',
            'starting_date.date_format'=> 'ينبغي أن يكون التاريخ بهذا الشكل : السنة - الشهر - اليوم ',
            'price.required'           => 'من فضلك حدد المبلغ المعروض لإتمام التنفيذ',  
            'court.required'           => 'من فضلك اختر مكان التنفيذ',
            'governorates.required'    => 'من فضلك اختر نطاق التنفيذ',
            'description.required'     => 'من فضلك اكتب وصفا لطلبك',
            'title.max'                => 'يجب ألا يتعدى العنوان 40 حرفا ',
            'title.min'                => 'يجب ألا يقل العنوان عن 5 حروف',
            'description.max'          => 'يجب ألا يتعدى الوصف 1500 حرفا',  
            'description.min'          => 'يجب ألا يقل الوصف عن 5 حروف',  
            'task_id.exists'           => 'هذه المهمة غير موجودة، حاول مجددا',
            'user_id.exists'           => 'هذا المحامي غير موجود، حاول مجددا',
            'user_id.required'         => 'من فضلك اختر المحامي المراد إسناد المهمة له',
            'task_id.required'         => 'من فضلك اختر المهمة المراد إسنادها',
            'rating.required'          => 'من فضلك أدخل تقييمك',
            'rating.numeric'           => 'يجب أن يكون التقييم رقما',
            'rating.between'           => 'يجب آن تختار قيمة بين ال ١ وال ٥',
        ];
    }
}
