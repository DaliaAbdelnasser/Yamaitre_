<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageSection extends Model
{
    use HasFactory;

    public $fillable = [
        'section_id',
        'img'
    ];

    public function section(): HasMany
    {
        return $this->belongsTo(Section::class);
    }


}
