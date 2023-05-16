<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\ImageUploaderTrait;


class ChatContent extends Model
{
    use ImageUploaderTrait;
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'chat_contents';

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Fillable fields.
     *
     * @var array
     */
    protected $fillable = [
        'chat_id',
        'senderable_id',
        'senderable_type',
        'seen', //0=>no, 1=>yes

        'message',
        'file',
        'file_name',
        'file_type'
    ];

    ##################################### Accessors ######################################

    // public function setPhotoAttribute($file)
    // {
    //     if ($file) {
    //         if (is_array($file)) {
    //             foreach ($file as $f) {
    //                 $fileName = $this->createFileName($f);

    //                 $this->saveChatFile($file, $fileName, 'photo');

    //                 $this->attributes['photo'] = $fileName;
    //             }
    //         } else {
    //             $fileName = $this->createFileName($file);

    //             $this->saveChatFile($file, $fileName, 'photo');

    //             $this->attributes['photo'] = $fileName;
    //         }
    //     }
    // }

    // public function setAudioAttribute($file)
    // {
    //     if ($file) {
    //         if (is_array($file)) {
    //             foreach ($file as $f) {
    //                 $fileName = $this->createFileName($f);

    //                 $this->saveChatFile($file, $fileName, 'audio');

    //                 $this->attributes['audio'] = $fileName;
    //             }
    //         } else {
    //             $fileName = $this->createFileName($file);

    //             $this->saveChatFile($file, $fileName, 'audio');

    //             $this->attributes['audio'] = $fileName;
    //         }
    //     }
    // }

    // public function setVideoAttribute($file)
    // {
    //     if ($file) {
    //         if (is_array($file)) {
    //             foreach ($file as $f) {
    //                 $fileName = $this->createFileName($f);

    //                 $this->saveChatFile($file, $fileName, 'video');

    //                 $this->attributes['video'] = $fileName;
    //             }
    //         } else {
    //             $fileName = $this->createFileName($file);

    //             $this->saveChatFile($file, $fileName, 'video');

    //             $this->attributes['video'] = $fileName;
    //         }
    //     }
    // }

    public function setFileAttribute($file)
    {
        if ($file) {
            if (is_array($file)) {
                foreach ($file as $f) {
                    $fileName = $this->createFileName($f);

                    $this->saveFile($file, $fileName, 'file');

                    $this->attributes['file'] = $fileName;
                }
            } else {
                $fileName = $this->createFileName($file);

                $this->saveFile($file, $fileName, 'file');

                $this->attributes['file'] = $fileName;
            }
        }
    }
    

    ##################################### Mutators ######################################

    // public function getPhotoAttribute()
    // {
    //     if ($this->attributes['photo'] != null) {

    //         return asset('uploads/chat/' . $this->attributes['photo']);
    //     }
    //     return null;
    // }

    // public function getAudioAttribute()
    // {
    //     if ($this->attributes['audio'] != null) {

    //         return asset('uploads/chat/' . $this->attributes['audio']);
    //     }
    //     return null;
    // }

    // public function getVideoAttribute()
    // {
    //     if ($this->attributes['video'] != null) {

    //         return asset('uploads/chat/' . $this->attributes['video']);
    //     }
    //     return null;
    // }

    // public function getFileAttribute()
    // {
    //     if ($this->attributes['file'] != null) {
    //         return asset('uploads/files/' . $this->attributes['file']);
    //     }
    //     return null;
    // }

    ##################################### Appends ######################################


    protected $appends = ['sender', 'update_at_readable', 'type_chat', 'is_you'];

    public function getSenderAttribute()
    {
        if ($this->senderable_type == 'App\\Models\\Lawyer') {
            return 'lawyer';
        }

        return 'client';
    }

    public function getSenderDataAttribute()
    {
        return $this->senderable;
    }

    public function getUpdateAtReadableAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getTypeChatAttribute()
    {
        return 1;
    }

    public function getIsYouAttribute()
    {
        if($this->senderable_id == auth()->user()->id){
            return true;
        }
        return false;
    }

    ##################################### Relations ######################################

    public function senderable()
    {
        return $this->morphTo();
    }

    public function chatRoom()
    {
        return $this->belongsTo(Chat::class);
    }
}
