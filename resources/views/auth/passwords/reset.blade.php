@extends('layouts.app')

@section('content')
<!-- Main Content -->
<div class="careerfy-main-content">
    <!-- Main Section -->
    <div class="careerfy-main-section careerfy-about-text-full p-t-50 m-b-80">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-pull-2 careerfy-typo-wrap text-center">
                    <div class="jobsearch-login-box">
                        <div id="exTab1">
						
                            
                            @if (session()->has('success'))
                                <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                            @endif 
                            <div class="tab-content clearfix">
                                <div class="tab-pane active" id="1a">
                                    
                                    <div class="div-signup">
                                        <div class="careerfy-services-classic">
                                            <span><i class="fa fa-lock"></i></span>
                                        </div>
                                        <h3>استعادة كلمة المرور</h3>
                                        <h4 class="text-center"><br>.من فضلك أدخل كلمة السر الجديدة مع تأكيدها</h4>
                                    </div>

                                    {!! Form::open(['route' => ['password.update'], 'class' => 'row', 'method' => 'post']) !!}
                                  
										<!-- {!! Form::token() !!} -->
										<input type="hidden" name="token" value="{{ $token }}">
                                        <div class="form-group col-md-12 ">
                                            {!! Form::text('email', $email ?? old('email'), ['class' => 'form-control', 'placeholder' => 'البريد الالكتروني']) !!}
                                            <i class="careerfy-icon careerfy-mail"></i>
											@error('email')
												<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
												</span>
											@enderror
                                        </div>

										<div class="form-group col-md-12 ">
                                            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'كلمة السر الجديدة']) !!}
                                            <i class="fa fa-lock"></i>
											@error('password')
												<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
												</span>
											@enderror
                                        </div>

										<div class="form-group col-md-12 ">
                                            {!! Form::password('password_confirmation',  ['class' => 'form-control', 'placeholder' => 'تأكيد كلمة السر']) !!}
                                            <i class="fa fa-lock"></i>
                                        </div>


                                        <div class="m-b-15 m-t-15 col-md-12 careerfy-user-form">
                                            
                                            {!! Form::submit('إعادة تعيين كلمة المرور') !!}
                                        
                                        </div>

                                    {!! Form::close() !!}
                                </div>
                            </div>
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