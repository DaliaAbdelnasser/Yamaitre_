<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\ImageUploaderTrait;

class Consultation extends Model
{
    use HasFactory, ImageUploaderTrait;

    protected $fillable = [
        'type',
        'description',
        'payment_status',
        'feedback'
    ];

    // relations 
    public function clients()
    {
        return $this->belongsToMany(Client::class);
    }

    public function files()
    {
         return $this->hasMany(Files::class);   
    }
}
