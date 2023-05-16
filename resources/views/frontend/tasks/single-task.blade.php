@extends('layouts.app')

@section('meta')
<title>{{ $data['page']->title?? '' }}  </title>
<meta name="title" content="{{ $data['page']->meta_title??'' }}">
<meta name="description" content="{{ $data['page']->meta_desc?? '' }} ">
@endsection

@section('content')

<!-- SubHeader -->
<div class="careerfy-subheader careerfy-subheader-with-bg"  style="background: url(frontend-assets/img/{{$data['slider']->image}});">
    <span class="careerfy-banner-transparent"></span>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="careerfy-page-title">
                    <h1>{{ $data['slider']->title}} </h1>
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
                                <a href="javascript:void(0);">
                                    @if($data['task']->user->first()->userable->profile_image != null)
                                    <img src="{{ asset('uploads/' . $data['task']->user->first()->userable->profile_image) }}" alt="">    
                                    @else
                                    <img src="{{ asset('uploads/logo.png') }}" alt="">
                                    @endif  
                                </a>
                                <h2 style="text-align: center;"><a href="javascript:void(0);">{{ $data['task']->user->first()->first_name }} {{ $data['task']->user->first()->last_name }}</a></h2>
                                @if( $data['task']->user->first()->userable_type == 'App\Models\Lawyer')     
                                <div class="starss">
                                    @php $rating = $data['task']->user->first()->userable->rate; @endphp  
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
                                @endif
                                <p><i class="fa fa-map-marker"></i> {{ $data['task']->user->first()->userable->governorates }}</p>
                                <p><i class="fa fa-link"></i> {{ $data['task']->user->first()->userable->court_name }}</p>
                                <p>{{ $data['task']->user->first()->userable->description }}</p>
                            </div>
                        </div>
                    </div>
                </aside>
                <!-- Job Detail SideBar -->
                <!-- Job Detail Content -->
                <div class="careerfy-column-9">
                    <div class="careerfy-typo-wrap">
                        @if (session()->has('success'))
                            <div class="alert alert-success text-center" role="alert">{{ session('success') }}</div>
                        @endif
                        @if ($errors->any())
                        @foreach ($errors->all() as $key => $error)
                            <div class="alert alert-danger text-center" role="alert">{{ $error }}</div>
                        @endforeach
                        @endif 
                        <div class="careerfy-jobdetail-content">
                        @include('partials._ads-banners')

                            <div class="careerfy-jobdetail-content-section rltv">
                                <h3 class="task-title-1">{{ $data['task']->title }}</h3>


                                <p class="m-t-10 task-stats">
                                    <strong><i class="careerfy-icon careerfy-calendar-1"></i> تاريخ التنفيذ: <small>{{ $data['task']->starting_date }}</small></strong>
                                    <strong><i class="careerfy-icon careerfy-location"></i> المحافظة: <small>{{ $data['task']->governorates }} </small> </strong>
                                    <strong><i class="careerfy-icon careerfy-group"></i> متقدمين: <small>{{ $data['task']->applicants_count }} </small> </strong>

                                </p>
                                @auth
                                @if(auth()->user()->userable_type == 'App\Models\Lawyer' && auth()->user()->id != $data['task']->user->first()->id)
                                <a class="careerfy-option-btn" data-toggle="modal" data-target="#Jobapply">تقدم للمهمة</a>
                                @endif
                                @endauth
                                @guest
                                <a class="careerfy-option-btn" href="{{ route('login') }}">تقدم للمهمة</a>
                                @endguest
                                <div class="careerfy-jobdetail-services">
                                    <ul class="careerfy-row">
                                        <li class="careerfy-column-4">
                                            <i class="careerfy-icon careerfy-salary"></i>
                                            <div class="careerfy-services-text">تكلفة المهمة: <small>£{{ $data['task']->price }}+</small></div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                            <hr>


                            <div class="clearfix"></div>
                            <hr>

                            <div class="careerfy-content-title">
                                <h2 class="m-t-20">تفاصيل المهمة</h2>
                            </div>
                            <div class="careerfy-description">
                            <p>{{ $data['task']->description }}</p>
                            </div>

                        </div>
                        <div class="careerfy-section-title m-b-20 m-t-20">
                            @if($data['related_tasks']->first() != null)
                            <h2>مهام مشابهة</h2>
                            @endif
                        </div>
                        <div class="careerfy-job careerfy-joblisting-classic careerfy-jobdetail-joblisting tasks-listing">
                            <ul class="careerfy-row">
                                @foreach($data['related_tasks'] as $task)
                                <li class="careerfy-column-6">
                                    <div class="careerfy-table-layer">
                                        <div class="careerfy-table-row">

                                            <div class="careerfy-featured-listing-text careerfy-joblisting-classic-wrap">
                                                <div class="widget_jobdetail_three_apply_wrap">
                                                    @if($task->user->first()->userable->profile_image != null) 
                                                    <img src="{{ asset('uploads/' . $task->user->first()->userable->profile_image) }}" style = "height:60px;" alt="">
                                                    @else
                                                    <img src="{{ asset('uploads/logo.png') }}" style = "height:60px;" alt="">
                                                    @endif  
                                                    <h6>{{ $task->user->first()->name }}</h6>
                                                    @if( $task->user->first()->userable_type == 'App\Models\Lawyer')     
                                                    <div class="starss">
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
                                                    @endif
                                                </div>
                                                <h2><a href="#">{{ $task->title }}</a></h2>

                                                <p class="m-t-10 task-stats">
                                                    <strong><i class="careerfy-icon careerfy-salary"></i> تكلفة المهمة :<small> {{ $task->price }} جنيه مصري</small></strong>
                                                </p>
                                                <div class="careerfy-featured-listing-options">
                                                    <p>{{ $task->description }}</p>
                                                    <p class="m-t-10 task-stats">
                                                        <strong><i class="careerfy-icon careerfy-calendar-1"></i><small>{{ $task->created_at }}</small></strong>
                                                        <strong><i class="careerfy-icon careerfy-location"></i> <small>{{ $task->governorates }} </small> </strong>
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
                    </div>
                </div>
                <!-- Job Detail Content -->

            </div>
        </div>
    </div>
    <!-- Main Section -->

