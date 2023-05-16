@extends('layouts.app')

@section('meta')
<title>Ya Maitre Admin Panel- Login </title>
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
                                <h3 class="">سجل الدخول كمسؤول</h3>
                            </div>
                            @include('flash::message')
                                {!! Form::open(['route' => 'admin.postLogin']) !!}
                                <div class="careerfy-user-form">
                                    <ul>
                                        <li>
                                            <!-- <label>البريد الالكتروني</label> -->
                                            {!! Form::label('email', 'البريد الإلكتروني ', [ 'class' => 'form-label']) !!}

                                            {!! Form::text('email', null ,array_merge(['class' => 'form-control', 'placeholder' => 'البريد الإلكتروني']) ) !!}
                                            <i class="careerfy-icon careerfy-mail"></i>
                                            @error('email')
												<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
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
												<strong>{{ $message }}</strong>
												</span>
											@enderror
                                        </li>
                                        <li>
                                            {!! Form::submit('تسجيل الدخول') !!}

                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                    <div class="careerfy-user-form-info">
                                        <div class="careerfy-checkbox">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
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

