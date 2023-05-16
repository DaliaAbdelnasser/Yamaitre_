<div class="form-group col-md-12">
    {!! Form::hidden('user_type', 'lawyer', ['class' => 'form-control']) !!}
</div>

<div class="form-group col-md-6">
    {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'الاسم الأول']) !!}
    <i class="careerfy-icon careerfy-user"></i>
    @error('first_name')
    <div class="error">{{ $message }}</div>
    @enderror
    <span class="help-block"><strong></strong></span>

</div>

<div class="form-group col-md-6">
    {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => ' الاسم الأخير']) !!}
    <i class="careerfy-icon careerfy-user"></i>
    @error('last_name')
    <div class="error">{{ $message }}</div>
    @enderror
    <span class="help-block"><strong></strong></span>

</div>

<div class="form-group col-md-6">
    {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'رقم الهاتف']) !!}
    <i class="careerfy-icon careerfy-technology"></i>
    @error('phone')
    <div class="error">{{ $message }}</div>
    @enderror
    <span class="help-block"><strong></strong></span>

</div>

<div class="form-group col-md-6">
    {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'البريد الالكتروني']) !!}
    <i class="careerfy-icon careerfy-mail"></i>
    @error('email')
    <div class="error">{{ $message }}</div>
    @enderror
    <span class="help-block"><strong></strong></span>

</div>

<div class="form-group col-md-6 gov-input">
{!! Form::select('governorates', $govs, null, ['class'=>'form-control','placeholder'=>'اختر المحافظة']) !!}
        @error('governorates')
        <div class="error">{{ $message }}</div>
        @enderror
        <span class="help-block"><strong></strong></span>

</div>

<div class="form-group col-md-6 lawyer-input court_input">
        {!! Form::select('court_name',[
        'محكمة شمال القاهرة الابتدائية' => 'محكمة شمال القاهرة الابتدائية',
        'محكمة جنوب القاهرة الابتدائية' => 'محكمة جنوب القاهرة الابتدائية',
        'محكمة القاهرة الجديدة الابتدائية' => 'محكمة القاهرة الجديدة الابتدائية',
        'محكمة حلوان الابتدائية' => 'محكمة حلوان الابتدائية',
        'محكمة شمال الجيزة الابتدائية' => 'محكمة شمال الجيزة الابتدائية',
        'محكمة الجيزة الابتدائية' => 'محكمة الجيزة الابتدائية',
        'محكمة شمال بنها الابتدائية' => 'محكمة شمال بنها الابتدائية',
        'محكمة جنوب بنها الابتدائية' => 'محكمة جنوب بنها الابتدائية',
        'محكمة شرق الإسكندرية الابتدائية' => 'محكمة شرق الإسكندرية الابتدائية',
        'محكمة غرب الإسكندرية الابتدائية' => 'محكمة غرب الإسكندرية الابتدائية',
        'محكمة مرسى مطروح الابتدائية' => 'محكمة مرسى مطروح الابتدائية',
        'محكمة شرق طنطا الابتدائية' => 'محكمة شرق طنطا الابتدائية',
        'محكمة غرب طنطا الابتدائية' => 'محكمة غرب طنطا الابتدائية',
        'محكمة شمال دمنهور الابتدائية' => 'محكمة شمال دمنهور الابتدائية',
        'محكمة جنوب دمنهور الابتدائية' => 'محكمة جنوب دمنهور الابتدائية',
        'محكمة شبين الكوم الابتدائية' => 'محكمة شبين الكوم الابتدائية',
        'محكمة كفر الشي الابتدائية' => 'محكمة كفر الشي الابتدائية',
        'محكمة شمال المنصورة الابتدائية' => 'محكمة شمال المنصورة الابتدائية',
        'محكمة جنوب المنصورة الابتدائية' => 'محكمة جنوب المنصورة الابتدائية',
        'محكمة شمال الزقازيق الابتدائية' => 'محكمة شمال الزقازيق الابتدائية',
        'محكمة جنوب الزقازيق الابتدائية' => 'محكمة جنوب الزقازيق الابتدائية',
        'محكمة دمياط الابتدائية' => 'محكمة دمياط الابتدائية',
        'محكمة الإسماعيلية الابتدائية' => 'محكمة الإسماعيلية الابتدائية',
        'محكمة السويس الابتدائية' => 'محكمة السويس الابتدائية',
        'محكمة بورسعيد الابتدائية' => 'محكمة بورسعيد الابتدائية',
        'محكمة بني سويف الابتدائية' => 'محكمة بني سويف الابتدائية',
        'محكمة الفيوم الابتدائية' => 'محكمة الفيوم الابتدائية',
        'محكمة المنيا الابتدائية' => 'محكمة المنيا الابتدائية',
        'محكمة شمال أسيوط الابتدائية' => 'محكمة شمال أسيوط الابتدائية',
        'محكمة جنوب أسيوط الابتدائية' => 'محكمة جنوب أسيوط الابتدائية',
        'محكمة الأقصر الابتدائية' => 'محكمة الأقصر الابتدائية',
        'محكمة أسوان الابتدائية' => 'محكمة أسوان الابتدائية',
        'محكمة البحر الأحمر الابتدائية' => 'محكمة البحر الأحمر الابتدائية',
        'محكمة شمال سيناء الابتدائية' => 'محكمة شمال سيناء الابتدائية',
        'محكمة جنوب سيناء الابتدائية' => 'محكمة جنوب سيناء الابتدائية',
        'محكمة قنا الابتدائية' => 'محكمة قنا الابتدائية',
        'محكمة سوهاج الابتدائية' => 'محكمة سوهاج الابتدائية',
        'محكمة الوادي الجديد الابتدائية' => 'محكمة الوادي الجديد الابتدائية',
            ], null, ['class'=>'form-control','placeholder'=>'دائرة المحكمة التابع لها']) !!}
        @error('court_name')
        <div class="error">{{ $message }}</div>
        @enderror
        <span class="help-block"><strong></strong></span>

