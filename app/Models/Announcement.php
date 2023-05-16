<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\ImageUploaderTrait;


class Announcement extends Model
{
    use HasFactory, ImageUploaderTrait;

    protected $fillable = [
        'place',
        'url',
        'period',
        'price',
        'image',
        'mob_image',
        'status',
        'usertype',
    ];




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
            return $fileName;
        }
    }

    public function setMobFileAttribute($file)
    {
        if ($file) {
            try {
                $fileName = $this->createFileName($file);

                $this->saveFile($file, $fileName);

                $this->attributes['mob_image'] = $fileName;
            } catch (\Throwable $th) {

                $this->attributes['mob_image'] = $file;
            }
            return $fileName;
        }
    }

    public static $rules = [
        'period'        => 'numeric',
        'price'        => 'numeric',
        'url'  =>  'required|url',
        'image' => 'required|mimes:jpg,png',
        'mob_image' => 'required|mimes:jpg,png',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public static function places()
    {
        return [
            // 'tasks' => 'صفحة المهام',
            // 'tasks/' => 'صفحات المهمات الداخلية',
            // 'lawyers' => 'صفحة المحامين',
            // 'articles' => 'صفحة المنشورات',
            // 'articles/' => 'صفحات المنشورات الداخلية',
            // 'distresses' => 'صفحة الاستغاثة',
            // 'distresses/' => 'صفحات الاستغاثة الداخلية',
            'home'  => 'الصفحة الرئيسية',
            'pages' => 'الصفحات الداخلية',
            'all'   => 'كل الصفحات'
        ];
    }
}
