@extends('layouts.app')

@section('meta')
<title>Ya Maitre - Register </title>
@endsection

@section('content')
<div class="careerfy-main-content">
    <!-- Main Section -->
    <div class="careerfy-main-section careerfy-about-text-full p-t-50">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-pull-1 careerfy-typo-wrap">
                    <div class="jobsearch-login-box">
                        <div id="exTab1">
                            <ul class="nav nav-pills">
                                <li class="active">
                                    <a href="#" data-toggle="tab" id="lawyer_form"><i class="careerfy-icon careerfy-briefcase"></i> تسجيل كمحامي</a>
                                </li>
                                <li>
                                    <a href="#" data-toggle="tab" id="client_form"><i class="careerfy-icon careerfy-user"></i> تسجيل كمستخدم</a>
                                </li>
                            </ul>
                            {{-- @if ($errors->any())
                                @foreach ($errors->all() as $key => $error)
                                    <div class="alert alert-danger" role="alert">{{ $error }}</div>
                                @endforeach
                            @endif --}}
                            <div class="tab-content clearfix">
                                <div class="tab-pane active">
                                    <div class="div-signup">
                                        <div class="careerfy-services-classic">
                                            <span><i class="careerfy-icon careerfy-briefcase"></i></span>
                                        </div>
                                        <h3 class="lawyer-title">تسجيل كمحامي</h3>
                                        <h3 class="client-title">تسجيل كمستخدم</h3>
                                    </div>
                                    {!! Form::open(['route' => 'signup', 'id' => 'register-form', 'files' => true]) !!}
                                        @include('partials._register-form')
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

@endsection