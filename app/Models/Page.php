<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'meta_title',
        'meta_desc',
    ];

    // relation one-to-many
    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    // relation one-to-many
    public function faqs()
    {
        return $this->hasMany(Faq::class);
    }
}
