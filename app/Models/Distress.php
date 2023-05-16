<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lawyer;

class Distress extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'governorate',
        'description',
    ];
 
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public static function governorates()
    {
        return [
            ' القاهرة' => ' القاهرة',
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

    public static function types()
    {
        return [
            'نداء استغاثة عاجل للتجمع امام فرع النقابة بمحافظ الاسكندرية' => 'نداء استغاثة عاجل للتجمع امام فرع النقابة بمحافظ الاسكندرية',
            'نداء عاجل للتجمع أمام القضاء العالي' => 'نداء عاجل للتجمع أمام القضاء العالي',
            'مشكلة شخصية' => 'مشكلة شخصية',
        ];
    }
}