</div>
@auth
@if(auth()->user()->userable_type == 'App\Models\Lawyer')
<!-- Main Content -->
<div class="modal fade" id="Jobapply" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تقدم للمهمة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            {!! Form::open(['route' => ['lawyer.apply.task', $data['task']->id], 'method' => 'POST']) !!}
            <div class="modal-body">
                <div class="jobsearch-filter-responsive-wrap job-alerts-sec">
                    <div class="jobsearch-search-filter-wrap jobsearch-without-toggle jobsearch-add-padding">
                        <div class="job-alert-box job-alert job-alert-container-top">
                            <div class="alerts-fields">
                                <p>تكلفة المهمة هي <strong>{{ $data['task']->price }}</strong> جنيه.</p>
                            </div>
                            <div class="alerts-fields">
                                {!! Form::label('cost', 'يمكنك تحديد قيمة اخرى للمهمة', [ 'class' => 'form-label']) !!}
                                {!! Form::text('cost', $data['task']->price , ['class' => 'form-control', 'placeholder' => "حدد قيمة المهمة"]) !!}
                            </div>
                            @if(auth()->user()->accept_terms < 2)
                            <div class="form-group">
                                <p>يجب الموافقة على <span><a href="{{ route('terms') }}" target="_blank">الشروط والأحكام</a></span> حتى يتم قبول طلبك</p>
                            {!! Form::checkbox('accept_terms', true, null, ['id' => 'accept_terms']) !!} 
                            {!! Form::label('accept_terms', ' أوافق على الشروط و الأحكام ') !!}    
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {!! Form::button('إلغاء', ['class' => 'btn btn-secondary', 'data-dismiss' => "modal"]) !!}
                {!! Form::submit('تقدم للمهمة', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endif
@endauth
@endsection
