@extends('layouts.app')

@section('meta')
<title>{{ $data['page']->title }}  </title>
 <meta name="title" content="{{ $data['page']->meta_title??'' }}">
<meta name="description" content="{{ $data['page']->meta_desc??'' }}">
@endsection

@section('content')

<div class="careerfy-subheader careerfy-subheader-with-bg" style="background: url(frontend-assets/img/{{$data['slider']->image}});">
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
<div class="careerfy-main-section articles-section gray-bg p-t-80 m-b-80">
    <div class="container">
        <div class="row">

            <!-- Blog -->
            <div class="careerfy-blog careerfy-blog-grid">
                <ul class="row">
                    <div class="col-md-12">
                        @include('partials._ads-banners')
                    </div>
                    
                    @guest
                    @foreach($data['articles'] as $article)
                    <li class="col-md-4">
                        <div class="careerfy-employer-slider-wrap">

                            <div class="careerfy-content-wrapper careerfy-candidate careerfy-candidate-view4 cs-arti-grid">
                                <figure>
                                    <a href="{{ route('single.article', [$article->id]) }}"><img src="{{ asset('uploads/' . $article->image_feature) }}"></a>
                                </figure>
                                <div class="careerfy-blog-grid-text">

                                    <h2><a href="{{ route('single.article', [$article->id]) }}">{{ $article->title }}</a></h2>
                                    <ul class="careerfy-blog-grid-option">
                                        <li>{{ $article->author_name }}</li>
                                        <li><time datetime="2008-02-14 20:00">{{ $article->created_at }}</time></li>
                                    </ul>
                                    {{-- <p>{!! $article->description !!}</p> --}}
                                    @php
                                        $start = strpos($article->description, '<p>');
                                        $end = strpos($article->description, '</p>', $start);
                                        $excerpt = substr($article->description, $start, $end-$start+4);
                                        $excerpt = html_entity_decode(strip_tags($excerpt));
                                        @endphp
                                        <p>{{ implode(' ', array_slice(explode(' ', $excerpt), 0, 17)) }}@if ( str_word_count($excerpt) > 17 )...@endif</p>
                                    <a href="{{ route('single.article', [$article->id]) }}" class="careerfy-read-more careerfy-bgcolor">اقرأ المزيد</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                    @endauth
                    @auth
                    @foreach($data['articles'] as $key => $article)
                    @if($article->author_name != 'admin')
                    <li class="col-md-4">
                        <div class="careerfy-employer-slider-wrap">

                            <div class="careerfy-content-wrapper careerfy-candidate careerfy-candidate-view4 cs-arti-grid">
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
                                    <p>{{ implode(' ', array_slice(explode(' ', $excerpt), 0, 8)) }}@if ( str_word_count($excerpt) > 8 )...@endif</p>                                    <a href="{{ route('single.article', [$article->id]) }}" class="careerfy-read-more careerfy-bgcolor">اقرأ المزيد</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    @elseif($article->author_name == 'admin')
                    <li class="col-md-4">
                        <div class="careerfy-employer-slider-wrap">

                            <div class="careerfy-content-wrapper careerfy-candidate careerfy-candidate-view4 cs-arti-grid">
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
                                    <a href="{{ route('single.article', [$article->id]) }}" class="careerfy-read-more careerfy-bgcolor">اقرأ المزيد</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endif
                    @endforeach
                    @endauth
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Main Section -->

@include('partials._pagination', ['records' => $data['articles']])


@endsection
