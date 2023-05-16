<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lawyer;
use App\Models\Announcement;
use Illuminate\Support\Facades\Validator;
use File;
use App\Mail\NotifyMail;
use App\Models\News;
use Illuminate\Support\Facades\Mail;

class AnnouncementController extends Controller
{

    // get all announcments 
    public function index()
    {

        $query = Announcement::query()->where('status', '1');

        if( request()->filled('place') ){
            $query->where('place', request('place') )->orWhere('place', 'all');
        }

        $query->limit( request('limit') ?? 10 );

       
        $user = auth()->user();

        if($user->userable_type == 'App\Models\Lawyer'){
            $data['announcements'] = $query->where('usertype', 'lawyer')->orWhere('usertype', 'all')->orderBy('created_at', 'desc')->get();
            $data['news'] = News::where('usertype', 'lawyer')->orWhere('usertype', 'all')->get();
        }
        elseif($user->userable_type == 'App\Models\Client'){
            $data['announcements'] = $query->where('usertype', 'client')->orWhere('usertype', 'all')->orderBy('created_at', 'desc')->get();
            $data['news'] = News::where('usertype', 'client')->orWhere('usertype', 'all')->get();
        }

        return response()->json($data);

    }

    // request announcement
    public function store(Request $request)
    {
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),
            [
                'place'       => 'required',     
            ], $messages);

        if ($validator->fails()) {
            return response([
                'success' => false,
                'type' => 'noPlaceAdded',
                'errors'=>$validator->errors()->first(),
            ], 422);
        }

        $placevalidator = Validator::make($request->all(),
        [
            'place'       => 'string',     
        ], $messages);

        if ($placevalidator->fails()) {
            return response([
                'success' => false,
                'type' => 'notValidPlace',
                'errors'=>$placevalidator->errors()->first(),
            ], 422);
        }
        
        $user = auth()->user();

        if($user->userable_type == 'App\Models\Lawyer')
        {
            $lawyer = Lawyer::where('id', $user->userable->id)->first();
            if($lawyer->status == 1)
            {
                $announcement = Announcement::create($request->all());
                $announcement->update(['mob_image' => 'default_mob_banner.jpeg']);
                $user->announcements()->attach($announcement->id);
                Mail::to($user->email)->send(new NotifyMail($user, 'emails.requestSomething', 'Announcement Request', 'تم استلام طلب الإعلان الخاص بك وسيقوم فريق المبيعات بالتواصل معك في أقرب وقت ممكن'));
                return response()->json([
                    'success' => true,
                    'message' => __('messages.create_announcement')]);
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
            $announcement = Announcement::create($request->all());
            $announcement->update(['mob_image' => 'default_mob_banner.jpeg']);
            $user->announcements()->attach($announcement->id);
            Mail::to($user->email)->send(new NotifyMail($user, 'emails.requestSomething', 'Announcement Request', 'تم استلام طلب الإعلان الخاص بك وسيقوم فريق المبيعات بالتواصل معك في أقرب وقت ممكن'));
            
            return response()->json([
                'success' => true,
                'message' => __('messages.create_announcement')]);
        }
        
    }


    // To get all announcements of a specific user
    public function readSingle()
    {
        $userData = auth()->user();
        $user_id = $userData->id;

        $query = Announcement::query();

        if( request()->filled('offset') ){
            $query->offset( request('offset') );
        }

        $query->limit( request('limit') ?? 10 );

        $lawyer_announcements = $query->with('users.userable')->orderBy('created_at', 'desc')->whereHas('users', function ($query) use($user_id){
            $query->where('user_id', '=' , $user_id);
        })->get();

        return response()->json(['Announcement' => $lawyer_announcements]);
    }

    protected function getMessages()
    {
        return $message =[
            'place.required' => 'من فضلك أدخل المكان الذي تريد نشر إعلانك فيه',
            'place.string'   => 'المكان الذي تم إدخاله غير موجود، حاول مجددا',
        ];
    }

}
