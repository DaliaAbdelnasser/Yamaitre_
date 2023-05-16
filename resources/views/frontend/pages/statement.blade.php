@extends('layouts.app')

@section('meta')
<title>{{ $data['page']->title?? '' }}  </title>
 <meta name="title" content="{{ $data['page']->meta_title??'' }}">
<meta name="description" content="{{ $data['page']->meta_desc??'' }}">
@endsection

@section('content')
<div class="careerfy-subheader careerfy-subheader-with-bg" style="background: url('frontend-assets/img/{{$data['slider']->image}}');">
    <span class="careerfy-banner-transparent"></span>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="careerfy-page-title">
                    <h1>{{ $data['slider']->title }}</h1>
                    <p></p>
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
                    <div class="careerfy-about-text m-t-30">
                        <h2 class="m-b-25">{{ $data['page']->sections[0]->section_title ?? '' }}</h2>
                        <span class="careerfy-about-sub">{{ $data['page']->sections[0]->subtitle ?? '' }}</span>
                        <p>{!! $data['page']->sections[0]->description??'' !!}</p>
                    </div>
                </div>



            </div>
        </div>
    </div>
    <!-- Main Section -->




</div>
<!-- Main Content -->
@endsection
