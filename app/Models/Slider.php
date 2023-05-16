<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\ImageUploaderTrait;


class Slider extends Model
{
    use HasFactory;
    
    public $fillable = [
        'title',
        'subtitle',
        'image',
    ];


    public function setImageAttribute($file)
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
        // return $fileName;
    }
}
