<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chat;
use App\Models\ChatContent;

class ChatController extends Controller
{
    public function index()
    {

        $query = Chat::query()->with('sender.userable', 'reciever.userable', 'content');

        if (request()->filled('search')) {
            $query->whereHas('sender', function ($query) {
                $query->where('first_name', 'LIKE', '%' . request('search') . '%')
                ->orWhere('last_name', 'LIKE', '%' . request('search') . '%');
            })->get();
        }
        

        $chats = $query->orderBy('created_at', 'DESC')->paginate(10);

        return view('admin.chats.index', compact('chats'));   
    }

    public function show($chat_id)
    {
        $chat = Chat::with('sender.userable', 'reciever.userable', 'content')->find($chat_id);
        return view('admin.chats.show', compact('chat'));   
    }
}
