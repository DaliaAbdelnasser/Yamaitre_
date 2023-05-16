<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'rating',
        'lawyer_id',
    ];

    // relation one-to-many
    public function lawyer()
    {
        return $this->belongsTo(Lawyer::class);
    }
}
