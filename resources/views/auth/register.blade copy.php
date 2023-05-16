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
                                    <a href="#1a" data-toggle="tab"><i class="careerfy-icon careerfy-briefcase"></i> تسجيل كمحامي</a>
                                </li>
                                <li><a href="#2a" data-toggle="tab"><i class="careerfy-icon careerfy-user"></i> تسجيل كمستخدم</a>
                                </li>
                            </ul>
                            {{-- @if ($errors->any())
                                @foreach ($errors->all() as $key => $error)
                                    <div class="alert alert-danger" role="alert">{{ $error }}</div>
                                @endforeach
                            @endif --}}
                            <div class="tab-content clearfix">
                                <div class="tab-pane active" id="1a">
                                    <div class="div-signup">
                                        <div class="careerfy-services-classic">
                                            <span><i class="careerfy-icon careerfy-briefcase"></i></span>
                                        </div>
                                        <h3>تسجيل كمحامي</h3>
                                    </div>
                                    {!! Form::open(['route' => 'lawyerregister']) !!}
                                        @include('partials._lawyer-form')
                                    {!! Form::close() !!}
                                </div>
                                <div class="tab-pane" id="2a">
                                    <div class="div-signup">
                                        <div class="careerfy-services-classic">
                                            <span><i class="careerfy-icon careerfy-user-1"></i></span>
                                        </div>
                                        <h3>تسجيل كمستخدم</h3>
                                    </div>
                                    {!! Form::open(['route' => 'clientregister']) !!}
                                        @include('partials._client-form')
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