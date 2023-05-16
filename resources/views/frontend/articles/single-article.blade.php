@extends('layouts.app')

@section('meta')
<title> {{ $data['article']->title }}  </title>
<meta name="title" content="{{ $data['page']->meta_title??'' }}">
<meta name="description" content="{{ $data['page']->meta_desc??'' }}">
@endsection

@push('styles')
<link href="{{ asset('frontend-assets/css/homepage-seven.css') }}" rel="stylesheet">
@endpush

@section('content')

<div class="careerfy-subheader careerfy-subheader-with-bg" style="background: url('{{ asset('frontend-assets/img/' . $data['slider']->image) }}');">
    <span class="careerfy-banner-transparent"></span>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="careerfy-page-title">
                    <h1>{{ $data['article']->title }}</h1>
                    <!--<p>{{ $data['slider']->subtitle }}</p>-->
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
                <div class="row">
                    <div class="col-md-9 careerfy-content-col pull-left">
                        @include('partials._ads-banners')

                        {{-- <figure class="careerfy-blog-thumb" style="background-image:  url('{{ asset('uploads/' . $data['article']->image_feature)}}');"></figure> --}}
                        {{-- <div class="owl-carousel article-banner">
                            @foreach ($data['article']->articles_images as $item)
                            <div> 
                                <figure class="careerfy-blog-thumb" style="background-image:  url('{{ asset('uploads/'.$item->image) }}');"></figure>
                            </div>
                            @endforeach
                        </div> --}}

                        {{-- <div class="careerfy-employer careerfy-employer-slider careerfy-blog careerfy-blog-grid">
                            @foreach ($data['article']->articles_images as $item)
                            <div class="careerfy-employer-slider-wrap">
                                <div class="careerfy-content-wrapper careerfy-candidate careerfy-candidate-view4">
                                    <figure class="careerfy-blog-thumb" style="background-image:  url('{{ asset('uploads/'.$item->image) }}');"></figure>
                                </div>
                            </div>

                            @endforeach
                        </div> --}}

                        <div class="content-col-wrap">
                            <div class="careerfy-detail-wrap">
                                <div class="careerfy-detail-editore">
                                    <h4><strong>{{ $data['article']->title }}</strong></h4>

                                    <div class="post-images">
                                        <div class="lightRow">
                                            @foreach ($data['article']->articles_images as $key => $value)

                                            <div class="lightCol">
                                                <img src="{{ asset('uploads/'.$value->image) }}" style="width:100%" onclick="openLight();currentLight({{$key}})" class="hover-shadow">
                                            </div>

                                            @endforeach
                                        </div>

                                        <div id="lightBox" class="theLightBox">
                                            <span class="closeBox" onclick="closeLight()">&times;</span>

                                            <!-- big images that display
                                        dimensions: 1000 x 350 -->

                                            <div class="lightImgL">

                                                <!-- the slide up top -->
                                                <?php $nu =  count($data['article']->articles_images); ?>
                                                @foreach ($data['article']->articles_images as $key => $value)
                                                <div class="lightSlides">
                                                    <div class="lightCurrent"> {{++$key}} / {{$nu}}</div>
                                                    <img class="largeLightImgTop" src="{{ asset('uploads/'.$value->image) }}" alt="Stylist: Elyse Crow / Photography: Jensen Graves">
                                                </div>
                                                @endforeach

                                                <!-- next / previous buttons and calls to JS function -->

                                                <a class="prevBtn" onclick="plusLight(-1)">&#10094;</a>
                                                <a class="nextBtn" onclick="plusLight(1)">&#10095;</a>

                                                <!-- for displaying captions -->

                                            </div>


                                        </div>
                                    </div>

                                    <p>{!! $data['article']->description !!}</p>
                                </div>
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="involved-social-icone">
                                            <div class="cs-social-share">
                                                <h6 class="m-b-20">شارك المنشور:</h6>

                                                <a class="share-btn share-btn-inverse share-btn-twitter" href="https://twitter.com/share?url=http%3A%2F%2Fcodepen.io%2Fsunnysingh%2Fpen%2FOPxbgq&text=Share Buttons Demo&via=sunnyismoi" title="Share on Twitter" target="_blank">
                                                    <span class="share-btn-icon"></span>
                                                    <span class="share-btn-text">Twitter</span>
                                                </a>

                                                <a class="share-btn share-btn-inverse share-btn-facebook" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fcodepen.io%2Fsunnysingh%2Fpen%2FOPxbgq" title="Share on Facebook" target="_blank">
                                                    <span class="share-btn-icon"></span>
                                                    <span class="share-btn-text">Facebook</span>
                                                </a>

                                                <a class="share-btn share-btn-inverse share-btn-email" href="mailto:?subject=Share Buttons Demo&body=http%3A%2F%2Fcodepen.io%2Fsunnysingh%2Fpen%2FOPxbgq" title="Share via Email" target="_blank">
                                                    <span class="share-btn-icon"></span>
                                                    <span class="share-btn-text">Email</span>
                                                </a>

                                                <a class="share-btn share-btn-inverse share-btn-more" href="https://www.addtoany.com/share_save?linkurl=http%3A%2F%2Fcodepen.io%2Fsunnysingh%2Fpen%2FOPxbgq" title="More share options" target="_blank">
                                                    <span class="share-btn-icon"></span>
                                                    <span class="share-btn-text-sr">المزيد</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="careerfy-prenxt-post cs-rec-ar">
                                    <ul>
                                        @if($data['previous'] != null)
                                        <li class="careerfy-prenxt-post @if($data['next'] != null) prev-alone @endif">
                                            <figure><img src="{{ asset('uploads/' . $data['previous']->image_feature) }}" alt=""></figure>
                                            <div class="careerfy-prev-post">
                                                <h6>
                                                    <a href="{{ route('single.article', [$data['previous']->id]) }}">{!! $data['previous']->title !!}...</a>
                                                </h6>
                                                <a href="{{ route('single.article', [$data['previous']->id]) }}" class="careerfy-arrow-nexpre"> المنشور السابق <i class="careerfy-icon careerfy-arrow-left2"></i>                                   </a>
                                            </div>
                                        </li>
                                        @endif
                                        @if($data['next'] != null)
                                        <li class="careerfy-post-next @if($data['next'] != null) next-alone @endif">
                                            <figure><img src="{{ asset('uploads/' . $data['next']->image_feature) }}" alt=""></figure>
                                            <div class="careerfy-next-post">
                                                <h6>
                                                    <a href="{{ route('single.article', [$data['next']->id]) }}">{!! $data['next']->title !!}...</a>
                                                </h6>
                                                <a href="{{ route('single.article', [$data['next']->id]) }}" class="careerfy-arrow-nexpre"> <i class="careerfy-icon careerfy-arrow-right2"></i> المنشور التالي </a>
                                            </div>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                                <footer class="careerfy-post-footer"></footer>
                            </div>

                        </div>
                    </div>

                    <aside class="col-md-3 careerfy-sidebar-col pull-right">
                        <div id="careerfy_recent_posts-2" class="widget widget_careerfy_recposts">
                            <div class="careerfy-widget-title">
                                <h2>أحدث المنشورات</h2>
                            </div>
                            <div class="widget_recent_posts">
                                <div class="recent-posts cs-rec-ar">
                                    <ul>
                                        @foreach($data['few_articles'] as $article)
                                        <li>
                                            <figure>
                                                <a title="One morning, when Gregor Samsa woke from troubled dreams" href="{{ route('single.article', [$article->id]) }}">
                                                    <img src="{{ asset('uploads/' . $article->image_feature) }}" alt="One morning, when Gregor Samsa woke from troubled dreams">
                                                </a>
                                            </figure>
                                            <div class="recent-post-text">
                                                @php
                                        $start = strpos($article->description, '<p>');
                                        $end = strpos($article->description, '</p>', $start);
                                        $excerpt = substr($article->description, $start, $end-$start+4);
                                        $excerpt = html_entity_decode(strip_tags($excerpt));
                                        @endphp
                                        <p>{{ implode(' ', array_slice(explode(' ', $excerpt), 0, 15)) }}@if ( str_word_count($excerpt) > 15 )...@endif</p>
                                        <a href="{{ route('single.article', [$article->id]) }}" class="read-more-btn"><i class="careerfy-icon careerfy-right-arrow-long"></i> اقرأ المزيد</a>
                                            </div>
                                        </li>
                                        @endforeach
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </aside>


                </div>
            </div>



        </div>
    </div>
