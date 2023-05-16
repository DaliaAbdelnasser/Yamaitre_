@extends('layouts.app')

@section('meta')
<title>{{ $data['page']->title }}  </title>
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

                        <div class="row">

                            @if (count($data['governorates']))
                            <form class="m-t-20">
                                <div class="col-md-2"></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select onchange="window.location.href=this.options[this.selectedIndex].value;" class="form-control" id="meeting">
                                            <option value="">اختر المحافظة</option>
                                            @foreach($data['governorates']  as $city)
                                            <option value="{{ route('tasks.list', ['city' => $city]) }}">
                                                {{ $city }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select onchange="window.location.href=this.options[this.selectedIndex].value;"  class="form-control" id="topic">
                                            <option value="">ترتيب المهام</option>=
                                            <option value="{{ route('tasks.list', ['order_by' => 'highest price']) }}">الأعلى سعرًا</option>
                                            <option value="{{ route('tasks.list', ['order_by' => 'lowest price']) }}">الأقل سعرًا</option>
                                            <option value="{{ route('tasks.list', ['order_by' => 'newest']) }}">الأحدث</option>
                                            <option value="{{ route('tasks.list', ['order_by' => 'oldest']) }}">الأقدم</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                                <div class="clearfix"></div>
                            </form>
                            @endif
                        </div>
                        <div class="careerfy-job-listing careerfy-featured-listing">
                            <ul class="careerfy-row">
                                @foreach($data['tasks'] as $task)
                                <li class="careerfy-column-4">
                                    <div class="careerfy-table-layer tasks-listing">
                                        <div class="careerfy-featured-listing-text careerfy-joblisting-classic-wrap">    
                                            <div class="widget_jobdetail_three_apply_wrap cs-tasks">
                                                @if($task->user->first()->userable->profile_image != null)
                                                <img src="{{ asset('uploads/' . $task->user->first()->userable->profile_image) }}" style="height:60px;" alt="">    
                                                @else
                                                <img src="{{ asset('uploads/logo.png') }}" style="height:60px;" alt=""> 
                                                @endif   
                                                <h6>{{ $task->user->first()->first_name ?? ''}} {{ $task->user->first()->last_name ?? '' }}</h6>
                                                @if( $task->user->first()->userable_type == 'App\Models\Lawyer') 
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
                                                @else
                                                    <div  class="starss" style="margin-top:33px;"></div>
                                                @endif
                                            <h2><a href="{{ route('single.task', [$task->id]) }}">{{ $task->title }}</a></h2>

                                            <p class="m-t-10 task-stats">
                                                <strong><i class="careerfy-icon careerfy-salary"></i> تكلفة المهمة :<small> {{$task->price}} جنيه مصري</small></strong>
                                            </p>
                                            <div class="careerfy-featured-listing-options">
                                                <p>{{ $task->description }}</p>
                                                <p class="m-t-10 task-stats">
                                                    <strong><i class="careerfy-icon careerfy-calendar-1"></i><small>{{ $task->created_at }}</small></strong>
                                                    <strong><i class="careerfy-icon careerfy-location"></i> <small>{{ $task->governorates }}</small> </strong>
                                                    <strong><small>{{ $task->applicants_count }}</small><i class="careerfy-icon careerfy-group"></i>  </strong>
                                                </p>
                                                <a href="{{ route('single.task', [$task->id]) }}" class="careerfy-option-btn">شاهد المزيد</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- Featured Jobs Listings -->

                    </div>
                </div>
            </div>
        </div>
        <!-- Main Section -->


    @include('partials._pagination', ['records' => $data['tasks']])

    <!-- Main Content -->


@endsection