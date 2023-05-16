@extends('layouts.app')

@section('meta')
<title>Ya Maitre - Login </title>
@endsection


@section('content')
<!-- Main Content -->
<div class="careerfy-main-content">
    <!-- Main Section -->
    <div class="careerfy-main-section careerfy-about-text-full p-t-80 p-b-100">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-pull-3 careerfy-typo-wrap text-center">
                    <div class="jobsearch-login-box">
                        <div id="exTab1">
                            <div class="div-signup m-b-50">
                                <div class="careerfy-services-classic">
                                    <span><i class="careerfy-icon careerfy-user-1"></i></span>
                                </div>
                                <h3 class="">سجل الدخول لحسابك</h3>

                            </div>

                            {!! Form::open(['route' => 'signin', 'id' => 'signin_form']) !!}
                            @if (session()->has('message'))
                            <div class="alert alert-danger" role="alert">{{ session('message') }}</div>
                            @endif
                                <div class="careerfy-box-title careerfy-box-title-sub">
                                    <span>تسجيل الدخول</span>
                                </div>
                                <div class="careerfy-user-form">
                                    <ul>
                                        <li>
                                            <!-- <label>البريد الالكتروني</label> -->
                                            {!! Form::label('credentials', 'البريد الإلكتروني أو رقم الهاتف المسجل', [ 'class' => 'form-label']) !!}

                                            {!! Form::text('credentials', null ,array_merge(['class' => 'form-control', 'placeholder' => 'البريد الإلكتروني أو رقم الهاتف المسجل']) ) !!}

                                            <!-- <input value="البريد الالكتروني" onblur="if(this.value == '') { this.value ='البريد الالكتروني'; }" onfocus="if(this.value =='البريد الالكتروني') { this.value = ''; }" type="text"> -->
                                            <i class="careerfy-icon careerfy-mail"></i>
                                            @error('credentials')
												<span class="invalid-feedback" role="alert">
                                                    <span class="error">{{ $message }}</span>
												</span>
											@enderror
                                        </li>
                                        <li>
                                            <!-- <label>كلمة المرور</label> -->
                                            {!! Form::label('password', 'كلمة المرور ', [ 'class' => 'form-label']) !!}
                                            {!! Form::password('password', array_merge(['class' => 'form-control', 'onblur' => "if(this.value == '') { this.value ='كلمة المرور'; }", 'onfocus' => "if(this.value =='كلمة المرور') { this.value = ''; }",'placeholder' => 'كلمة المرور']) ) !!}

                                            <!-- <input value="كلمة المرور" onblur="if(this.value == '') { this.value ='كلمة المرور'; }" onfocus="if(this.value =='كلمة المرور') { this.value = ''; }" type="text"> -->
                                            <i class="careerfy-icon careerfy-multimedia"></i>
                                            @error('password')
												<span class="invalid-feedback" role="alert">
												<span class="error">{{ $message }}</span>
												</span>
											@enderror
                                        </li>
                                        <li>
                                            <!-- <input type="submit" value="تسجيل الدخول"> -->
                                            {!! Form::submit('تسجيل الدخول') !!}

                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                    <div class="careerfy-user-form-info">
                                        <p><a href="{{ route('password.request') }}">نسيت كلمة المرور؟</a> | <a href="{{ route('register') }}">تسجيل مستخدم جديد</a></p>
                                        <div class="careerfy-checkbox">
                                            <input type="checkbox" id="remember" name="remember" />
                                            <label for="remember"><span></span> تذكر بياناتي</label>
                                        </div>
                                    </div>
                  
                                </div>
                                
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Section -->
</div>
<!-- Main Content -->
@endsection
