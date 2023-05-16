<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\ImageUploaderTrait;

class TransactionFiles extends Model
{
    use HasFactory, ImageUploaderTrait;

    protected $fillable = ['transaction_id', 'file'];

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
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }

}