</div>

<div class="form-group col-md-6 lawyer-input lawyer_id">
    <div class="d-flex justify-content-center wrapper align-items-center">
        <!-- <input type="file" name="file" id="filey" class="filey"> -->
        
        {!! Form::file('id_photo', array_merge(['class' => 'filey', 'accept' => ".png, .jpg, .jpeg"])) !!}
        <div class="d-flex">
            {!! Form::text('id_photo_name', null ,array_merge(['id' =>'filey-name', 'class' => 'filey-name form-control', 'readonly' => 'readonly']) ) !!}
            {!! Form::button('ارفاق صورة الكارنيه',   [ 'class' => 'btny']) !!}
        </div>
    </div>
    <i class="careerfy-icon careerfy-paper" style="left: 165px;"></i>
   
</div>
<div class="form-group col-md-6">

</div>

<div class="form-group col-md-6">
    <!-- <input class="form-control" type="password" placeholder="كلمة المرور"> -->
    {!! Form::password('password', ['class' => 'form-control', 'placeholder' =>"كلمة المرور"]) !!}
    <i class="fa fa-lock"></i>
    @error('password')
    <div class="error">{{ $message }}</div>
    @enderror
    <span class="help-block"><strong></strong></span>

</div>

<div class="form-group col-md-6">
    <!-- <input class="form-control" type="password" placeholder="تأكيد كلمة المرور"> -->
    {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => "تأكيد كلمة المرور"]) !!}
    <i class="fa fa-lock"></i>
</div>

<div class="form-group col-md-12 accept_terms">
{!! Form::checkbox('accept_terms', true, null, ['id' => 'accept_terms']) !!} <label for="accept_terms"> أوافق على الشروط و الأحكام  </label>
@error('accept_terms')
<div class="error">{{ $message }}</div>
@enderror
<span class="help-block"><strong></strong></span>

</div>

<div class="m-b-15 m-t-15 col-md-12">
    {!! Form::submit('التسجيل', ['class' => 'btn btn-primary pull-left submit-btn']) !!}
    <p class="pull-right p-t-10">لديك حساب بالفعل؟<a href="{{ route('login') }}" class="careerfy-open-signin-tab">قم بتسجيل الدخول</a></p>
</div>
<div class="alert alert-success" role="alert" hidden>
    upload successfully
</div>
