<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\ImageUploaderTrait;

class Files extends Model
{
    use HasFactory, ImageUploaderTrait;
    protected $fillable = ['consultation_id', 'file'];

    public function setFileAttribute($file)
    {
        if ($file) {
            try {
                $fileName = $this->createFileName($file);

                $this->saveFile($file, $fileName);

                $this->attributes['file'] = $fileName;
            } catch (\Throwable $th) {

                $this->attributes['file'] = $file;
            }
        }
        return $fileName;
    }

    public function Consultation()
    {
        return $this->belongsTo(Consultation::class, 'consultation_id');
    }
}
