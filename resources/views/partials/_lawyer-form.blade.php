<div class="form-group col-md-6">
    {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'الاسم الأول', 'required' => 'required']) !!}
    <i class="careerfy-icon careerfy-user"></i>
    @error('first_name')
    <div class="error">{{ $message }}</div>
    @enderror
</div>

<div class="form-group col-md-6">
    {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => ' الاسم الأخير', 'required' => 'required']) !!}
    <i class="careerfy-icon careerfy-user"></i>
    @error('last_name')
    <div class="error">{{ $message }}</div>
    @enderror
</div>

<div class="form-group col-md-6">
    {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'رقم الهاتف', 'required' => 'required']) !!}
    <i class="careerfy-icon careerfy-technology"></i>
    @error('phone')
    <div class="error">{{ $message }}</div>
    @enderror
</div>

<div class="form-group col-md-6">
    {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'البريد الالكتروني', 'required' => 'required']) !!}
    <i class="careerfy-icon careerfy-mail"></i>
    @error('email')
    <div class="error">{{ $message }}</div>
    @enderror
</div>

<div class="form-group col-md-6">
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
        ],'null',['class'=>'form-control','placeholder'=>'المحافظة محل العمل', 'required' => 'required']) !!}
        @error('governorates')
        <div class="error">{{ $message }}</div>
        @enderror
</div>

<div class="form-group col-md-6">
        {!! Form::select('court_name',['محكمة شمال القاهرة الابتدائية' => 'محكمة شمال القاهرة الابتدائية'
        ,'محكمة جنوب القاهرة الابتدائية' => 'محكمة جنوب القاهرة الابتدائية',
        'محكمة الجيزة الابتدائية' => 'محكمة الجيزة الابتدائية',
        'محكمة إسكندرية الابتدائية' => 'محكمة إسكندرية الابتدائية',
        'محكمة دمنهور الابتدائية' => 'محكمة دمنهور الابتدائية',
        'محكمة عابدين' => 'محكمة عابدين',
        'مجمع المحاكم بشارع الجلاء' => 'مجمع المحاكم بشارع الجلاء',
            ],'اختر',['class'=>'form-control','placeholder'=>'دائرة المحكمة التابع لها', 'required' => 'required']) !!}
        @error('court_name')
        <div class="error">{{ $message }}</div>
        @enderror
</div>

<div class="form-group col-md-6">
    <div class="d-flex justify-content-center wrapper align-items-center">
        <!-- <input type="file" name="file" id="filey" class="filey"> -->
        
        {!! Form::file('_image', array_merge(['class' => 'filey', 'accept' => ".png, .jpg, .jpeg"])) !!}
        <div class="d-flex">
            {!! Form::text('id_photo', null ,array_merge(['id' =>'filey-name', 'class' => 'filey-name form-control', 'readonly' => 'readonly', 'required' => 'required']) ) !!}
            {!! Form::button('ارفاق صورة الكارنيه',   [ 'class' => 'btny']) !!}
        </div>
    </div>
    <i class="careerfy-icon careerfy-paper" style="left: 165px;"></i>
    @error('id_photo')
    <div class="error">{{ $message }}</div>
    @enderror
</div>

<div class="form-group col-md-6">
    <!-- <input class="form-control" type="password" placeholder="كلمة المرور"> -->
    {!! Form::password('password', ['class' => 'form-control', 'placeholder' =>"كلمة المرور", 'required' => 'required']) !!}
    <i class="fa fa-lock"></i>
    @error('password')
    <div class="error">{{ $message }}</div>
    @enderror
</div>

<div class="form-group col-md-6">
    <!-- <input class="form-control" type="password" placeholder="تأكيد كلمة المرور"> -->
    {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => "تأكيد كلمة المرور", 'required' => 'required']) !!}
    <i class="fa fa-lock"></i>
</div>

<div class="form-group col-md-12">
{!! Form::checkbox('accept_terms', true, null, ['id' => 'accept_terms']) !!} <label for="accept_terms"> I consent to receiving Newsletters emails</label>
@error('accept_terms')
<div class="error">{{ $message }}</div>
@enderror
</div>

<div class="m-b-15 m-t-15 col-md-12">
    {!! Form::submit('التسجيل', ['class' => 'btn btn-primary pull-left submit-btn']) !!}
    <p class="pull-right p-t-10">لديك حساب بالفعل؟<a href="{{ route('login') }}" class="careerfy-open-signin-tab">قم بتسجيل الدخول</a></p>
</div>

