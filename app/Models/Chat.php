<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Chat extends Model
{
    use SoftDeletes;

    public $table = 'chats';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'sender_id',
        'reciever_id',
        'count_new_message_sender',
        'count_new_message_reciever',
        'type', //1 => chat, 2 => private
        'chat_channel',
        'tasks_id',
    ];

    protected $casts = [
        'id'                            => 'integer',
        'sender_id'                     => 'integer',
        'reciever_id'                   => 'integer',
        'type'                          => 'integer',
        'count_new_message_sender'      => 'integer',
        'count_new_message_reciever'    => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static function rules()
    {
        $rules = [
            'sender_id'    => 'required|exists:users,id',
            'reciever_id'  => 'required|exists:users,id',
            'type'         => 'required|in:1,2'
        ];

        return $rules;
    }

    ##################################### Appends ######################################


    // protected $appends = ['other', 'new_messages'];

    public function getNewMessagesAttribute()
    {
        return $this->content()->where('seen', 0)->count()??0;
    }

    public function scopeChat($query)
    {
        return $query->where('type', 1);
    }

    public function scopePrivate($query)
    {
        return $query->where('type', 2);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function task()
    {
        return $this->hasMany(Task::class);
    }

    public function reciever()
    {
        return $this->belongsTo(User::class, 'reciever_id');
    }

    public function content()
    {
        return $this->hasMany(ChatContent::class)->orderBy('created_at', 'asc');
    }

    public function rooms_chat()
    {
        return $this->hasMany(Chat::class);
    }
}
