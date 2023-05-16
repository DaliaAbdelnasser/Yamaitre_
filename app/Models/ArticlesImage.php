<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\ImageUploaderTrait;

class ArticlesImage extends Model
{
    use HasFactory, ImageUploaderTrait;
    
    protected $fillable = ['article_id', 'image'];

    public function setFileAttribute($file)
    {
        if ($file) {
            try {
                $fileName = $this->createFileName($file);

                $this->saveFile($file, $fileName);

                $this->attributes['image'] = $fileName;
            } catch (\Throwable $th) {

                $this->attributes['image'] = $file;
            }
        }
        return $fileName;
    }

    public function Article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }
}
