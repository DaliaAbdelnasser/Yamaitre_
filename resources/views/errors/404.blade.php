@extends('layouts.app')

@section('meta')
<title> 404 </title>
@endsection


@section('content')
<!-- Main Content -->
<div class="clearfix"></div>
<div class="careerfy-main-content">
    <div class="careerfy-main-section">
        <div class="careerfy-errorpage-bg" style="background: url('uploads/errorpage-bg.jpg');">
            <span class="careerfy-errorpage-transparent"></span>
            <div class="container">
                <div class="careerfy-errorpage">
                    <img src="{{ asset('uploads/error-text.png') }}" alt="404">
                    <h2>الصفحة غير موجودة!</h2>
                    <a href="{{ route('home') }}"><span>العودة للصفحة الرئيسية</span></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Content -->
@endsection