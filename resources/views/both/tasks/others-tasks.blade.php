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
                        @if (session()->has('success'))
                            <div class="alert alert-success text-center" role="alert">{{ session('success') }}</div>
                        @endif
                        @if ($errors->any())
                        @foreach ($errors->all() as $key => $error)
                            <div class="alert alert-danger text-center" role="alert">{{ $error }}</div>
                        @endforeach
                        @endif 
                        <div id="dashboard-tab-stats" class="main-tab-section">
                            <div class="careerfy-employer-dasboard">
                                <div id="careerfy-notification-section" class="careerfy-employer-box-section careerfy-dashnotifics-bars">
                                    <div class="careerfy-profile-title">
                                        <h2> مهام لحساب الغير </h2>
                                    </div>

                                    <div class="careerfy-main-section articles-section gray-bg ">
                                        <div class="row">
                                            <!-- Blog -->
                                            <div class="careerfy-blog careerfy-blog-grid">
                                                <div id="exTab1">
                                                    <ul class="nav nav-pills">
                                                        <li class="active">
                                                            <a href="#1b" data-toggle="tab" aria-expanded="false">   مهام لحساب الغير  </a>
                                                        </li>
                                                        <li><a href="#2b" data-toggle="tab" aria-expanded="true">قيد التنفيذ  </a>
                                                        </li>
                                                        <li><a href="#3b" data-toggle="tab" aria-expanded="true">قيد المراجعة  </a>
                                                        </li>
                                                        <li><a href="#4b" data-toggle="tab" aria-expanded="true"> مهام مكتملة  </a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content clearfix">
                                                        <div class="tab-pane active" id="1b">
                                                            <div class="careerfy-job-listing careerfy-featured-listing">
                                                                @if($data['tasks']->first() == null)
                                                                    <p style="margin-right: 269px; margin-top: 35px; font-size: 20px">لا يوجد مهام بعد</p>
                                                                @endif
                                                                <ul class="careerfy-row">
                                                                    @foreach($data['tasks'] as $task)
                                                                    <li class="careerfy-column-12 col-xs-12">
                                                                        <div class="careerfy-table-layer tasks-listing ">
                                                                            <div class="careerfy-featured-listing-text careerfy-joblisting-classic-wrap">
                                                                                <div class="widget_jobdetail_three_apply_wrap">
                                                                                    <img src="{{ asset('uploads/' . $task->user[0]->userable->profile_image) }}" alt="">
                                                                                    <h6>{{ $task->user[0]->first_name }} {{ $task->user[0]->last_name }}</h6>
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
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane" id="2b">
                                                            <div class="careerfy-job-listing careerfy-featured-listing">
                                                                @if($data['inprogress']->first() == null)
                                                                    <p style="margin-right: 269px; margin-top: 35px; font-size: 20px">لا يوجد مهام بعد</p>
                                                                @endif
                                                                <ul class="careerfy-row">
                                                                    @foreach($data['inprogress'] as $key => $task)
                                                                    <li class="careerfy-column-12 col-xs-12">
                                                                        <div class="careerfy-table-layer tasks-listing ">
                                                                            <div class="careerfy-featured-listing-text careerfy-joblisting-classic-wrap">
                                                                                <div class="widget_jobdetail_three_apply_wrap">
                                                                                    <img src="{{ asset('uploads/' . $task->user[0]->userable->profile_image) }}"alt="">
                                                                                    <h6>{{ $task->user[0]->first_name }} {{ $task->user[0]->last_name }}</h6>
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
                                                                                    {{--@if($data['chats']->first() != null && $data['chats'][$key] != null)
                                                                                    <a href="{{ route('lawyer.chat.room', $data['chats'][$key]->id) }}" class="careerfy-option-btn"><i class="fa fa-comments "></i> ابدأ المحادثة </a>
                                                                                    @endif--}}
                                                                                    {{--
                                                                                    @if(auth()->user()->userable_type == 'App\Models\Lawyer')
                                                                                    {!! Form::open(['route' => ['lawyer.single-room',  $chat_id], 'method' => 'post']) !!}
                                                                                    @elseif(auth()->user()->userable_type == 'App\Models\Client')
                                                                                    {!! Form::open(['route' => ['client.single-room',  $chat_id], 'method' => 'post']) !!}
                                                                                    @endif
                                                                                    {!! Form::hidden('lawyer_id', $task->user[0]->id) !!}
                                                                                    {!! Form::hidden('type', 'reciever') !!}
                                                                                    {!! Form::button('<i class="fa fa-comments "></i> ابدأ المحادثة ', ['type' => 'submit', 'class' => 'careerfy-option-btn ']) !!}
                                                                                    {!! Form::close() !!}--}}
                                                                                    @if($data['chats'][$key]->first() != null)
                                                                                    @if(auth()->user()->userable_type == 'App\Models\Lawyer')
                                                                                    <a href="{{ route('lawyer.chat.room', $data['chats'][$key]->first()->id) }}" class="careerfy-option-btn"><i class="fa fa-comments "></i> ابدأ المحادثة </a>
                                                                                    @elseif(auth()->user()->userable_type == 'App\Models\Client')
                                                                                    <a href="{{ route('client.chat.room', $data['chats'][$key]->first()->id) }}" class="careerfy-option-btn"><i class="fa fa-comments "></i> ابدأ المحادثة </a>
                                                                                    @endif
                                                                                    @endif
                                                                                    <!-- {!! Form::button('<i class="fa fa-upload"></i> إرفق ملف المهمة ', ['class' => 'careerfy-option-btn  careerfy-bgcolor', 'data-toggle' => "modal",  'data-target' => "#addfile-{{ $task->id }}"]) !!} -->
                                                                                    <a href="" data-toggle="modal" data-target="#addfile-{{ $task->id }}" class="careerfy-option-btn  careerfy-bgcolor"><i class="fa fa-upload"></i> إرفق ملف المهمة </a>

                                                                                    
                                                                                    <!-- <a href="chat.html" class="careerfy-option-btn"><i class="fa fa-comments"></i> ابدأ المحادثة </a> -->
                                                                                    <!-- <a href="#" data-toggle="modal" data-target="#addfile-{{ $task->id }}" class="careerfy-option-btn  careerfy-bgcolor"><i class="fa fa-upload"></i> إرفق ملف المهمة </a> -->
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane" id="3b">
                                                            @if($data['inreview']->first() == null)
                                                                <p style="margin-right: 269px; margin-top: 35px; font-size: 20px">لا يوجد مهام بعد</p>
                                                            @endif
                                                            <ul class="careerfy-row">
                                                                @foreach($data['inreview'] as $task)
                                                                <li class="careerfy-column-12 col-xs-12">
                                                                    <div class="careerfy-table-layer tasks-listing ">
                                                                        <div class="careerfy-featured-listing-text careerfy-joblisting-classic-wrap">
                                                                            <div class="widget_jobdetail_three_apply_wrap">
                                                                                <img src="{{ asset('uploads/' . $task->user[0]->userable->profile_image) }}" alt="">
                                                                                <h6>{{ $task->user[0]->first_name }} {{ $task->user[0]->last_name }}</h6>
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
                                                                                <a href="{{ asset('uploads/' . $task->task_file) }}" class="careerfy-option-btn  careerfy-bgcolor" download><i class="fa fa-file"></i> ملف المهمة </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                        <div class="tab-pane" id="4b">
                                                            @if($data['completed']->first() == null)
                                                                <p style="margin-right: 269px; margin-top: 35px; font-size: 20px">لا يوجد مهام بعد</p>
                                                            @endif
                                                            <ul class="careerfy-row">
                                                                @foreach($data['completed'] as $task)
                                                                <li class="careerfy-column-12 col-xs-12">
                                                                    <div class="careerfy-table-layer tasks-listing ">
                                                                        <div class="careerfy-featured-listing-text careerfy-joblisting-classic-wrap">
                                                                            <div class="widget_jobdetail_three_apply_wrap">
                                                                                <img src="{{ asset('uploads/' . $task->user[0]->userable->profile_image) }}" alt="">
                                                                                <h6>{{ $task->user[0]->first_name }} {{ $task->user[0]->last_name }}</h6>
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
                                                                                <a href="{{ asset('uploads/' . $task->task_file) }}" class="careerfy-option-btn  careerfy-bgcolor" download><i class="fa fa-file"></i> ملف المهمة </a>
                                                                                <a class="careerfy-option-btn"><i class="fa fa-check"></i> مهمة مكتملة</a>
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
                            </div>
                        </div>

                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
   
@foreach($data['inprogress'] as $task)
<div class="modal fade" id="addfile-{{ $task->id }}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">إرفاق ملف المهمة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['route' => ['lawyer.upload.file', $task->id], 'method' => 'POST', 'files' => true]) !!}
            <div class="modal-body">
                <h6>قم بإرفاق ملف المهمة</h6>
                {!! Form::file('task_file', array_merge(['class' => 'form-file', 'accept' => ".png, .jpg, .jpeg, .csv, .txt, .xlx, .xls, .pdf"])) !!}
            </div>
            <div class="modal-footer">
                {!! Form::button('إلغاء', ['class' => 'btn btn-secondary ', 'data-dismiss' => "modal"]) !!}
                {!! Form::submit('إرفق الملف', ['class' => 'btn btn-primary ']) !!}
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
