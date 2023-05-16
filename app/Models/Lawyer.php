<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Article;
use App\Models\Announcement;
use App\Models\Task;
use App\Models\Distress;
use App\Models\Tax;
use App\Models\User;
use App\Helpers\ImageUploaderTrait;

class Lawyer extends Model
{
    use HasFactory, ImageUploaderTrait;

    protected $fillable = [
        'governorates',
        'court_name',
        'id_photo',
        'description',
        'profile_image',
        'status',
        'rate',
        'tasks_count'
    ];
    
    protected $casts = [
        'governorates'  => 'string',
        'court_name'    => 'string',
        'id_photo'      => 'string',
        'description'   => 'string',
        'profile_image' => 'string',
        'status'        => 'boolean',
    ];

    public static $rules = [
        'governorates'  => 'required|string',
        'court_name'    => 'required|string',
        'id_photo'      => 'required|string|mimes:jpg,png,pdf',
        'description'   => 'required|string',
        'profile_image' => 'nullable|string|mimes:jpg,png',
    ];

    ##################################### Helpers ######################################

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

    public static function courts()
    {
        return [
            'محكمة شمال القاهرة الإبتدائية' => 'محكمة شمال القاهرة الإبتدائية',
            'محكمة جنوب القاهرة الإبتدائية' => 'محكمة جنوب القاهرة الإبتدائية',
            'محكمة القاهرة الجديدة الإبتدائية' => 'محكمة القاهرة الجديدة الإبتدائية',
            'محكمة حلوان الإبتدائية' => 'محكمة حلوان الإبتدائية',
            'محكمة شمال الجيزة الإبتدائية' => 'محكمة شمال الجيزة الإبتدائية',
            'محكمة شمال بنها الإبتدائية' => 'محكمة شمال بنها الإبتدائية ',
            'محكمة جنوب بنها الإبتدائية' => 'محكمة جنوب بنها الإبتدائية',
            'محكمة غرب الإسكندرية الإبتدائية' => 'محكمة شرق الإسكندرية الإبتدائية',
            'محكمة دمنهور الابتدائية' => 'محكمة دمنهور الابتدائية',
            'محكمة عابدين' => 'محكمة عابدين',
            'مجمع المحاكم بشارع الجلاء' => 'مجمع المحاكم بشارع الجلاء',
        ];
    }

    ##################################### Scopes ######################################

    public function scopeActive($query)
    {
        $query->where('status', 1);
    }

    ##################################### Save Files ######################################

    public function setIdFileAttribute($file)
    {
        if ($file) {
            try {
                $fileName = $this->createFileName($file);

                $this->saveFile($file, $fileName);

                $this->attributes['id_photo'] = $fileName;
            } catch (\Throwable $th) {

                $this->attributes['id_photo'] = $file;
            }
        }
        // return $fileName;
    }

    // public function getIdFileOriginalPathAttribute()
    // {
    //     return $this->id_photo ? asset('uploads/images/original/' . $this->id_photo) : null;
    // }

    // public function getIdFileThumbnailPathAttribute()
    // {
    //     return $this->id_photo ? asset('uploads/images/thumbnail/' . $this->id_photo) : null;
    // }


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

    // public function getProfileImageOriginalPathAttribute()
    // {
    //     return $this->profile_image ? asset('uploads/images/original/' . $this->profile_image) : null;
    // }

    // public function getProfileImageThumbnailPathAttribute()
    // {
    //     return $this->profile_image ? asset('uploads/images/thumbnail/' . $this->profile_image) : null;
    // }

    ##################################### RELATIONS ######################################

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function taxes()
    {
        return $this->belongsToMany(Tax::class, 'lawyer_tax');
    }

    
    // relation one-to-many
    public function ratings()
    {
        return $this->hasMany(Review::class);
    }

    public function rooms_chat()
    {
        return $this->hasMany(Chat::class);
    }
}
