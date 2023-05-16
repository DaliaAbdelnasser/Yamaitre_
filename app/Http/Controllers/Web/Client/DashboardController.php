<?php

namespace App\Http\Controllers\Web\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Announcement;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $data['todo_count'] = $user->tasks()->where('status','todo')->count();
        $data['inprogress_count'] = $user->tasks()->where('status','inprogress')->count();
        $data['inreview_count'] = $user->tasks()->where('status','inreview')->count();
        $data['completed_count'] = $user->tasks()->where('status','completed')->count();

        $data['my_recent_consultations'] = $user->userable->consultations->take(5);
        $data['tasks'] = $user->tasks->where('status','todo')->take(5);
        $data['my_recent_ads'] = $user->announcements->take(5);
        $data['places'] = Announcement::places();



        return view('client.dashboard', compact('user', 'data'));
    }

    public function profile_settings()
    {
        $data['user'] = auth()->user();
        $data['governorates'] = Client::governorates();
        return view('both.settings.profile', compact('data'));
    }

}
