<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public $table = 'notifications';

    public $fillable = [
        'from_user',
        'to_user',
        'title',
        'body',
        'url',
    ];

    protected $casts = [
        'from_user'               => 'integer',
        'to_user'                 => 'integer',
        'title'                   => 'string',
        'body'                    => 'string',
        'url'                     => 'string',
    ];

    public function sender(): HasOne
    {
        return $this->belongsTo(User::class, 'from_user');
    }

    public function receiver(): HasOne
    {
        return $this->belongsTo(User::class, 'to_user');
    }
}

