@extends('layouts.app')

@section('meta')
<title>{{ $data['page']->title?? '' }}  </title>
 <meta name="title" content="{{ $data['page']->meta_title??'' }}">
<meta name="description" content="{{ $data['page']->meta_desc??'' }}">
@endsection

@section('content')
<div class="careerfy-subheader careerfy-subheader-with-bg">
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
    <div class="careerfy-main-section careerfy-about-text-full p-t-80 ">
        <div class="container">
            <div class="row">

                <div class="col-md-7 careerfy-typo-wrap">
                    <div class="careerfy-about-text m-t-30">
                        <h2 class="m-b-25">{{ $data['page']->sections[0]->section_title }}</h2>
                        <span class="careerfy-about-sub">{{ $data['page']->sections[0]->subtitle }}</span>
                        <p>{!! $data['page']->sections[0]->description !!}</p>

                    </div>
                </div>
                <div class="col-md-5 careerfy-typo-wrap">
                    <div class="careerfy-about-thumb"><img src="{{ asset('uploads/'.$data['page']->sections[0]->images[0]->img) }}"></div>
                </div>


            </div>
        </div>
    </div>
    <!-- Main Section -->


    <!-- Main Section -->
    <div class="careerfy-main-section gray-bg p-t-80 m-b-80">
        <div class="container">
            <div class="row">

                <div class="careerfy-typo-wrap col-md-12">
                    <section class="careerfy-about-text">
                        <h2 class="text-center">{{ $data['page']->sections[1]->section_title }}</h2>
                        <h6 class="text-center">{{ $data['page']->sections[1]->subtitle }}</h6>
                        <p class="text-center">{!! $data['page']->sections[1]->description !!}</p>
                    </section>

                </div>

                <div class="col-md-4">

                    <div class="service-box">

                        <h4>{{ $data['page']->sections[2]->section_title }}</h4>
                        <p>{!! $data['page']->sections[2]->description !!}</p>
                    </div>
                </div>

                <div class="col-md-4">

                    <div class="service-box golden-bg">

                        <h4>{{ $data['page']->sections[3]->section_title }}</h4>
                        <p>{!! $data['page']->sections[3]->description !!}</p>
                    </div>
                </div>


                <div class="col-md-4">

                    <div class="service-box">

                        <h4>{{ $data['page']->sections[4]->section_title }}</h4>
                        <p>{!! $data['page']->sections[4]->description !!}</p>
                    </div>
                </div>


                <div class="col-md-4">

                    <div class="service-box  golden-bg">

                        <h4>{{ $data['page']->sections[5]->section_title }}</h4>
                        <p>{!! $data['page']->sections[5]->description !!}</p>
                    </div>
                </div>

                <div class="col-md-4">

                    <div class="service-box">

                        <h4>{{ $data['page']->sections[6]->section_title }}</h4>
                        <p>{!! $data['page']->sections[6]->description !!}</p>
                    </div>
                </div>


                <div class="col-md-4">

                    <div class="service-box  golden-bg">

                        <h4>{!! $data['page']->sections[7]->section_title !!}</h4>
                        <p>{!! $data['page']->sections[7]->description !!}</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Main Section -->

</div>
<!-- Main Content -->
@endsection