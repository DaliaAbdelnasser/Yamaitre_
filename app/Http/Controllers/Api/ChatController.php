<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chat;
use App\Models\ChatContent;
use App\Events\ChatEvent;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;




class ChatController extends Controller
{

    public function chatList()
    {
       
        $user = auth()->user();


        $chats = Chat::with('sender.userable', 'reciever.userable','content' )->where('sender_id', $user->id)->orWhere('reciever_id', $user->id)->orderBy('created_at', 'desc')->get();

        if(!count($chats))
        {
            return response([
                'success' => true,
                'chats'    => [],
            ], 200);
        }

        foreach($chats as $key => $chat)
        {
            if($chat->reciever->id == auth()->user()->id)
            {
                $reciever = $chat->sender;
            }
            else
            {
                $reciever = $chat->reciever;
            }

            $content = $chat->content()->get();
         
            if(count($content) == 0){
                $content;
            }
            else{
                $content = $content->last();
            }

            $data[$key]['chat'] = [ 
                'chat_channel' => $chat->chat_channel,
                'chat_id' =>  $chat->id,
                'user' => $reciever,
                'content' => $content,
            ];


        }

        return response([
            'success' => true,
            'chats'    => $data,
        ]);
    }


    public function rooms()
    {
        $user = auth()->user();
        $chats = Chat::with('sender.userable', 'reciever.userable', 'content')->where('sender_id', $user->id)->orWhere('reciever_id', $user->id)->orderBy('created_at', 'desc')->get();
        $singlechat = null;
        if($chats != null)
        {
            return view('chat.room', compact('chats', 'singlechat'));
        }
        else
        {
            return view('chat.room');
        }
    }

    public function room($id)
    {
        $user = auth()->user();
        $chats = Chat::with('sender.userable', 'reciever.userable', 'content')->where('sender_id', $user->id)->orWhere('reciever_id', $user->id)->orderBy('created_at', 'desc')->get();
        $singlechat = Chat::with('sender.userable', 'reciever.userable', 'content')->where([['id', $id],['sender_id', $user->id]])->orWhere([['id', $id],['reciever_id', $user->id]])->find($id);
        // dd($singlechat);
        if($singlechat == null)
        {
            abort(404);
        }
        if($chats != null)
        {
            return view('chat.room', compact('chats', 'singlechat'));
        }
        else
        {
            return view('chat.room');
        }
    }
    
    // public function start_chat($id)
    // {
    //     $sender = auth()->user(); 
    //     $reciever = User::find($id);
    //     $chat = Chat::create([
    //         'sender_id'  => $sender->id,
    //         'reciever_id'=> $reciever->id,
    //         'type' => 2,
    //     ]);

    //     $chat_id = $chat->id;
    //     $chat->update(['chat_channel' => "chat-".$chat_id]);

    //     $data['chat'] = $chat->id;
    //     $data['channel'] = 'chat-' . $chat->id;


    //     return response([
    //         'success' => true,
    //         'message' => 'يمكنك الآن بدأ المحادثة مع المحامي',
    //         'data'    => $data,
    //     ]);

    // }

    public function start_chat($sender_id, $id)
    {
        $reciever = User::find($id);
        
        if(Chat::where(['sender_id' =>  $sender_id, 'reciever_id' => $reciever->id])->first() == null && Chat::where(['sender_id' =>  $reciever->id, 'reciever_id' => $sender_id])->first() == null)
        {
            $chat = Chat::create([
                'sender_id'  => $sender_id,
                'reciever_id'=> $reciever->id,
                'type' => 2,
            ]);

            $sender = User::find($sender_id);

            // $chat->content()->create([
            //     'senderable_id'     => $sender_id,
            //     'senderable_type'   => $sender->userable_type,
            //     'message'           => " ",
            // ]);
    
            $chat_id = $chat->id;
            $chat->update(['chat_channel' => "chat-".$chat_id]);
    
            $data['chat'] = $chat->id;
            $data['channel'] = 'chat-' . $chat->id;
        }
        // elseif( Chat::where(['sender_id' =>  $reciever->id, 'reciever_id' => $sender_id])->first() == null)
        // {
        //     $chat = Chat::create([
        //         'sender_id'  => $reciever->id,
        //         'reciever_id'=> $sender_id,
        //         'type' => 2,
        //     ]);

        //     $chat_id = $chat->id;
        //     $chat->update(['chat_channel' => "chat-".$chat_id]);
    
        //     $data['chat'] = $chat->id;
        //     $data['channel'] = 'chat-' . $chat->id;
        // }

        // return response([
        //     'success' => false,
        //     'type' => 'alreadyStartedChatBefores',
        //     'errors'=> 'تم فتح شات من قبل',
        // ], 422);

    }


