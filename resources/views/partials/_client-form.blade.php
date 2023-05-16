<div class="form-group col-md-6">
    {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'الاسم الأول']) !!}
    <i class="careerfy-icon careerfy-user"></i>
    @error('first_name')
    <div class="error">{{ $message }}</div>
    @enderror
</div>

<div class="form-group col-md-6">
    {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => ' الاسم الأخير']) !!}
    <i class="careerfy-icon careerfy-user"></i>
    @error('last_name')
    <div class="error">{{ $message }}</div>
    @enderror
</div>

<div class="form-group col-md-6">
    {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'رقم الهاتف']) !!}
    <i class="careerfy-icon careerfy-technology"></i>
    @error('phone')
    <div class="error">{{ $message }}</div>
    @enderror
</div>

<div class="form-group col-md-6">
    {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'البريد الالكتروني']) !!}
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
        ],'null',['class'=>'form-control','placeholder'=>'اختر المحافظة']) !!}
        @error('governorates')
        <div class="error">{{ $message }}</div>
        @enderror
</div>



<div class="form-group  col-md-6">
    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'كلمة المرور']) !!}
    <i class="fa fa-lock"></i>
    @error('password')
    <div class="error">{{ $message }}</div>
    @enderror
</div>

<div class="form-group  col-md-6">
    {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'تأكيد كلمة المرور']) !!}
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
