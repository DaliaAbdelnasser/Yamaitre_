<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Lawyer;
use App\Models\User;
use App\Models\Chat;
use Laracasts\Flash\Flash;
use App\Mail\NotifyMail;
use Illuminate\Support\Facades\Mail;

class TaskController extends Controller
{
    public function index()
    {
        // dd('here');
        $query = Task::query();

        if (request()->filled('search')) {
            $query
            ->where('title', 'LIKE', '%' . request('search') . '%');
        } 

        $tasks = $query->orderBy('created_at', 'DESC')->paginate(10);

        return view('admin.tasks.index', compact('tasks'));
    }

    // public function posted_tasks($id)
    // {
    //     $lawyer = Lawyer::where('id', $id)->first();
    //     $tasks = $lawyer->tasks()->withCount('applicantlawyers')->where('status', 'todo')->get();
    //     return view('admin.tasks.index', compact('tasks'));
    // }

    public function show($id)
    {
        // dd($id);
        // $lawyer = Lawyer::where('id', $lawyer_id)->first();
        $task = Task::with('applicantlawyers', 'user')->withCount('applicantlawyers')->find($id);
        return view('admin.tasks.show', compact('task'));
    }

    public function admin_assign($task_id, $user_id, $assigner_id,Request $request)
    {
        $mainlawyer = User::find($assigner_id);

        // find the task by its id
        $task = Task::find($task_id);
        $task->update(['status' => 'inprogress']);

        $lawyer = User::find($user_id);
        $cost = $request->cost;

        $lawyer->assignedtasks()->attach($task_id, array('assigner_id' => $assigner_id, 'cost' => $cost));

        Mail::to($lawyer->email)->send(new NotifyMail($lawyer, 'emails.requestSomething', 'Accept Task Proposal', 'تم إسناد المهمة '.$task->title.' إليك.'));
        
        // open chat
        $sender = $assigner_id; 
        $reciever = User::find($user_id);
        if(Chat::where(['sender_id' =>  $assigner_id, 'reciever_id' => $reciever->id])->first() == null && Chat::where(['sender_id' =>  $reciever->id, 'reciever_id' => $assigner_id])->first() == null )
        {
            $chat = Chat::create([
                'sender_id'  => $assigner_id,
                'reciever_id'=> $reciever->id,
                'type' => 2,
            ]);

            $chat_id = $chat->id;
            $chat->update(['chat_channel' => "chat-".$chat_id]);
        }

        

        Flash::success('تم اسناد المهمة بنجاح');
        return redirect()->back();

    }

    // main lawyer make it completed
    public function admin_complete_task($task_id)
    {

        $task = Task::with('assignedlawyers.userable')->where('status', 'inreview')->find($task_id);
        
        if($task != null)
        {
            
            $lawyer_id = $task->assignedlawyers()->first()->userable->id;

            if($task->task_file != null)
            {
                $task->update(['status' => 'completed']);
                $assignedlawyer = Lawyer::with('user')->where('id', $lawyer_id,)->first();
                $assignedlawyer->tasks_count += 1;
                $assignedlawyer->save();
                Mail::to($assignedlawyer->user->email)->send(new NotifyMail($assignedlawyer->user, 'emails.requestSomething', 'Task Completed', 'تم إنهاء مهمتك، يمكنك الآن الحصول على التكلفة المستحقة بكل يسر.'));

                Flash::success('تم إنهاء المهمة بنجاح');
                return redirect()->back();
            }

        }
        else
        { 
            $message = "هذه المهمة مكتملة بالفعل";
            return \Redirect::back()->withErrors($message);
        }
        
    }
 
    

    // public function posted_tasks_inprogress($id)
    // {
    //     $lawyer = Lawyer::where('id', $id)->first();
    //     $user_id = $lawyer->id;
    //     $tasks = Task::with('assignedlawyers.user')->where('status','inprogress')->whereHas('assignedlawyers', function ($query) use($user_id){
    //         $query->where('assigner_id', '=' , $user_id);
    //     })->get();
    //     return view('admin.tasks.index-status', compact('tasks'));
    // }

    // public function posted_tasks_inreview($id)
    // {
    //     $lawyer = Lawyer::where('id', $id)->first();
    //     $user_id = $lawyer->id;
    //     $tasks = Task::with('assignedlawyers.user')->where('status','inreview')->whereHas('assignedlawyers', function ($query) use($user_id){
    //         $query->where('assigner_id', '=' , $user_id);
    //     })->get();
    //     return view('admin.tasks.index-status', compact('tasks'));
    // }

    // public function posted_tasks_completed($id)
    // {
    //     $lawyer = Lawyer::where('id', $id)->first();
    //     $user_id = $lawyer->id;
    //     $tasks = Task::with('assignedlawyers.user')->where('status','completed')->whereHas('assignedlawyers', function ($query) use($user_id){
    //         $query->where('assigner_id', '=' , $user_id);
    //     })->get();
    //     return view('admin.tasks.index-status', compact('tasks'));
    // }

}