    public function sendMessage(Request $request, $chat_id)
    {

        $chat = Chat::with('sender', 'reciever', 'content')->find($chat_id);
      
        $messages = $this->getMessages();

        $filesize = Validator::make($request->all(), ['file'  => 'max:3072'], $messages);

        if ($filesize->fails()) {
            return response([
                'success' => false,
                'type' => 'exceededMaxFileSize',
                'errors'=>$filesize->errors()->first(),
            ], 422);
        }

        $filetype = Validator::make($request->all(), ['file'  => 'mimes:jpg,jpeg,png,pdf,xlsx,doc,docx'], $messages);

        if ($filetype->fails()) {
            return response([
                'success' => false,
                'type' => 'notAllowedFileType',
                'errors'=>$filetype->errors()->first(),
            ], 422);
        }


        $owner = auth()->user();
        $other = User::where('id', $chat->reciever_id)->first();

        $content = $chat->content()->create([
            'senderable_id'     => $owner->id,
            'senderable_type'   => $owner->userable_type,
            'message'           => $request->content,
        ]);

        
        if($request->file('file')){
            $content->file_name = $request->file('file')->getClientOriginalName();
            $content->setFileAttribute($request->file('file'));
            if(\File::extension($content->file) == 'jpg' || \File::extension($content->file) == 'jpeg' || \File::extension($content->file) == 'png')
            {
                $content->file_type = 'image';
            }
            else
            {
                $content->file_type = 'file';
            }
            if($content->message == null)
            {
                $content->message = " ";
            }
        }
        
        $content->save();

        if($chat->sender->id == auth()->user()->id)
        {
            $sender_data['user'] = $chat->sender;
            $sender_data['user']['userable'] = $chat->sender->userable;

            $reciever_data['user'] = $chat->reciever;
            $reciever_data['user']['userable'] = $chat->reciever->userable;
        }
        else
        {
            $sender_data['user'] = $chat->reciever;
            $sender_data['user']['userable'] = $chat->reciever->userable;

            $reciever_data['user'] = $chat->sender;
            $reciever_data['user']['userable'] = $chat->sender->userable;
        }


        event(new ChatEvent(['data_to' => $reciever_data, 'data' => $content, 'send_to' => $other->pusher_channel, 'channel' => $chat->chat_channel, 'sender_data' => $sender_data]));

        if($reciever_data['user']->userable_type == 'App\Models\Lawyer')
        {
            $url = 'lawyer/chats/room/'. $chat->id;
        }
        else
        {
            $url = 'client/chats/room/'. $chat->id;
        }

        app('App\Http\Controllers\NotificationController')->sendNotification($reciever_data['user']->device_token, 'رسالة واردة جديدة', 'لديك رسالة واردة جديدة من '.$sender_data['user']->first_name.' ',  $sender_data['user']->id, $reciever_data['user']->id, $url, 'chat', $chat->id);

        return response([
            'success' => true,
            'message'    => "تم إرسال الرسالة بنجاح",
        ]);
    }

