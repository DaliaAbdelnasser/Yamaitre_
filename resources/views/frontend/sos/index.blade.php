@extends('layouts.app')

@section('meta')
<title>{{ $data['page']->title }}  </title>
 <meta name="title" content="{{ $data['page']->meta_title??'' }}">
<meta name="description" content="{{ $data['page']->meta_desc??'' }}">
@endsection

@section('content')


<div class="careerfy-subheader careerfy-subheader-with-bg" style="background: url('{{ asset('frontend-assets/img/' . $data['slider']->image) }}');">
            <span class="careerfy-banner-transparent"></span>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="careerfy-page-title">
                            <h1>{{ $data['slider']->title }}</h1>
                            <p>{{ $data['slider']->subtitle }}</p>
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



        <!-- Main Section -->
        <div class="careerfy-main-section m-t-100 m-b-20 videos-filter">
            <div class="container">
                <div class="row">

                    <div class="col-md-12 ">
                        @include('partials._ads-banners')


                        <div class="careerfy-job-listing careerfy-featured-listing">
                            <ul class="careerfy-row">
                                @guest
                                @foreach($data['distresses'] as $distress)
                                <li class="careerfy-column-6">
                                    <div class="careerfy-table-layer tasks-listing">
                                        <div class="careerfy-featured-listing-text careerfy-joblisting-classic-wrap">
                                            <div class="widget_jobdetail_three_apply_wrap">
                                                <img src="{{ asset('uploads/' . $distress->users->first()->userable->profile_image) }}" alt="">
                                                <h6>{{ $distress->users->first()->first_name }} {{ $distress->users->first()->last_name }}</h6>
                                                @php $rating = $distress->users->first()->userable->rate; @endphp  
                                                @foreach(range(1,5) as $i)
                                                    
                                                    @if($rating >0)
                                                        @if($rating >0.5)
                                                            <i class="fa fa-star checked"></i>
                                                        @else
                                                            <i class="fa fa-star-half checked"></i>
                                                        @endif
                                                    @else
                                                        <i class="fa fa-star"></i>
                                                    @endif
                                                    @php $rating--; @endphp
                                                @endforeach

                                            </div>
                                            <h2><a href="#">{{ $distress->type }}</a></h2>

                                            <time datetime="2008-02-14 20:00">{{ $distress->created_at }}</time>
                                            <div class="careerfy-featured-listing-options">
                                                <p>{{ $distress->description }} </p>

                                                <a href="{{ route('single.sos', [$distress->id]) }}" class="careerfy-option-btn">شاهد المزيد</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                                @endauth
                                @auth
                                @foreach($data['distresses'] as $distress)
                                <li class="careerfy-column-6">
                                    <div class="careerfy-table-layer tasks-listing">
                                        <div class="careerfy-featured-listing-text careerfy-joblisting-classic-wrap">
                                            <div class="widget_jobdetail_three_apply_wrap">
                                                <img src="{{ asset('uploads/' . $distress->users->first()->userable->profile_image) }}" alt="">
                                                <h6>{{ $distress->users->first()->first_name }} {{ $distress->users->first()->last_name }}</h6>
                                                @php $rating = $distress->users->first()->userable->rate; @endphp  
                                                @foreach(range(1,5) as $i)
                                                    
                                                    @if($rating >0)
                                                        @if($rating >0.5)
                                                            <i class="fa fa-star checked"></i>
                                                        @else
                                                            <i class="fa fa-star-half checked"></i>
                                                        @endif
                                                    @else
                                                        <i class="fa fa-star"></i>
                                                    @endif
                                                    @php $rating--; @endphp
                                                @endforeach

                                            </div>
                                            <h2><a href="#">{{ $distress->type }}</a></h2>

                                            <time datetime="2008-02-14 20:00">{{ $distress->created_at }}</time>
                                            <div class="careerfy-featured-listing-options">
                                                <p>{{ $distress->description }} </p>

                                                <a href="{{ route('single.sos', [$distress->id]) }}" class="careerfy-option-btn">شاهد المزيد</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                                @endauth
                            </ul>
                        </div>
                        <!-- Featured Jobs Listings -->

                    </div>

                </div>
            </div>
        </div>
        <!-- Main Section -->


        {{-- @include('partials._pagination', ['records' => $data['distresses']]) --}}

@endsection