</div>
<!-- Main Section -->

<div class="careerfy-main-section articles-section jobsearch-main-section careerfy-employer-slider-full m-t-0 p-t-0">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <!-- Fancy Title -->
                <section class="careerfy-fancy-title">
                    <p>{{ $data['page']->sections->first()->section_title ?? '' }}</p>
                    <h2>{{ $data['page']->sections->first()->subtitle ?? '' }}</h2>

                </section>

            </div>
            <div class="careerfy-employer careerfy-employer-slider careerfy-blog careerfy-blog-grid">
                @foreach($data['recent_articles'] as $article)
                <div class="careerfy-employer-slider-wrap">

                    <div class="careerfy-content-wrapper careerfy-candidate careerfy-candidate-view4 cs-ar-grid">
                        <figure>
                            <a href="{{ route('single.article', [$article->id]) }}"><img src="{{ asset('uploads/' . $article->image_feature) }}"></a>
                        </figure>
                        <div class="careerfy-blog-grid-text">

                            <h2><a href="#">{{ $article->title }}</a></h2>
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
                            <p>{{ implode(' ', array_slice(explode(' ', $excerpt), 0, 15)) }}@if ( str_word_count($excerpt) > 15 )...@endif</p>
                            <a href="{{ route('single.article', [$article->id]) }}" class="careerfy-read-more careerfy-bgcolor">اقرأ المزيد</a>
                        </div>
                    </div>


                </div>
                @endforeach
            </div>

        </div>
    </div>
</div>


<script>
    // opens lightbox when one of the gallery images is clicked

    function openLight() {
        document.getElementById("lightBox").style.display = "block";
    }

    // closes the lightbox when you click the big X

    function closeLight() {
        document.getElementById("lightBox").style.display = "none";
    }

    var lightIndex = 1;
    showLight(lightIndex);

    // moves slides when you click previous or next buttons

    function plusLight(n) {
        showLight(lightIndex += n);
    }

    // shows the current slide at a bigger size 

    function currentLight(n) {
        showLight(lightIndex = n);
    }

    function showLight(n) {
        var i;
        var slides = document.getElementsByClassName("lightSlides");
        var captionText = document.getElementById("displayCaption");
        if (n > slides.length) {
            lightIndex = 1
        }
        if (n < 1) {
            lightIndex = slides.length
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slides[lightIndex - 1].style.display = "block";
    }
</script>

@endsection

