@extends('layouts.app')

@section('meta')
<title> {{ $data['page']->meta_title }} | {{$tagline}} </title>
<meta name="title" content="{{ $data['page']->meta_title??'' }}">
<meta name="description" content="{{ $data['page']->meta_desc??'' }}">
@endsection

@push('styles')
<link href="{{ asset('frontend-assets/css/homepage-seven.css') }}" rel="stylesheet">
@endpush

@section('content')
    <!-- Banner -->
    <!-- url(img/banner-bg.jpg) -->
    <div class="careerfy-banner careerfy-typo-wrap" style="background: url('frontend-assets/img/{{$data['slider']->image ?? ''}}');">
        
        <span class="careerfy-banner-transparent"></span>
        <div class="careerfy-banner-caption @if (!count($data['governorates'])) no-filter @endif">
            <div class="container">
                <h1>خطوة نحو مستقبل تقديم الخدمات القانونية والاستشارية</h1>
                <h3>خدماتنا رقمية مقدمة للمحامين ولجمهور المتقاضين</h3>

                <!--<p>{{ $data['slider']->subtitle ?? '' }}</p>-->
                @if (count($data['governorates']))
                <form class="careerfy-banner-search">
                    <ul>
                        <li>
                            <div class="careerfy-select-style">
                                <select onchange="window.location.href=this.options[this.selectedIndex].value;" id="meeting">
                                    <option value="">ابحث عن محامي في محافظة</option>
                                    @foreach($data['governorates']  as $city)
                                    <option value="{{ route('lawyers.list', ['governorates' => $city]) }}">
                                        {{ $city }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </li>
                        <li class="careerfy-banner-submit"> <input type="submit" value=""> <i class="careerfy-icon careerfy-search"></i> </li>
                    </ul>
                </form>
                @endif

            </div>
         
            @php
            $news_for_all = $allnews->where('usertype', 'all');
         
            @endphp

            @auth
            @php
            if(auth()->user()->userable_type == 'App\Models\Lawyer'){
                $news_for_lawyers = $allnews->where('usertype', 'lawyer');

            }else {
                $news_for_clients = $allnews->where('usertype', 'client');
            }
            @endphp
            <marquee direction="scroll">
                <p>
                    
                @foreach ($news_for_all as $news)
                    <span>{{$news->news}}</span> 
                @endforeach
                @isset($news_for_lawyers)
                @foreach ($news_for_lawyers as $news)
                    <span>{{$news->news}}</span> 
                @endforeach
                @endisset

                @isset($news_for_clients)
                @foreach ($news_for_clients as $news)
                <span>{{$news->news}}</span> 
                @endforeach
                @endisset
               
                </p>
            </marquee>

            @endauth
            @guest
            <marquee direction="scroll">
                <p>
                    
                @foreach ($news_for_all as $news)
                    <span>{{$news->news}}</span> 
                @endforeach
               
                </p>
            </marquee>
            @endguest


    


        </div>
    </div>
    <!-- Banner -->
    <!-- page content -->
    <!-- Main Content -->
    <div class="careerfy-main-content">
        <div class="careerfy-main-section careerfy-parallex-full m-t-0 m-b-0 intro-section">
            <div class="container">
            @include('partials._ads-banners')
                <div class="row cs-flex">

                    <aside class="col-md-6 careerfy-typo-wrap">
                        <div class="careerfy-parallex-text">
                            <h2>{{ $data['page']->sections[0]->title }}<br>{{ $data['page']->sections[0]->subtitle ?? '' }}</h2>
                            <p>{!! $data['page']->sections[0]->description ?? '' !!}</p>
                            <a href="{{ route('about') }}" class="careerfy-static-btn careerfy-bgcolor"><span>اعرف المزيد</span></a>
                        </div>
                    </aside>
                    <aside class="col-md-6 careerfy-typo-wrap">
                        <div class="careerfy-right imf-b-a"><img src="{{ asset('uploads/' . $data['page']->sections[0]->images->first()->img ?? '') }}" alt=""></div>
                    </aside>
                </div>
            </div>
        </div>

        <!-- Main Section Articles -->
        @if(count($data['articles']))
        <div class="careerfy-main-section articles-section jobsearch-main-section careerfy-employer-slider-full m-t-0 p-t-80">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Fancy Title -->
                        <section class="careerfy-fancy-title">
                            <p>{{$data['page']->sections[1]->subtitle}}</p>
                            <h2>{{$data['page']->sections[1]->section_title}}</h2>

                        </section>
                    </div>
                    <div class="careerfy-employer careerfy-employer-slider careerfy-blog careerfy-blog-grid cs-ar-grid">
                        @foreach($data['articles'] as $article)
                        <div class="careerfy-employer-slider-wrap">    
                                <div class="careerfy-content-wrapper careerfy-candidate careerfy-candidate-view4">
                                    <figure>
                                        <a href="{{ route('single.article', [$article->id]) }}"><img src="{{ asset('uploads/' . $article->image_feature) }}"></a>
                                    </figure>
                                    <div class="careerfy-blog-grid-text">

                                        <h2><a href="{{ route('single.article', [$article->id]) }}">{{ $article->title }}</a></h2>
                                        <ul class="careerfy-blog-grid-option">
                                            <li>{{ $article->author_name }}</li>
                                            <li><time datetime="2008-02-14 20:00">{{ $article->created_at }}</time></li>
                                        </ul>
                                        @php
                                        $start = strpos($article->description, '<p>');
                                        $end = strpos($article->description, '</p>', $start);
                                        $excerpt = substr($article->description, $start, $end-$start+4);
                                        $excerpt = html_entity_decode(strip_tags($excerpt));
                                        @endphp
                                        <p>{{ implode(' ', array_slice(explode(' ', $excerpt), 0, 8)) }}@if ( str_word_count($excerpt) > 8 )...@endif</p>
                                        <a href="{{ route('single.article', [$article->id]) }}" class="careerfy-read-more careerfy-bgcolor">اقرأ المزيد</a>
                                    </div>
                                </div>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
        @endif

        @if(count($data['tasks']))
        <!-- Main Section Tasks -->
        <div class="careerfy-main-section m-b-100 p-t-80">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 careerfy-typo-wrap">
                        <!-- Fancy Title -->
                        <section class="careerfy-fancy-title">
                            <h2>{{ $data['page']->sections[2]->section_title  ?? ''}}</h2>
                            <p>{{ $data['page']->sections[2]->subtitle ?? ''}}</p>
                        </section>
                        <!-- Featured Jobs Listings -->
                        <div class="careerfy-job-listing careerfy-featured-listing">
                            <ul class="careerfy-row">
                                @foreach($data['tasks'] as $task)
                                
                                <li class="careerfy-column-4">
                                        <div class="careerfy-table-layer tasks-listing">
                                            <div class="careerfy-table-row">
                                                <div class="careerfy-featured-listing-text">
                                                    <div class="widget_jobdetail_three_apply_wrap">
                                                        <img src="{{ asset('uploads/' . $task->user->first()->userable->profile_image) }}" alt="">
                                                        <h6>{{ $task->user[0]->first_name }} {{ $task->user[0]->last_name }}</h6>
                                                        @php $rating = $task->user->first()->userable->rate; @endphp  
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
                                                    <h2><a href="{{ route('single.task', [$task->id]) }}">{{ $task->title }}</a></h2>
                                                    <p class="m-t-10 task-stats">
                                                        <strong><i class="careerfy-icon careerfy-salary"></i> تكلفة المهمة :<small> {{ $task->price }} جنيه مصري</small></strong>
                                                    </p>
                                                    <div class="careerfy-featured-listing-options">
                                                        <p>{{ $task->description }} </p>
                                                        <p class="m-t-10 task-stats">
                                                            <strong><i class="careerfy-icon careerfy-calendar-1"></i><small>{{ $task->created_at ?? 'ديسمبر, 05, 2020'}}</small></strong>
                                                            <strong><i class="careerfy-icon careerfy-location"></i> <small>القاهرة </small> </strong>
                                                            <strong><small>{{ $task->applicants_count }}</small><i class="careerfy-icon careerfy-group"></i>  </strong>

                                                        </p>
                                                        <a href="{{ route('single.task', [$task->id]) }}" class="careerfy-option-btn">شاهد المزيد</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- Featured Jobs Listings -->
                        <div class="careerfy-plain-btn"> <a href="{{ route('tasks.list') }}">تصفح جميع المهام</a> </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main Section -->
        @endif
    </div>
    <!-- Main Content -->
@endsection
