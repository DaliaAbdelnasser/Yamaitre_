

@extends('layouts.app')

@section('meta')
<title>{{ $data['page']->title }}  </title>
 <meta name="title" content="{{ $data['page']->meta_title??'' }}">
<meta name="description" content="{{ $data['page']->meta_desc??'' }}">
@endsection

@section('content')
<!-- SubHeader -->
<div class="careerfy-subheader careerfy-subheader-with-bg" style="background: url('{{ asset('frontend-assets/img/' . $data['slider']->image) }}');">
    <span class="careerfy-banner-transparent"></span>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="careerfy-page-title">
                    <h1>{{ $data['slider']->title }}</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- SubHeader -->


<!-- Main Content -->
<div class="careerfy-main-content">

    <!-- Main Section -->
    <div class="careerfy-main-section p-t-70">
        <span class="careerfy-transparent-white"></span>
        <div class="container" style="position: relative;">
            <div class="row">

                <!-- Job Detail SideBar -->
                <aside class="careerfy-column-3">
                    <div class="careerfy-typo-wrap">

                        <div class="widget widget_jobdetail_three_apply">
                            <div class="widget_jobdetail_three_apply_wrap">
                                <a href="javascript:void(0);"><img src="{{ asset('uploads/' . $data['distress']->users->first()->userable->profile_image) }}" alt=""></a>
                                <h2 style="text-align: center;"><a href="javascript:void(0);">{{ $data['distress']->users->first()->first_name }} {{ $data['distress']->users->first()->last_name }}</a></h2>
                                @php $rating = $data['distress']->users->first()->userable->rate; @endphp  
                                <div class="starss">
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
                                <p><i class="fa fa-map-marker"></i> محافظة {{ $data['distress']->users->first()->userable->governorates }}</p>
                                <p><i class="fa fa-link"></i> محكمة {{ $data['distress']->users->first()->userable->court_name }}</p>
                                <p>{{ $data['distress']->users->first()->userable->description }}</p>
                            </div>
                        </div>
                    </div>
                </aside>
                <!-- Job Detail SideBar -->
                <!-- Job Detail Content -->
                <div class="careerfy-column-9">
                    <div class="careerfy-typo-wrap">
                        <div class="careerfy-jobdetail-content">
                            @include('partials._ads-banners')

                            <div class="careerfy-jobdetail-content-section rltv">
                                <h3 class="task-title-1">{{ $data['distress']->type }}</h3>


                                <p class="m-t-10 task-stats">
                                    <strong><i class="careerfy-icon careerfy-calendar-1"></i> تاريخ الاستغاثة: <small>{{ $data['distress']->created_at }}</small></strong>
                                    <strong><i class="careerfy-icon careerfy-location"></i> المحافظة: <small>{{ $data['distress']->governorate }} </small> </strong><br>
                                    @if(auth()->user()->id != $data['distress']->users->first()->id)
                                    <strong><i class="fa fa-phone"></i> رقم هاتف المحامي: <small>{{ $data['distress']->users->first()->phone ?? '' }} </small> </strong>
                                    @endif
                                </p>

                                @auth
                                @if(auth()->user()->userable_type == 'App\Models\Lawyer' && auth()->user()->id != $data['distress']->users->first()->id)
                                <a class="careerfy-option-btn" href="tel:{{ $data['distress']->users[0]->phone ?? '' }}"> <i class="fa fa-phone"></i> اتصل بالمحامي</a>
                                @endif
                                @endauth
                                @guest
                                <a class="careerfy-option-btn" href="{{ route('login') }}"> <i class="fa fa-phone"></i> اتصل بالمحامي</a>
                                @endguest

                            </div>

                            <div class="clearfix"></div>
                            <hr>


                            <div class="clearfix"></div>
                            <hr>

                            <div class="careerfy-content-title">
                                <h2 class="m-t-20">تفاصيل الإستغاثة</h2>
                            </div>
                            <div class="careerfy-description">
                                <p>{{ $data['distress']->description }}</p>
                            </div>

                        </div>
                        @if(count($data['distresses']))
                        <div class="careerfy-section-title m-b-20 m-t-20">
                            <h2>نداءات الإستغاثة </h2>
                        </div>
                        @endif
                        <div class="careerfy-job careerfy-joblisting-classic careerfy-jobdetail-joblisting tasks-listing">
                            <ul class="careerfy-row">
                                @guest
                                @foreach($data['distresses'] as $distress)
                                <li class="careerfy-column-6">
                                    <div class="careerfy-featured-listing-text careerfy-joblisting-classic-wrap">
                                        <div class="widget_jobdetail_three_apply_wrap">
                                            <img src="{{ asset('uploads/' . $distress->users->first()->userable->profile_image) }}" alt="">
                                            <h6>{{ $distress->users->first()->first_name }} {{ $distress->users->first()->last_name }}</h6>
                                            @php $rating = $distress->users->first()->userable->rate; @endphp  
                                            <div class="starss">
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

                                        </div>
                                        <h2><a href="{{ route('single.sos', [$distress->id]) }}">{{ $distress->type }}</a></h2>

                                        <time datetime="2008-02-14 20:00">{{ $distress->created_at }}</time>
                                        <div class="careerfy-featured-listing-options">
                                            <p>{{ $distress->description }} </p>

                                            <a href="{{ route('single.sos', [$distress->id]) }}" class="careerfy-option-btn">شاهد المزيد</a>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                                @endauth
                                @auth
                                @foreach($data['distresses'] as $distress)
                                @if($distress->users[0]->id != auth()->user()->id && $distress != $data['distress'])
                                <li class="careerfy-column-6">
                                    <div class="careerfy-featured-listing-text careerfy-joblisting-classic-wrap">
                                        <div class="widget_jobdetail_three_apply_wrap">
                                            <img src="{{ asset('uploads/' . $distress->users->first()->userable->profile_image) }}" alt="">
                                            <h6>{{ $distress->users->first()->first_name }} {{ $distress->users->first()->last_name }}</h6>
                                            @php $rating = $distress->users->first()->userable->rate; @endphp  
                                            <div class="starss">
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

                                        </div>
                                        <h2><a href="{{ route('single.sos', [$distress->id]) }}">{{ $distress->type }}</a></h2>

                                        <time datetime="2008-02-14 20:00">{{ $distress->created_at }}</time>
                                        <div class="careerfy-featured-listing-options">
                                            <p>{{ $distress->description }} </p>

                                            <a href="{{ route('single.sos', [$distress->id]) }}" class="careerfy-option-btn">شاهد المزيد</a>
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
                <!-- Job Detail Content -->

            </div>
        </div>
    </div>
    <!-- Main Section -->

</div>
<!-- Main Content -->
@endsection
