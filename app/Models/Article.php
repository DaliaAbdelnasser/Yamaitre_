<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\ImageUploaderTrait;


class Article extends Model
{
    use HasFactory, ImageUploaderTrait;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'author_name',
        'image_feature',
        'description',
        'status',
    ];

    public function setFileAttribute($file)
    {
        if ($file) {
            try {
                $fileName = $this->createFileName($file);

                $this->saveFile($file, $fileName);

                $this->attributes['image_feature'] = $fileName;
            } catch (\Throwable $th) {

                $this->attributes['image_feature'] = $file;
            }
        }
        return $fileName;
    }

    // relations 
    // public function lawyers()
    // {
    //     return $this->belongsToMany(Lawyer::class);
    // }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function articles_images()
    {
         return $this->hasMany(ArticlesImage::class);   
    }

    
}
