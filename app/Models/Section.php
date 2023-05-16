<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $fillable = [
        'section_title',
        'subtitle',
        'description',
    ];

    public function page(): HasMany
    {
        return $this->belongsTo(Page::class);
    }

    public function images()
    {
        return $this->hasMany(ImageSection::class);
    }
}
