<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\Lawyer;
use App\Models\Client;
use App\Mail\NotifyMail;
use Illuminate\Support\Facades\Mail;
use Flash;

class AnnouncementController extends Controller
{
    public function store(Request $request)
    {
        $messages = $this->getMessages();
        $validator = $request->validate(
            [
                'place'       => 'required|string',     
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
            if($lawyer->status == 1)
            {
                $announcement = Announcement::create($request->all());
                $announcement->update(['mob_image' => 'default_mob_banner.jpeg']);
                $user->announcements()->attach($announcement->id);
                
                Mail::to($user->email)->send(new NotifyMail($user, 'emails.requestSomething', 'Announcement Request', 'تم استلام طلب الإعلان الخاص بك وسيقوم فريق المبيعات بالتواصل معك في أقرب وقت ممكن'));
                
                $message = "تم إرسال طلبك بنجاح";
                Flash::success($message);
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
            $announcement = Announcement::create($request->all());
            $announcement->update(['mob_image' => 'default_mob_banner.jpeg']);
            $user->announcements()->attach($announcement->id);
            Mail::to($user->email)->send(new NotifyMail($user, 'emails.requestSomething', 'Announcement Request', 'تم استلام طلب الإعلان الخاص بك وسيقوم فريق المبيعات بالتواصل معك في أقرب وقت ممكن'));
            
            $message = "تم طلب إعلانك بنجاح";
            Flash::success($message);
            return \Redirect::back()->withInput();
        }
    }

    public function index()
    {

        $userData = auth()->user();
        $user_id = $userData->id;

        $data['pending_announcements'] = Announcement::where('status', '0')->with('users.userable')->orderBy('created_at', 'desc')->whereHas('users', function ($query) use($user_id){
            $query->where('user_id', '=' , $user_id);
        })->get();

        $data['published_announcements'] = Announcement::where('status', '1')->with('users.userable')->orderBy('created_at', 'desc')->whereHas('users', function ($query) use($user_id){
            $query->where('user_id', '=' , $user_id);
        })->get();

        $data['completed_announcements'] = Announcement::where('status', '2')->with('users.userable')->orderBy('created_at', 'desc')->whereHas('users', function ($query) use($user_id){
            $query->where('user_id', '=' , $user_id);
        })->get();

        $data['announcements'] = Announcement::with('users.userable')->orderBy('created_at', 'desc')->whereHas('users', function ($query) use($user_id){
            $query->where('user_id', '=' , $user_id);
        })->paginate(10);

        $data['places'] = Announcement::places();

        return view('both.ads.list', compact('data'));
    }

    public function single()
    {
        return view('partials._announcement');
    }

    

    protected function getMessages()
    {
        return $message =[
            'place.required' => 'من فضلك أدخل المكان الذي تريد نشر إعلانك فيه',
            'place.string'   => 'المكان الذي تم إدخاله غير موجود، حاول مجددا',
        ];
    }

}


