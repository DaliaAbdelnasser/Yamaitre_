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
                    <h1>{{ $data['page']->title }}</h1>
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
<!-- Main Content -->
<div class="careerfy-main-content">

<!-- Main Section -->
<div class="careerfy-main-section careerfy-faq-full p-b-80 p-t-70">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="careerfy-about-text m-t-30">
                    <h2 class="m-b-25">{{ $data['page']->sections[0]->section_title }}</h2>
                    <span class="careerfy-about-sub"> {{ $data['page']->sections->first()->subtitle ?? ''}} </span>
                    <p>{!! $data['page']->sections->first()->description??'' !!}</p>
                </div>
                @foreach ($data['page']->faqs as $faq)
                @if($faq->question != '')
                <div class="panel-group careerfy-accordion" id="accordion-faq-{{ $faq->id }}">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse"
                                        data-parent="#accordion-faq-{{ $faq->id }}" href="#collapse-{{ $faq->id }}"
                                        aria-expanded="true" aria-controls="collapse-{{ $faq->id }}">
                                        <i class="careerfy-icon careerfy-arrows"></i> س : {{ $faq->question }}
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse-{{ $faq->id }}" class="panel-collapse collapse">
                                <div class="panel-body">
                                    {{ $faq->answer }}
                                </div>
                            </div>
                        </div>
                </div>
                @endif
                @endforeach
            </div>

        </div>
    </div>
</div>
<!-- Main Section -->

</div>
<!-- Main Content -->

@endsection