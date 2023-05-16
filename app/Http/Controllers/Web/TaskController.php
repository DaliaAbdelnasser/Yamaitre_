<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Lawyer;
use App\Models\Chat;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\DB;



class TaskController extends Controller
{

    public function lawyer_tasks()
    {
        return view('both.tasks.lawyer-tasks');
    }

    public function others_tasks()
    {
        $user = auth()->user();
        $user_id = $user->id;
        $query = Task::query();

        $data['tasks'] = $query->where('status', 'todo')->with('user.userable')->whereHas('applicantlawyers', function ($query) use($user_id){
            $query->where('user_id', '=' , $user_id);
        })->orderBy('created_at', 'desc')->get();

        $data['inprogress'] = Task::where('status', 'inprogress')->with('user.userable', 'assignedlawyers')->whereHas('assignedlawyers', function ($query) use($user_id){
            $query->where('user_id', '=' , $user_id);
        })->orderBy('created_at', 'desc')->get();

        foreach($data['inprogress'] as $key => $task){

            $data['assigner_id'] = $task->assignedlawyers[0]->pivot->assigner_id; 
            $data['chats'][$key] = Chat::where([
                ['reciever_id', $task->assignedlawyers[0]->pivot->user_id],
                ['sender_id', $task->assignedlawyers[0]->pivot->assigner_id]
                ])
                ->orWhere([
                    ['reciever_id', $task->assignedlawyers[0]->pivot->assigner_id],
                    ['sender_id', $task->assignedlawyers[0]->pivot->user_id]
                ])->get();
        }


        $data['inreview'] = Task::where('status', 'inreview')->with('user.userable')->whereHas('assignedlawyers', function ($query) use($user_id){
            $query->where('user_id', '=' , $user_id);
        })->orderBy('created_at', 'desc')->get();

        $data['completed'] = Task::where('status', 'completed')->with('user.userable')->whereHas('assignedlawyers', function ($query) use($user_id){
            $query->where('user_id', '=' , $user_id);
        })->orderBy('created_at', 'desc')->get();
        
        // dd($data);
        return view('both.tasks.others-tasks', compact('data'));
    }

    public function offers()
    {
        $user = auth()->user(); 
        $user_id =  $user->id;

        $query1 = Task::query();

        $data['tasks'] = $query1->with('recommenderlawyers.userable')->orderBy('created_at', 'desc')->whereHas('invitedlawyers.userable', function ($query) use($user_id){
            $query->where('user_id', '=' , $user_id);
        })->paginate(10);

        // dd($data);
        return view('both.tasks.offers-tasks', compact('data'));
    } 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user_id = auth()->user()->id;

        $query = Task::query(); 

        $data['tasks'] = Task::where('status', 'todo')->with('user.userable')->withCount('applicantlawyers')->whereHas('user', function ($query) use($user_id){
            $query->where('user_id', '=' , $user_id);
        })->orderBy('created_at', 'desc')->get();

        $data['inprogress'] = Task::with('assignedlawyers.userable', 'user.chat')->where('status','inprogress')->whereHas('assignedlawyers', function ($query) use($user_id){
            $query->where('assigner_id', '=' , $user_id);
        })->orderBy('created_at', 'desc')->get();

        foreach($data['inprogress'] as $key => $task){

            $data['assigner_id'] = $task->assignedlawyers[0]->pivot->assigner_id; 
            $data['chats'][$key] = Chat::where([
                ['reciever_id', $task->assignedlawyers[0]->pivot->user_id],
                ['sender_id', $task->assignedlawyers[0]->pivot->assigner_id]
                ])
                ->orWhere([
                    ['reciever_id', $task->assignedlawyers[0]->pivot->assigner_id],
                    ['sender_id', $task->assignedlawyers[0]->pivot->user_id]
                ])->get();
        }
        $data['inreview'] = Task::with('assignedlawyers.userable')->where('status','inreview')->whereHas('assignedlawyers', function ($query) use($user_id){
            $query->where('assigner_id', '=' , $user_id);
        })->orderBy('created_at', 'desc')->get();

