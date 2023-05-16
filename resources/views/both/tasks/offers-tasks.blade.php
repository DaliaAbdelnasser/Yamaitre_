@extends('layouts.app')

@section('content')
<!-- SubHeader -->
<div class="careerfy-subheader careerfy-subheader-with-bg">
    <span class="careerfy-banner-transparent"></span>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="careerfy-page-title">
                    <h1>مهامي القانونية</h1>
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
                    <div class="careerfy-typo-wrap">
                        <div class="careerfy-employer-dasboard">
                            <div id="dashboard-tab-stats" class="main-tab-section">
                                <div class="careerfy-employer-dasboard">
                                    @if (session()->has('success'))
                                        <div class="alert alert-success text-center" role="alert">{{ session('success') }}</div>
                                    @endif 
                                    @if ($errors->any())
                                    @foreach ($errors->all() as $key => $error)
                                        <div class="alert alert-danger text-center" role="alert">{{ $error }}</div>
                                    @endforeach
                                    @endif
                                    <div id="careerfy-notification-section" class="careerfy-employer-box-section careerfy-dashnotifics-bars">
                                        <div class="careerfy-profile-title">
                                            <h2> عروض مقدمة من الغير</h2>
                                        </div>
                                        <div class="careerfy-main-section articles-section gray-bg ">
                                            <div class="row">
                                                <!-- Blog -->
                                                <div class="careerfy-blog careerfy-blog-grid">
                                                    <div class="careerfy-job-listing careerfy-featured-listing">
                                                        @if($data['tasks']->first() == null)
                                                            <p style="margin-right: 269px; margin-top: 35px; font-size: 20px">لا يوجد عروض بعد</p>
                                                        @endif
                                                        <ul class="careerfy-row">
                                                            @foreach($data['tasks'] as $task)
                                                            <li class="careerfy-column-12 col-xs-12">
                                                                <div class="careerfy-table-layer tasks-listing ">
                                                                    <div class="careerfy-featured-listing-text careerfy-joblisting-classic-wrap">
                                                                        <div class="widget_jobdetail_three_apply_wrap">
                                                                            <img src="{{ asset('uploads/' . $task->recommenderlawyers[0]->userable->profile_image) }}" alt="">
                                                                            <h6>{{ $task->recommenderlawyers[0]->first_name }} {{ $task->recommenderlawyers[0]->last_name }}</h6>
                                                                            @if($task->recommenderlawyers[0]->userable_type == 'App\Models\Lawyer')
                                                                            <div class="starss">
                                                                            @php $rating = $task->recommenderlawyers[0]->userable->rate; @endphp  
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
                                                                        </div>
                                                                        <h2><a href="{{ route('lawyer.show-single.task', [$task->id]) }}">{{ $task->title }}</a></h2>

                                                                        <p class="m-t-10 task-stats">
                                                                            <strong><i class="careerfy-icon careerfy-salary"></i> تكلفة المهمة :<small> {{ $task->price }} جنيه مصري</small></strong>
                                                                        </p>
                                                                        <div class="careerfy-featured-listing-options">
                                                                            <p>{{ $task->description }} </p>
                                                                            <p class="m-t-10 task-stats">
                                                                                <strong><i class="careerfy-icon careerfy-calendar-1"></i><small>{{ $task->starting_date ?? 'ديسمبر, 05, 2020' }}</small></strong>
                                                                                <strong><i class="careerfy-icon careerfy-location"></i> <small>{{ $task->governorates }} </small> </strong>
                                                                                <strong><small>{{ $task->applicants_count }}</small><i class="careerfy-icon careerfy-group"></i>  </strong>

                                                                            </p>
                                                                            <a href="{{ route('lawyer.show-single.task', [$task->id]) }}" class="careerfy-option-btn">شاهد المزيد</a>
                                                                            @if($task->applicantlawyers()->find(auth()->user()->id))
                                                                            <a href="javascript:void(0);" class="careerfy-option-btn  careerfy-bgcolor"><i class="fa fa-check"></i>  تم التقدم للمهمة </a>
                                                                            @else
                                                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#Jobapply-{{$task->id}}" class="careerfy-option-btn  careerfy-bgcolor"><i class="fa fa-check"></i>  تقدم للمهمة </a>
                                                                            @endif
                                                                            @if(!$task->invitedlawyers()->find(auth()->user()->id))
                                                                            <a href="javascript:void(0);" class="careerfy-option-btn  careerfy-bgcolor"><i class="fa fa-close"></i> تم رفض المهمة </a>
                                                                            @else
                                                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#rejectjob-{{$task->id}}" class="careerfy-option-btn  careerfy-bgcolor"><i class="fa fa-close"></i> رفض المهمة </a>
                                                                            @endif

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @include('partials._pagination', ['records' => $data['tasks']])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@foreach($data['tasks'] as $task)
<div class="modal fade" id="Jobapply-{{$task->id}}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تقدم للمهمة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            {!! Form::open(['route' => ['lawyer.apply.task', $task->id], 'method' => 'post']) !!}
            <div class="modal-body">
                    <div class="jobsearch-filter-responsive-wrap job-alerts-sec">
                        <div class="jobsearch-search-filter-wrap jobsearch-without-toggle jobsearch-add-padding">
                            <div class="job-alert-box job-alert job-alert-container-top">
                                <div class="alerts-fields">
                                    <p>تكلفة المهمة هي <strong>{{ $task->price }}</strong> جنيه.</p>
                                </div>
                                <div class="alerts-fields">
                                    {!! Form::label('cost', 'يمكنك تحديد قيمة اخرى للمهمة : ', [ 'class' => 'form-label']) !!}

                                    {!! Form::text('cost', $task->price , ['class' => 'form-control', 'placeholder' => "حدد قيمة المهمة"]) !!}
                                    
                                    @if(auth()->user()->accept_terms < 2)
                                    <div class="form-group">
                                        <br><p>يجب الموافقة على <span><a href="{{ route('terms') }}">الشروط والأحكام</a></span> حتى يتم قبول طلبك</p>
                                    {!! Form::checkbox('accept_terms', true, null, ['id' => 'accept_terms']) !!} 
                                    {!! Form::label('accept_terms', ' أوافق على الشروط و الأحكام ') !!}    
                                    </div>
                                    @endif
                                </div>
                                
                            </div>
                        </div>
                    </div>
            

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                {!! Form::submit('تقدم للمهمة', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>


<div class="modal fade" id="rejectjob-{{$task->id}}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">رفض المهمة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            {!! Form::open(['route' => ['lawyer.refuse.task', $task->id], 'method' => 'delete']) !!}
            <div class="modal-body">
                <h5>هل أنت متأكد من رفض هذه المهمة</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                {!! Form::submit('رفض المهمة', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endforeach
@endsection

@section('script')
<script>
    jQuery(document).ready(function() {
        jQuery(".jobsearch-usernotifics-menubtn a").mouseenter(function() {
            jQuery(".jobsearch-hdernotifics-listitms").css("opacity", "1");
            jQuery(".jobsearch-hdernotifics-listitms").css("visibility", "visible");

        })
        jQuery(".jobsearch-usernotifics-menubtn a").mouseleave(function() {
            jQuery(".jobsearch-hdernotifics-listitms").css("opacity", "0");
            jQuery(".jobsearch-hdernotifics-listitms").css("visibility", "hidden");

        })

        jQuery(".jobsearch-hdernotifics-listitms").mouseenter(function() {
            jQuery(".jobsearch-hdernotifics-listitms").css("opacity", "1");
            jQuery(".jobsearch-hdernotifics-listitms").css("visibility", "visible");

        })

        jQuery(".jobsearch-hdernotifics-listitms").mouseleave(function() {
            jQuery(".jobsearch-hdernotifics-listitms").css("opacity", "0");
            jQuery(".jobsearch-hdernotifics-listitms").css("visibility", "hidden");

        })

    });



    jQuery(document).ready(function() {
        jQuery(".jobsearch-userdash-menumain a.jobsearch-color").mouseenter(function() {
            jQuery(".jobsearch-userdash-menumain .sub-menu").css("opacity", "1");
            jQuery(".jobsearch-userdash-menumain .sub-menu").css("visibility", "visible");

        })
        jQuery(".jobsearch-userdash-menumain a.jobsearch-color").mouseleave(function() {
            jQuery(".jobsearch-userdash-menumain .sub-menu").css("opacity", "0");
            jQuery(".jobsearch-userdash-menumain .sub-menu").css("visibility", "hidden");

        })

        jQuery(".jobsearch-userdash-menumain .sub-menu").mouseenter(function() {
            jQuery(".jobsearch-userdash-menumain .sub-menu").css("opacity", "1");
            jQuery(".jobsearch-userdash-menumain .sub-menu").css("visibility", "visible");

        })

        jQuery(".jobsearch-userdash-menumain .sub-menu").mouseleave(function() {
            jQuery(".jobsearch-userdash-menumain .sub-menu").css("opacity", "0");
            jQuery(".jobsearch-userdash-menumain .sub-menu").css("visibility", "hidden");

        })

    });
</script>
@endsection
