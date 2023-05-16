<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use App\Helpers\ImageUploaderTrait;
//use App\Models\HasFactory;

class Client extends Model
{
    use HasFactory, ImageUploaderTrait;

    protected $fillable = [
        'governorates',
        'profile_image',
    ];

    public static function governorates()
    {
        return [
            'القاهرة'       => 'القاهرة',
            'الجيزة'	=>   'الجيزة',
            'الإسكندرية'	=>  'الإسكندرية',
            'الدقهلية'	=> 'الدقهلية',
            'البحر الأحمر'	=> 'البحر الأحمر',
            'البحيرة'	=> 'البحيرة',
            'الفيوم'	=> 'الفيوم',
            'الغربية'	=>  'الغربية',
            'الإسماعلية'	=> 'الإسماعلية',
            'المنوفية'	=> 'المنوفية',
            'المنيا'	=> 'المنيا',
            'القليوبية'	=> 'القليوبية',
            'الوادي الجديد' => 'الوادي الجديد',
            'السويس'	=>  'السويس',
            'أسوان'	=> 'أسوان',
            'أسيوط'	=> 'أسيوط'	,
            'بني سويف'	 => 'بني سويف',
            'بورسعيد' => 'بورسعيد',
            'دمياط'	=>  'دمياط',
            'الشرقية'	=> 'الشرقية',
            'جنوب سيناء' =>  'جنوب سيناء' ,
            'كفر الشيخ'	  => 'كفر الشيخ',
            'مطروح'	=> 'مطروح',
            'الأقصر'	=> 'الأقصر',
            'قنا'	=> 'قنا',
            'شمال سيناء' => 'شمال سيناء',
            'سوهاج'=>  'سوهاج',
        ];
    }

    public function setProfileImageAttribute($file)
    {
        if ($file) {
            try {
                $fileName = $this->createFileName($file);

                $this->saveFile($file, $fileName);

                $this->attributes['profile_image'] = $fileName;
            } catch (\Throwable $th) {

                $this->attributes['profile_image'] = $file;
            }
        }
    }

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function consultations()
    {
        return $this->belongsToMany(Consultation::class);
    }

   
    
    public function rooms_chat()
    {
        return $this->hasMany(Chat::class);
    }
}