    public function sendWeb(Request $request, $chat_id)
    {
        $chat = Chat::with('sender', 'reciever', 'content')->find($chat_id);

        $owner = auth()->user();
        $other = User::where('id', $chat->reciever_id)->first();

        $content = $chat->content()->create([
            'senderable_id'     => $owner->id,
            'senderable_type'   => $owner->userable_type,
            'message'           => $request->message,
        ]);

        if($request->file('file') != null){
            $content->file_name = $request->file('file')->getClientOriginalName();
            $content->setFileAttribute($request->file('file'));
            if(\File::extension($content->file) == 'jpg' || \File::extension($content->file) == 'jpeg' || \File::extension($content->file) == 'png')
            {
                $content->file_type = 'image';
            }
            else
            {
                $content->file_type = 'file';
            }
            if($content->message == null)
            {
                $content->message = " ";
            }
        }
        $content->save();

        if($chat->sender->id == auth()->user()->id)
        {
            $sender_data['user'] = $chat->sender;
            $sender_data['user']['userable'] = $chat->sender->userable;

            $reciever_data['user'] = $chat->reciever;
            $reciever_data['user']['userable'] = $chat->reciever->userable;
        }
        else
        {
            $sender_data['user'] = $chat->reciever;
            $sender_data['user']['userable'] = $chat->reciever->userable;

            $reciever_data['user'] = $chat->sender;
            $reciever_data['user']['userable'] = $chat->sender->userable;
        }

        event(new ChatEvent(['data_to' => $reciever_data, 'data' => $content, 'send_to' => $other->pusher_channel, 'channel' =>  $chat->chat_channel, 'sender_data' => $sender_data]));

        if($reciever_data['user']->userable_type == 'App\Models\Lawyer')
        {
            $url = 'lawyer/chats/room/'. $chat->id;
        }
        else
        {
            $url = 'client/chats/room/'. $chat->id;
        }

        app('App\Http\Controllers\NotificationController')->sendNotification($reciever_data['user']->device_token, 'رسالة واردة جديدة', 'لديك رسالة واردة جديدة من '.$sender_data['user']->first_name. ' ',  $sender_data['user']->id, $reciever_data['user']->id, $url, 'chat', $chat->id);

        return response([
            'success' => true,
            'msg'    => "تم إرسال الرسالة بنجاح",
        ]);
    }

    public function recieveMessage($chat_id)
    {
        $user = auth()->user();

        $chat = Chat::with('sender', 'reciever', 'content')->find($chat_id);
        
        if($chat->sender_id != $user->id && $chat->reciever_id != $user->id)
        {
            return response([
                'success' => false,
                'type' => 'noAccess',
                'errors'=> 'ليس لديك صلاحيات لمشاهدة الرسائل',
            ], 403);
        }

        if($chat == null)
        {
            return response([
                'success' => false,
                'type' => 'noChatsYet',
                'errors'=> 'لم يتم فتح محادثات بعد',
            ], 422);
        }

        $query = ChatContent::query()->with('senderable.user')->where('chat_id', $chat->id);

        // if( request()->filled('offset') ){
        //     $query->offset( request('offset') );
        // }

        // $query->limit( request('limit') ?? 10 );


        $messages = $query->orderBy('created_at', 'desc')->get();


        $unseened = 0;
        foreach($messages as $message)
        {
            
            if($message->is_you != true  && $message->seen == 0)
            {
                $unseened += 1;
                $message->update(['seen' => 1]);
            }
        }

        $data['your unseened messages'] = $unseened;
        $data['content'] = $messages;

        // foreach($data['content'] as $key => $message)
        // {
        //     if($message->file != null)
        //     {
        //         $data['content']['file_type'] = \File::extension($message->file);
        //     }
        // }

        return response([
            'success' => true,
            'data'    => $data,
        ]);
    }

    public function test(Request $request)
    {
        $data = Validator::make($request->all(), [
            'username' => 'required',
            'message' => 'required'
        ]);

        $message = [
            'username' => $request->username,
            'message' => $request->message
        ];

        event(new ChatEvent($message));

        return ['success' => true];
    }

    protected function getMessages(){
        return $message = [
            'file.max'    =>   'الملف الذي أدخلته كبير الحجم، من فضلك أعد المحاولة',
            'file.mimes'  =>   'من فضلك أدخل ملفا صالحا', 
        ];
    }
}