        $data['completed'] = Task::with('assignedlawyers.userable')->where('status','completed')->whereHas('assignedlawyers', function ($query) use($user_id){
            $query->where('assigner_id', '=' , $user_id);
        })->orderBy('created_at', 'desc')->get();

        $data['titles'] = Task::titles();
        $data['governorates'] = Lawyer::governorates();
        $data['courts'] = Task::courts();

        return view('both.tasks.tasks-list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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

        $data = $request->validate([
            'title'         => 'required|max:40|min:5',
            'starting_date' => 'required|date_format:Y-m-d',
            'price'         => 'required|numeric',
            'court'         => 'required',
            'governorates'  => 'required',
            'description'   => 'required|max:1500|min:5'  
        ], $messages);

        $user = auth()->user();

        if($request->has('accept_terms'))
        {
            $user->accept_terms += 1;
            $user->save();
        }
        
        if($user->userable_type == 'App\Models\Lawyer')
        {
            $lawyer = Lawyer::where('id', $user->userable->id)->first();
            if($lawyer->status == 0)
            {
                $message = "نأسف لذلك، ولكن لم يتم تفعيل حسابك حتى الآن";
                return \Redirect::back()->withErrors($message);
            }
        }

        // check accept terms 
        if($user->accept_terms < 2)
        {
            $message = "مازلت لم توافق على شروط الخصوصية بعد";
            return \Redirect::back()->withErrors($message);
        }

        $task = Task::create($request->all());
        $task->status = 'todo';
        $task->save();
        $user->tasks()->attach($task->id);

        $msg = " قام ". $user->first_name ." بنشر مهمة عمل جديدة.";
        app('App\Http\Controllers\NotificationController')->sendNotificationToTopic('تم نشر مهمة جديدة', $msg, 'tasks', 'tasks', 'task', $task->id);
        
        $message = "تم نشر مهمتك بنجاح";
        session()->flash('success', $message);
        return \Redirect::back()->withInput();
        
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
                    }
                }
            }
        }
        else
        {
            // return response()->json([
            //     'success' => false,
            //     'type' => "noAccess",
            //     'errors' => 'ليست من مهماتك، من فضلك أعد المحاولة'
            // ], 403); 

        }

        // return response()->json([
        //     'task' => $task,
        // ]);   
        return view('both.tasks.show', compact('task'));
    }



    public function show_single($id)
    {
        $user = auth()->user();
        $lawyer_id = $user->id;
        $task = Task::with('user.userable')->find($id);
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
                    }
                }
            }
        }
        else
        {
            // return response()->json([
            //     'success' => false,
            //     'type' => "noAccess",
            //     'errors' => 'ليست من مهماتك، من فضلك أعد المحاولة'
            // ], 403); 

        }

        // return response()->json([
        //     'task' => $task,
        // ]);   
        return view('both.tasks.show-single-other', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {

        // return $request;
        $messages = $this->getMessages();

        $data = $request->validate([
            'title'         => 'nullable|max:40|min:5',
            'starting_date' => 'nullable|date_format:Y-m-d',
            'price'         => 'nullable|numeric',
            'court'         => 'nullable',
            'governorates'  => 'nullable',
            'description'   => 'nullable|max:1500|min:5'  
        ], $messages);

        $user = auth()->user();
        
        if($user->userable_type == 'App\Models\Lawyer')
        {
            $lawyer = Lawyer::where('id', $user->userable->id)->first();
            if($lawyer->status == 0)
            {
                $message = "نأسف لذلك، ولكن لم يتم تفعيل حسابك حتى الآن";
                return \Redirect::back()->withErrors($message);
            }
        }

        // check accept terms 
        if($user->accept_terms < 2)
        {
            $message = "مازلت لم توافق على شروط الخصوصية بعد";
            return \Redirect::back()->withErrors($message);
        }

        $user->tasks()->find($id)->update($request->all());

        $message = "تم تعديل مهمتك بنجاح";
        session()->flash('success', $message);
        return \Redirect::back()->withInput();

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
        //
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
        $user->tasks()->detach($task);
        $task->delete();
        $message = 'تم حذف المهمة بنجاح';
        session()->flash('success', $message);
        return \Redirect::back()->withInput();
    }


    ////////////////////////////////////////////////////////////////////   ///////////////////////////////////////////////////////////////////////////////////

    public function apply_for(Request $request, $id)
    {
        
        // choose a task by its id
        $task = Task::with('user')->find($id);

        if($task == null)
        {
            $message = "هذه المهمة ليست متاحة الآن";
            return \Redirect::back()->withErrors($message);
        }
        
        // check if it's a todo task 
        if($task->status == 'todo'){
            $user = auth()->user();
            $messages = $this->getMessages();
            $data = $request->validate([
                    'cost' => 'required|numeric',
            ], $messages);

           
            if($request->has('accept_terms'))
            {
                $user->accept_terms += 1;
                $user->save();
            }

            // check accept terms 
            if($user->accept_terms < 2)
            {
                $message = "مازلت لم توافق على شروط الخصوصية بعد";
                return \Redirect::back()->withErrors($message);
            }

            if($user->userable_type == 'App\Models\Lawyer')
            {

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
                            $url = 'client/tasks'.$task->id;
                        }
                        app('App\Http\Controllers\NotificationController')->sendNotification($task->user[0]->device_token, 'التقدم لتنفيذ مهمة عمل', $msg, $user->id, $task->user[0]->id, $url, 'myTodoTask', $task->id);
                        
                        $message = "تم إرسال طلبك بنجاح";
                        session()->flash('success', $message);
                        return \Redirect::back()->withInput();

                    }
                    else
                    {
                        $message = "لقد تقدمت لهذه المهمة من قبل";
                        return \Redirect::back()->withErrors($message);
                    }
                }
                else
                {
                    $message = "نأسف لذلك، ولكن لم يتم تفعيل حسابك حتى الآن";
                    return \Redirect::back()->withErrors($message);
                }
            }
        }
        else
        {
            $message = "هذه المهمة ليست متاحة الآن";
            return \Redirect::back()->withErrors($message);
        }
    }

    public function refuse_invitation($id)
    {
        $user = auth()->user();   
        $task = $user->invitedtasks()->find($id);
        if($task == null)
        {
            $message = "نأسف ولكن أنت لم تعد مدعو لهذه المهمة";
            return \Redirect::back()->withErrors($message);
        }
        $recommender = Task::find($id)->recommenderlawyers[0];
        // $task->delete();
        
        DB::beginTransaction();
        DB::table('invited_task')->where('task_id', $task->id)->delete();
        DB::commit();

        $msg = 'قام المحامي '. $user->first_name .' برفض دعوتك المرسلة لتنفيذ المهمة ';
        if($recommender->userable_type == 'App\Models\Lawyer')
        {
            $url = 'lawyer/tasks';
        }
        else
        {
            $url = 'client/tasks';
        }
        app('App\Http\Controllers\NotificationController')->sendNotification($recommender->device_token,'رفض الدعوة لمهمة عمل', $msg, $user->id, $recommender->id, $url, 'myTodoTask', $task->id);

        $message = "تم رفض الدعوة بنجاح";
        session()->flash('success', $message);
        return \Redirect::back()->withInput();
    }

    //////////////////////////////////////////////////////////////// ////////////////////////////////////////////////////////////////////////


    // attach task file for inprogress task - to be inreview
    public function change_status(Request $request, $id)
    {
        $messages = $this->getMessages();

        $data = $request->validate([
        'task_file'     => 'required|mimes:png,jpg,jpeg,csv,txt,xlx,xls,pdf'
        ], $messages);

        $user = auth()->user();
        $task = $user->assignedtasks()->find($id);
        $assigner_id = $task->assignedlawyers[0]->pivot->assigner_id;
        $assigner = User::find($assigner_id);

        if($task == null)
        {
            $message = "نأسف ولكن لا يمكنك رفع الملف لهذه المهمة، حاول لاحقا";
            return \Redirect::back()->withErrors($message);
        }

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
        app('App\Http\Controllers\NotificationController')->sendNotification($assigner->device_token,'رفع الملفات الخاصة بمهمة عمل', $msg, $user->id, $assigner->id, $url, 'inreviewTask', $task->id);
    
        $message = "تم رفع ملف المهمة بنجاح";
        session()->flash('success', $message);
        return \Redirect::back()->withInput();
         
    }

    // main lawyer make it completed
    public function complete_task(Request $request, $id)
    {

        $messages = $this->getMessages();

        $data = $request->validate([
            'rate'   => 'required|numeric|between:1,5'
        ], $messages);

    
        $user = auth()->user();
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
                    'rating'    => $request->rate,
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

                $message = "تم إنهاء المهمة وتقييم المحامي بنجاح";
                session()->flash('success', $message);
                return \Redirect::back()->withInput();
            }

        }
        else
        { 
            $message = "هذه المهمة مكتملة بالفعل";
            return \Redirect::back()->withErrors($message);
        }
        
    }

    // open chat
    public function open_chat(Request $request)
    {
        $user = auth()->user();

        if($request->type == 'sender')
        {
            $lawyer = User::find($request->lawyer_id);
            $chat = Chat::where(['reciever_id' => $request->lawyer_id, 'sender_id' => $user->id])->first();
            $chats = Chat::with('sender.userable', 'reciever.userable', 'content')->where('sender_id', $user->id)->orWhere('reciever_id', $user->id)->get();
            $singlechat = Chat::with('sender.userable', 'reciever.userable', 'content')->find($chat->id);
            return view('chat.room', compact('chats', 'singlechat'));
        }
        else
        {
            $chat = Chat::where(['reciever_id' => $user->id, 'sender_id' => $request->lawyer_id])->first();
            $chats = Chat::with('sender.userable', 'reciever.userable', 'content')->where('sender_id', $user->id)->orWhere('reciever_id', $user->id)->get();
            $singlechat = Chat::with('sender.userable', 'reciever.userable', 'content')->find($chat->id);
            return view('chat.room', compact('chats', 'singlechat'));
        }

        
    }

    // invite lawyer to take a specific task
    public function recommended_task(Request $request, $id)
    {
        $messages = $this->getMessages();

        $data = $request->validate([
            'id'    =>    'required|exists:tasks,id',
        ], $messages);
        
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
                    $message = "لقد تم إرسال هذه الدعوة من قبل";
                    return \Redirect::back()->withErrors($message);
                }
                $Invitedlawyer->invitedtasks()->attach($request->id);
                $user->recommendedtasks()->attach($request->id);

                $msg = 'قام '. $user->first_name .' بدعوتك لمهمة العمل '.$task->title.' للعمل على تنفيذها ';
                app('App\Http\Controllers\NotificationController')->sendNotification($Invitedlawyer->device_token,'دعوة لتنفيذ مهمة عمل', $msg, $user->id, $Invitedlawyer->id, 'lawyer/offers-tasks', 'invitedTask', $task->id);

                $message = "تم إرسال الدعوة بنجاح";
                session()->flash('success', $message);
                return \Redirect::back()->withInput();

            }
            else
            {
                $message = "نأسف لذلك، ولكن لم يتم تفعيل حسابك حتى الآن";
                return \Redirect::back()->withErrors($message);
            }
        }  
        else
        {
            $task = $user->tasks()->find($request->id);
            $Invitedlawyer = User::find($id);
    
            if($Invitedlawyer->invitedtasks()->find($request->id) != null)
            {
                $message = "لقد تم إرسال هذه الدعوة من قبل";
                return \Redirect::back()->withErrors($message);
            }
            $Invitedlawyer->invitedtasks()->attach($request->id);
            $user->recommendedtasks()->attach($request->id);
            $message = "تم إرسال الدعوة بنجاح";
            session()->flash('success', $message);
            return \Redirect::back()->withInput();
        }
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
