<!-- Name Field -->
<div class="form-group col-sm-6 mt-5">
    {!! Form::label('first_name', 'الأسم الأول :', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
    {!! Form::text('first_name', null, ['class' => 'form-control form-control-lg form-control-solid']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6 mt-5">
    {!! Form::label('last_name', 'الأسم الثاني :', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
    {!! Form::text('last_name', null, ['class' => 'form-control form-control-lg form-control-solid']) !!}
</div>

<!-- Mobile Field -->
<div class="form-group col-sm-6 mt-5">
    {!! Form::label('phone', 'رقم الهاتف :', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
    {!! Form::text('phone', null, ['class' => 'form-control form-control-lg form-control-solid']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6 mt-5">
    {!! Form::label('email', 'البريد الإلكتروني :', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
    {!! Form::email('email', null, ['class' => 'form-control form-control-lg form-control-solid']) !!}
</div>

<!-- Governorates Field -->
<div class="form-group col-sm-6 mt-5">
    {!! Form::label('governorates', 'المحافظة :', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
    {!! Form::select('governorates',[' القاهرة' => ' القاهرة'
        ,'الأسكندرية' => 'الأسكندرية',
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
        ],'null',['class'=>'form-control form-control-lg form-control-solid','placeholder'=>'اختر المحافظة']) !!}
</div>

<!-- Court Field -->
<div class="form-group col-sm-12 mt-5">
    {!! Form::label('court_name', ' المحكمة التابع لها :', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
    {!! Form::select('court_name',['محكمة شمال القاهرة الابتدائية'
        ,'محكمة جنوب القاهرة الابتدائية',
        'محكمة الجيزة الابتدائية',
        'محكمة إسكندرية الابتدائية',
        'محكمة دمنهور الابتدائية',
        'محكمة عابدين',
        'مجمع المحاكم بشارع الجلاء',
            ],'اختر',['class'=>'form-control form-control-lg form-control-solid','placeholder'=>'اختر المحكمة']) !!}

</div>

<!-- ID Photo Field -->
<div class="form-group col-sm-12 mt-5">
    {!! Form::label('id_photo', 'صورة الكارنيه :',  [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
    {!! Form::file('id_photo', array_merge(['class' => 'form-control form-control-lg form-control-solid', 'accept' => ".png, .jpg, .jpeg"])) !!}
</div>


<!-- Profile Image Field -->
<div class="form-group col-sm-12 mt-5">
    {!! Form::label('profile_image', 'الصورة الشخصية :',   [ 'class' => 'form-label fs-6 fw-bolder text-dark ']) !!}
    {!! Form::file('profile_image', array_merge(['class' => 'form-control form-control-lg form-control-solid', 'accept' => ".png, .jpg, .jpeg"])) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-6 mt-5">
    {!! Form::label('password', 'الرمز السري :', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
    {!! Form::password('password', ['class' => 'form-control form-control-lg form-control-solid']) !!}
</div>

<!-- Password Confirmation Field -->
<div class="form-group col-sm-6 mt-5">
    {!! Form::label('password', 'تأكيد الرمز السري :', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control form-control-lg form-control-solid']) !!}
</div>

<!-- Accept Terms Confirmation Field -->
<div class="form-group col-sm-12 mt-5">
{!! Form::checkbox('accept_terms', 'true') !!}
{!! Form::label('accept_terms', 'الموافقة على الشروط والأحكام', [ 'class' => 'form-label fs-6 fw-bolder text-dark ']) !!}
</div>



<!-- Submit Field -->
<div class="form-group col-sm-12 mt-5">
    {!! Form::submit('حفظ', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.lawyers.index') }}" class="btn btn-secondary">إلغاء</a>
</div>



