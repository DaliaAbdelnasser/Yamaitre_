@extends('layouts.app')

@section('meta')
<title>{{ $data['page']->title?? '' }}  </title>
<meta name="title" content="{{ $data['page']->meta_title??'' }}">
<meta name="description" content="{{ $data['page']->meta_desc?? '' }} ">
@endsection

@section('content')
<div class="careerfy-subheader careerfy-subheader-with-bg">
    <span class="careerfy-banner-transparent"></span>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="careerfy-page-title">
                    <h1>{{ $data['page']->title }}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="careerfy-breadcrumb">

    </div>
</div>
<!-- Main Content -->
<div class="clearfix"></div>
<div class="careerfy-main-content">
    <!-- Main Section -->
    <div class="careerfy-main-section careerfy-about-text-full p-t-80 p-b-80">
        <div class="container">
            <div class="row">
                <div class="col-md-12 careerfy-typo-wrap">
                    <div class="careerfy-about-text">
                        <div class="careerfy-contact-info-sec">
                            <h2>تواصل معنا</h2>
                            <p>{{ $data['page']->sections->first()->subtitle }}</p>
                            <p>{!! $data['page']->sections->first()->description !!}</p>
                            <ul class="careerfy-contact-info-list">
                                <li><i class="careerfy-icon careerfy-placeholder"></i> <a href="{{$location}}" target="_blank"> {{ $infos->where('info_name', 'address')->first()->info_value }}</a></li> 
                                <li><i class="careerfy-icon careerfy-mail"></i> <a href="mailto:{{ $infos->where('info_name', 'email')->first()->info_value }}">{{ $infos->where('info_name', 'email')->first()->info_value }}</a></li>
                                <li><i class="careerfy-icon careerfy-technology"></i> {{ $infos->where('info_name', 'phone')->first()->info_value }}</li>
                                <li><i class="careerfy-icon careerfy-technology"></i> 01145612792</li>
                            </ul>
                            <!--<div class="careerfy-contact-media">-->
                            <!--    <a href="{{$facebook}}" class="careerfy-icon careerfy-facebook-logo" target="_blank"></a>-->
                            <!--    <a href="{{$twitter}}" class="careerfy-bgcolorhover fa fa-twitter" target="_blank"></a>-->
                            <!--    <a href="{{$instagram}}" class="careerfy-bgcolorhover fa fa-instagram" target="_blank"></a>-->
                            <!--    <a href="{{$youtube}}" class="careerfy-bgcolorhover cs-yout" target="_blank"><i class="fa fa-youtube-play"></i></a>-->
                            <!--    <a href="{{$linkedin}}" class="careerfy-icon careerfy-linkedin-button" target="_blank"></a>-->
                            <!--</div>-->
                                                <ul class="careerfy-social-network">
                        <li>
                            <a href="{{$facebook}}" class="careerfy-bgcolorhover fa fa-facebook" target="_blank"></a>
                        </li>
                        <li>
                            <a href="{{$twitter}}" class="careerfy-bgcolorhover fa fa-twitter" target="_blank"></a>
                        </li>
                        <li>
                            <a href="{{$instagram}}" class="careerfy-bgcolorhover fa fa-instagram" target="_blank"></a>
                        </li>
                        <li>
                            <a href="{{$youtube}}" class="careerfy-bgcolorhover cs-yout" target="_blank"><i class="fa fa-youtube-play"></i></a>
                        </li>
                        <li>
                            <a href="{{$linkedin}}" class="careerfy-bgcolorhover fa fa-linkedin" target="_blank"></a>
                        </li>
 
                    </ul>
                        </div>
                        <div class="careerfy-contact-form">
                            <h2>{{ $data['page']->sections->first()->section_title }}</h2>
                            {!! Form::open(['route' => ['contact.data'], 'method' => 'post']) !!}
                            <ul>
                                <li>
                                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'الاسم', 'required' => 'required']) !!}
                                    <i class="careerfy-icon careerfy-user"></i>
                                    @error('name')
                                    <span class="invalid-feedback cs-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </li>
                                <li>
                                    {!! Form::text('subject', null, ['class' => 'form-control', 'placeholder' => 'الموضوع', 'required' => 'required']) !!}
                                    <i class="careerfy-icon careerfy-user"></i>
                                    @error('subject')
                                    <span class="invalid-feedback cs-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </li>
                                <li>
                                    {!! Form::text('email', null, ['class' => 'form-control' , 'placeholder' => 'البريد الالكتروني', 'required' => 'required']) !!}
                                    <i class="careerfy-icon careerfy-mail"></i>
                                    @error('email')
                                    <span class="invalid-feedback cs-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </li>
                                <li>
                                    {!! Form::text('phone', null, ['class' => 'form-control' , 'placeholder' => 'التليفون', 'required' => 'required']) !!}
                                    <i class="careerfy-icon careerfy-technology"></i>
                                    @error('phone')
                                    <span class="invalid-feedback cs-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </li>
                                <li class="careerfy-contact-form-full">
                                    {!! Form::textarea('message', null, [
                                        'class'      => 'form-control',
                                        'rows'       => 3, 
                                        'name'       => 'message',
                                        'id'         => 'message',
                                        'onkeypress' => "return nameFunction(event);",
                                        'placeholder'=> "اكتب رسالتك ...",
                                        'required' => 'required'
                                    ]) !!}
                                     @error('message')
                                     <span class="invalid-feedback cs-danger" role="alert">
                                         {{ $message }}
                                     </span>
                                     @enderror
                                </li>
                                <li>  {!! Form::submit('ارسل', ['class' => 'btn']) !!}</li>
                            </ul>
                            <div class="clearfix"></div>
                        {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-12 careerfy-typo-wrap">
                    @include('flash::message')
                </div>
            </div>
        </div>
    </div>
    <!-- Main Section -->
</div>
<!-- Main Content -->
@endsection