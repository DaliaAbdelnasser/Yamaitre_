<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcement;
use Illuminate\Support\Facades\Validator;
use File;
use Carbon\Carbon;
use Laracasts\Flash\Flash;
use App\Mail\NotifyMail;
use Illuminate\Support\Facades\Mail;


class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Announcement::query()->with('users');

        if (request()->filled('search')) {
            $query
            ->whereHas('users', function ($query) {
                $query->where('first_name', 'LIKE', '%' . request('search') . '%')
                ->orWhere('last_name', 'LIKE', '%' . request('search') . '%')
                ->orWhere('email', 'LIKE', '%' . request('search') . '%');
            })->get();
        } 
        $announcements = $query->orderBy('created_at', 'DESC')->paginate(10);
        $places = Announcement::places();
        return view('admin.announcements.index', compact('announcements', 'places'));   
    }

    public function show($id)
    {
        $announcement = Announcement::with('users')->find($id);
        return view('admin.announcements.show', compact('announcement'));
    }


    public function edit($id)
    {
        $announcement = Announcement::with('users')->find($id);
        return view('admin.announcements.edit', compact('announcement'));
    }

    public function update(Request $request, $id)
    {
        $data = request()->except(['_token','id']);
        $result = array_filter($data);

        $input = Validator::make($result, Announcement::$rules);

        $announcement = Announcement::with('users')->find($id); 
        $announcement->update($result);

        // dd($result);
        if(array_key_exists('image', $result) && $result['image']){
            $announcement->image = $announcement->setFileAttribute($result->file('image'));
        }

        if(array_key_exists('mob_image', $result) && $result['mob_image']){
            $announcement->mob_image = $announcement->setMobFileAttribute($result->file('mob_image'));
        } 

        if(array_key_exists('usertype', $result) && $result['usertype'] == 'lawyer')
        {
            $type = 'lawyer';
        }
        elseif(array_key_exists('usertype', $result) && $result['usertype'] == 'client')
        {
            $type = 'client';
        }
        elseif(array_key_exists('usertype', $result) && $result['usertype'] == 'all')
        {
            $type = 'all';
        }

        $announcement->created_at = Carbon::now('Africa/Cairo');
        $announcement->usertype = $type;
        $announcement->save();

        Mail::to($announcement->users[0]->email)->send(new NotifyMail($announcement->users[0], 'emails.requestSomething', 'Announcement Publishing', 'تم نشر إعلانك بنجاح'));

        Flash::success('تم تحديث الاعلان بنجاح');

        return redirect()->route('admin.announcements.show', [$announcement->id]);
    }

    public function destroy($id)
    {
        /** @var Announcement $admin */
        $announcement = Announcement::find($id);

        if (empty($announcement)) {
            Flash::error('الاعلان غير موجود');

            return redirect(route('admin.admins.index'));
        }

        $announcement->delete();

        Flash::success('تم حذف الاعلان بنجاح');

        return redirect(route('admin.announcements.index'));
    }

}
