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

                            @if ($errors->any())
                                @foreach ($errors->all() as $key => $error)
                                    {{--<!-- <div>{{$error}}</div> -->--}}
                                    <div class="alert alert-danger" role="alert">{{ $error }}</div>
                                @endforeach
                            @endif
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
                                        <h4 class="text-center">أدخل اسم المستخدم أو البريد الإلكتروني الذي استخدمته في ملف التعريف الخاص بك. <br> سيتم إرسال رابط إعادة تعيين كلمة المرور إليك عبر البريد الإلكتروني.</h4>
                                    </div>
                                    {!! Form::open(['route' => ['password.email'], 'class' => 'row', 'method' => 'post']) !!}
                                  

                                        <div class="form-group col-md-12 ">
                                            {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'البريد الالكتروني']) !!}
                                            <i class="careerfy-icon careerfy-mail"></i>
                                        </div>


                                        <div class="m-b-15 m-t-15 col-md-12">
                                            
                                            {!! Form::submit('إعادة تعيين كلمة المرور', ['class' => 'btn btn-primary pull-left']) !!}
                                            
                                            <p class="pull-right p-t-10">لديك حساب مسجل بالفعل؟
                                                <a href="{{ route('login') }}" class="careerfy-open-signin-tab">قم بتسجيل الدخول</a></p>
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