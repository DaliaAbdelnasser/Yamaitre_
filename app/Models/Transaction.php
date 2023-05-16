<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'method',
        'status',
        'amount',
        'order_id'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class,'transaction_user','transaction_id', 'user_id')->withPivot(['transaction_id', 'user_id', 'to_user_id', 'mission_type', 'name', 'amount', 'description', 'mission_id', 'tax_password', 'tax_file']);
    }

    public function files()
    {
        return $this->hasMany(TransactionFiles::class);   
    }

}
