<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\ImageUploaderTrait;

class Tax extends Model
{
    use HasFactory, ImageUploaderTrait;

    protected $fillable = [
        'status',
        'tax_file',
        'tax_name',
        'tax_password',
        'notes',  
        'payment_status',
        'feedback'   
    ];

    public function setTaxFileAttribute($file)
    {
        if ($file) {
            try {
                $fileName = $this->createFileName($file);

                $this->saveFile($file, $fileName);

                $this->attributes['tax_file'] = $fileName;
            } catch (\Throwable $th) {

                $this->attributes['tax_file'] = $file;
            }
        }
    }

    public function setFeedbackFileAttribute($file)
    {
        if ($file) {
            try {
                $fileName = $this->createFileName($file);

                $this->saveFile($file, $fileName);

                $this->attributes['feedback'] = $fileName;
            } catch (\Throwable $th) {

                $this->attributes['feedback'] = $file;
            }
        }
    }

    public function lawyers()
    {
        return $this->belongsToMany(Lawyer::class);
    }
}
