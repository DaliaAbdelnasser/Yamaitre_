<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\ImageUploaderTrait;

class Task extends Model
{
    use HasFactory, ImageUploaderTrait;
    protected $fillable = [
        'title',
        'price',
        'court',
        'governorates',
        'status',
        'starting_date',
        'description',
        'task_file',
        'applicants_count',
        'chat_id'
    ];

    public static function titles()
    {
        return [
        ' خلاف وراثة' => ' خلاف وراثة',
        'خلاف محكمة أسرة' => 'خلاف محكمة أسرة',
        'خلاف حضانة أطفال' => 'خلاف حضانة أطفال',
        'فسخ تعاقدات' => 'فسخ تعاقدات',
        'خلاف إيجار قديم\جديد' => 'خلاف إيجار قديم\جديد',
        ];
    }

    public static function governorates()
    {
        return [
        'القاهرة' => 'القاهرة',
        'الأسكندرية' => 'الأسكندرية',
        'الجيزة' => 'الجيزة',
        'أسوان' => 'أسوان',
        'الفيوم' => 'الفيوم',
        'بني سويف' => 'بني سويف',
        'بورسعيد' => 'بورسعيد',
        'المنيا' => 'المنيا',
        'أسيوط' => 'أسيوط',
        'الغردقة' => 'الغردقة',
        'شرم الشيخ' => 'شرم الشيخ ',
        'المنوفية' => 'المنوفية',
        'الاسماعيلية' => 'الاسماعيلية',
        'الدقهلية' => 'الدقهلية',
        'الشرقية' => 'الشرقية',
        ];
    }

    public static function courts()
    {
        return [
            'محكمة شمال القاهرة الإبتدائية' => 'محكمة شمال القاهرة الإبتدائية',
            'محكمة جتوب القاهرة الإبتدائية' => 'محكمة جنوب القاهرة الإبتدائية',
            'محكمة القاهرة الجديدة الإبتدائية' => 'محكمة القاهرة الجديدة الإبتدائية',
            'محكمة حلوان الإبتدائية' => 'محكمة حلوان الإبتدائية',
            'محكمة شمال الجيزة الإبتدائية' => 'محكمة شمال الجيزة الإبتدائية',
            'محكمة شمال بنها الإبتدائية' => 'محكمة شمال بنها الإبتدائية ',
            'محكمة جتوب بنها الإبتدائية' => 'محكمة جنوب بنها الإبتدائية',
            'محكمة غرب الإسكندرية الإبتدائية' => 'محكمة شرق الإسكندرية الإبتدائية',
            'محكمة دمنهور الابتدائية' => 'محكمة دمنهور الابتدائية',
            'محكمة عابدين' => 'محكمة عابدين',
            'مجمع المحاكم بشارع الجلاء' => 'مجمع المحاكم بشارع الجلاء',
        ];
    }


    public function setTaxFileAttribute($file)
    {
        if ($file) {
            try {
                $fileName = $this->createFileName($file);

                $this->saveFile($file, $fileName);

                $this->attributes['task_file'] = $fileName;
            } catch (\Throwable $th) {

                $this->attributes['task_file'] = $file;
            }
        }
        return $fileName;
    }

    // relations 

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function applicantlawyers()
    {
        return $this->belongsToMany(User::class,'applied_task')->withPivot(['task_id', 'user_id', 'cost']);
    }

    // who make the invitation 
    public function recommenderlawyers()
    {
        return $this->belongsToMany(User::class,'recommended_task');
    }

    // who receive the invitation
    public function invitedlawyers()
    {
        return $this->belongsToMany(User::class,'invited_task');
    }

    // who make assignments
    public function assignedlawyers()
    {
        return $this->belongsToMany(User::class,'assigned_task')->withPivot(['task_id', 'user_id', 'assigner_id', 'cost']);
    }

    public function chat()
    {
        return $this->belongsTo(Task::class);
    }
}
