@extends('layouts.app')

@section('content')
<!-- SubHeader -->
<div class="careerfy-subheader careerfy-subheader-with-bg">
    <span class="careerfy-banner-transparent"></span>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="careerfy-page-title">
                    <h1>مهمتي</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="careerfy-breadcrumb">

    </div>
</div>
<!-- SubHeader -->

<!-- Main Content -->
<div class="careerfy-main-content">
    <!-- Main Section -->
    <div class="careerfy-main-section careerfy-dashboard-fulltwo m-t-80">
        <div class="container">
            <div class="row">
            @include('partials._user-sidebar')
                <div class="careerfy-column-9">
                    <div class="careerfy-employer-dasboard">
                        <div class="careerfy-employer-box-section ">
                            <div class="careerfy-profile-title">
                            @if(url()->previous() == 'http://127.0.0.1:8000/lawyer/offers-tasks')
                                <h2> عروض مقدمة من الغير</h2>
                            @else
                                <h2> مهام لحساب الغير</h2>
                            @endif
                            </div>
                            <div class="careerfy-main-section articles-section gray-bg ">
                                <div class="careerfy-blog careerfy-blog-grid">
                                    <div class="careerfy-jobdetail-content-section rltv">
                                        <h3 class="task-title-1">{{ $task->title }}</h3>
                                        <p class="m-t-10 task-stats">
                                            <strong><i class="careerfy-icon careerfy-calendar-1"></i> تاريخ التنفيذ: <small>{{ $task->starting_date ?? 'ديسمبر, 05, 2020' }}</small></strong>
                                            <strong><i class="careerfy-icon careerfy-location"></i> المحافظة: <small>{{ $task->governorates }} </small> </strong>
                                            <strong><i class="careerfy-icon careerfy-group"></i> متقدمين: <small>{{ $task->applicants_count }} </small> </strong>

                                        </p>
                                        <div class="careerfy-jobdetail-services">
                                            <ul class="careerfy-row">
                                                <li class="careerfy-column-4">
                                                    <i class="careerfy-icon careerfy-salary"></i>
                                                    <div class="careerfy-services-text">تكلفة المهمة: <small>£{{ $task->price }}+</small></div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>
                                    <hr>

                                    <div class="careerfy-content-title">

                                        <h2 class="m-t-20">تفاصيل المهمة</h2>
                                    </div>

                                    <div class="careerfy-description">
                                        <p>{{ $task->description }}</p>
                                    </div>

                                </div>
                                <div class="clearfix"></div>
                                <hr>
                                <div class="careerfy-job-listing careerfy-featured-listing">
                                    <h5 class="m-t-20">الناشر  </h5>
                                    <ul class="careerfy-row inside-lawyers">
                                        <li class="careerfy-column-12 col-xs-12">
                                            <div class="careerfy-table-layer tasks-listing careerfy-candidate-view4">
                                                <div class="careerfy-employer-slider-wrap">
                                                    <div class="careerfy-content-wrapper careerfy-candidate careerfy-candidate-view4">
                                                        <div class="careerfy-candidate-view4-wrap">
                                                            <figure>
                                                                <img src="{{ asset('uploads/' . $task->user[0]->userable->profile_image) }}" alt="">
                                                            </figure>
                                                            <div class="lawyer-info">
                                                                <h2>{{ $task->user[0]->first_name }} {{ $task->user[0]->last_name }}</h2>
                                                                <p>محامي بال {{ $task->user[0]->userable->court_name }}</p>
                                                                <p>محافظة {{ $task->user[0]->userable->governorates }}</p>
                                                                <span>{{ $task->user[0]->userable->tasks_count }} مهمة</span>
                                                                <p>{{ $task->user[0]->userable->description }}</p>
                                                                @if($task->user[0]->userable_type == 'App\Models\Lawyer')
                                                                <div class="starss">@php $rating = $task->user[0]->userable->rate; @endphp  
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
                                                                @endforeach</div>
                                                                @endif
                                                                <hr>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
   
@endsection

@section('script')
<script>
$('li > a').click(function() {
    $('li').removeClass();
    $(this).parent().addClass('active');
});
</script>
@endsection
