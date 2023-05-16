<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller

{
    /**
     * Display a listing of the resource.
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
    
        $clients = $query->orderBy('created_at', 'DESC')->with('userable')->where('userable_type', 'App\Models\Client')->paginate(10);

        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        DB::beginTransaction();
            $client = Client::create($input);
            $client->update(['profile_image' => $client->setProfileImageAttribute($request->file('profile_image'))]);
            $user = User::create([
                'name' => $request['name'],
                'phone' => $request['phone'],
                'email' => $request['email'],
                'password' => $request['password'],
                'userable_id' => $client->id,
                'userable_type' => 'App\Models\Client',
            ]);
            DB::commit();

        return redirect(route('admin.clients.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = User::with('userable')->where('id', $id)->first();
        $user = Client::where('id', $client->userable_id)->first();
        $user_id = $client->id;
        $client_id = $user->id;

        $tasks = Task::where('status', 'todo')->with('user.userable')->withCount('applicantlawyers')->whereHas('user', function ($query) use($client_id){
            $query->where('user_id', '=' , $client_id);
        })->paginate(5);

        $inprogress = Task::where('status', 'inprogress')->with('assignedlawyers.userable')->whereHas('assignedlawyers', function ($query) use($client_id){
            $query->where('assigner_id', '=' , $client_id);
        })->paginate(5);

        $inreview = Task::where('status', 'inreview')->with('assignedlawyers.userable')->whereHas('assignedlawyers', function ($query) use($client_id){
            $query->where('assigner_id', '=' , $client_id);
        })->paginate(5);

        $completed = Task::where('status', 'completed')->with('assignedlawyers.userable')->whereHas('assignedlawyers', function ($query) use($client_id){
            $query->where('assigner_id', '=' , $client_id);
        })->paginate(5);

        return view('admin.clients.show', compact('client', 'tasks', 'inprogress', 'inreview', 'completed'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = User::with('userable')->where('id', $id)->first();
        return view('admin.clients.edit', compact('client'));
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

        
        $client = Client::where('id',$user->userable_id)->first();

        // All posted data except token and id
        $data = request()->except(['_token','id']);

        // Remove empty array values from the data
        $result = array_filter($data);

        $client->update($result);
        $user->update($result);

        return redirect()->route('admin.clients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $client = Client::where('id', $user->userable_id)->first(); 
        $user->delete();
        $client->delete();
        return redirect()->route('admin.clients.index');
    }
}
