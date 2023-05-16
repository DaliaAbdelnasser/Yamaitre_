<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CreateLawyerRequest;
use App\Models\Lawyer;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Task;
use Laracasts\Flash\Flash;
use Mail;
use App\Mail\NotifyMail;
use Response;

class LawyerController extends Controller
{
    /**
     * Display a listing of the lawyer.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $query = User::query();

        if (request()->filled('search')) {
            $query
            ->where('name', 'LIKE', '%' . request('search') . '%')
            ->orWhere('email', 'LIKE', '%' . request('search') . '%');
        }
    
        $lawyers = $query->orderBy('created_at', 'DESC')->with('userable')->where('userable_type', 'App\Models\Lawyer')->paginate(10);
        return view('admin.lawyers.index', compact('lawyers'));
    }

    public function index_active()
    {
        $users = Lawyer::with('user')->where('status', '1')->get();
        $lawyers = []; 
        foreach($users as $lawyer)
        {
            $lawyers[]=User::with('userable')->where('userable_id',$lawyer->id)->first();
        }
        return view('admin.lawyers.index', compact('lawyers'));
    }

    public function index_not_active()
    {
        $users = Lawyer::with('user')->where('status', '0')->get();
        $lawyers = []; 
        foreach($users as $lawyer)
        {
            $lawyers[]=User::with('userable')->where('userable_id',$lawyer->id)->first();
        }
        return view('admin.lawyers.index', compact('lawyers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.lawyers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        // dd($request->file('id_photo'));

        $validator = Validator::make($request->all(),[
            'phone' => 'unique:users,phone',
            'email' => 'unique:users,email',
        ]);

        $input = $request->all();

        DB::beginTransaction();
            $lawyer = Lawyer::create($input);
            // set status -> inactive
            $lawyer->status = 0; 
            // $lawyer->update(['id_photo' => $lawyer->setIdFileAttribute($request->file('id_photo'))]);
            $user = User::create([
                'name' => $request['name'],
                'phone' => $request['phone'],
                'email' => $request['email'],
                'password' => $request['password'],
                'userable_id' => $lawyer->id,
                'userable_type' => 'App\Models\Lawyer',
            ]);
            DB::commit();

        return redirect(route('admin.lawyers.index'));

    }

    /**
     * Display the specified lawyer
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lawyer = User::with('userable')->where('id', $id)->first();
        $user = Lawyer::where('id', $lawyer->userable->id)->first();
        $user_id = $user->id;
        $lawyer_id = $lawyer->id;
        ////////////  my ////////////////
        // $tasks = $user->with('tasks')->withCount('applicantlawyers')->where('status', 'todo')->get(); // todo
        
        $tasks = Task::where('status', 'todo')->with('user.userable')->withCount('applicantlawyers')->whereHas('user', function ($query) use($user_id){
            $query->where('user_id', '=' , $user_id);
        })->paginate(5);

        $inprogress = Task::with('assignedlawyers.userable')->where('status','inprogress')->whereHas('assignedlawyers', function ($query) use($user_id){
            $query->where('assigner_id', '=' , $user_id);
        })->paginate(5);

        $inreview = Task::with('assignedlawyers.userable')->where('status','inreview')->whereHas('assignedlawyers', function ($query) use($user_id){
            $query->where('assigner_id', '=' , $user_id);
        })->paginate(5);

        $completed = Task::with('assignedlawyers.userable')->where('status','completed')->whereHas('assignedlawyers', function ($query) use($user_id){
            $query->where('assigner_id', '=' , $user_id);
        })->paginate(5);

        ////////////////// others ///////////////

        $others_tasks = Task::where('status', 'todo')->with('user')->whereHas('applicantlawyers', function ($query) use($user_id){
            $query->where('user_id', '=' , $user_id);
        })->paginate(5);
        
        $others_inprogress = Task::where('status', 'inrevieinprogressw')->with('user')->whereHas('assignedlawyers', function ($query) use($user_id){
            $query->where('user_id', '=' , $user_id);
        })->paginate(5);

        $others_inreview = Task::where('status', 'inreview')->with('user')->whereHas('assignedlawyers', function ($query) use($user_id){
            $query->where('user_id', '=' , $user_id);
        })->paginate(5);

        $others_completed = Task::where('status', 'completed')->with('user')->whereHas('assignedlawyers', function ($query) use($user_id){
            $query->where('user_id', '=' , $user_id);
        })->paginate(5);


        if (empty($lawyer)) {
            // Flash::error('Lawyer not found');

            return redirect(route('admin.lawyers.index'));
        }
        
        return view('admin.lawyers.show', compact('lawyer', 'tasks','inprogress', 'inreview', 'completed', 'others_tasks', 'others_inprogress', 'others_inreview', 'others_completed'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lawyer = User::with('userable')->where('userable_id', $id)->first();
        return view('admin.lawyers.edit', compact('lawyer'));
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
        $user = User::with('userable')->find($id);

        
        $lawyer = Lawyer::where('id',$user->userable_id)->first();
        $lawyer->setProfileImageAttribute($request->file('profile_image'));

        // All posted data except token and id
        $data = request()->except(['_token','id']);

        // Remove empty array values from the data
        $result = array_filter($data);

        $lawyer->update($result);
        $user->update($result);

        Flash::success('تم تعديل المحامي بنجاح');


        return redirect(route('admin.lawyers.index'));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('userable_id', $id);
        $lawyer = Lawyer::where('id', $id); 
        $user->delete();
        $lawyer->delete();
        return redirect(route('admin.lawyers.index'));
    }

    public function activate($id)
    {
        $lawyer = User::with('userable')->where('userable_id', $id)->first();
        $lawyer->userable->update(['status' => 1]);

        Mail::to($lawyer->email)->send(new NotifyMail($lawyer, 'emails.activationEmail', 'Activation Mail', ''));

        Flash::success('تم تفعيل المحامي بنجاح');

        return redirect()->back();
    }
}
