@extends('layouts.app')

@section('content')
<!-- SubHeader -->
<div class="careerfy-subheader careerfy-subheader-with-bg">
    <span class="careerfy-banner-transparent"></span>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="careerfy-page-title">
                    <h1>@if(auth()->user()->userable_type == 'App\Models\Lawyer') مهامي القانونية @else طلبات المساعدة القانونية @endif</h1>
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
                                        <h2> طلباتي المعروضة على المحامين </h2>
                                        <a href="#" data-toggle="modal" data-target="#addtask" class="careerfy-static-btn careerfy-bgcolor m-t-20 m-b-20">@if(auth()->user()->userable_type == 'App\Models\Lawyer') نشر مهمة عمل @else طلب مساعدة قانونية @endif</a>

                                    </div>

                                    <div class="careerfy-main-section articles-section gray-bg ">
                                        <div class="row">
                                            <!-- Blog -->
                                            <div class="careerfy-blog careerfy-blog-grid">
                                                <div id="exTab1">
                                                    <ul class="nav nav-pills">
                                                        <li class="active">
                                                            <a href="#1b" data-toggle="tab" aria-expanded="false">   طلباتي المعروضة  </a>
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
                                                                <li class="careerfy-column-12 col-xs-12" hidden="hidden" id="new-task-added">
                                                                        <div class="careerfy-table-layer tasks-listing ">
                                                                            <div class="edit-panel">
                                                                                <div class="btn-group ">
                                                                                    <button type="button" class="dropdown-toggle mnu-btn" data-toggle="dropdown" aria-expanded="true">
                                                                                <i class="fa fa-ellipsis-h"></i></button>
                                                                                    <ul class="dropdown-menu" role="menu">
                                                                                        
                                                                                        <li><a href="" data-toggle="modal" data-target="#edittask" class="first2">تعديل المهمة</a></li>
                                                                                        <li><a href="#" data-toggle="modal" data-target="#deletemodal"> حذف المهمة</a></li>
                                            
                                                                                        <li>
                                                                                            @if(auth()->user()->userable_type == 'App\Models\Lawyer')
                                                                                            <a href=""> معاينة المهمة</a></li>
                                                                                            @elseif(auth()->user()->userable_type == 'App\Models\Client')
                                                                                            <a href=""> معاينة المهمة</a></li>
                                                                                            @endif
                                                                                    </ul>
                                                                                </div>
                                                                            </div>

                                                                            <div class=" careerfy-featured-listing-text careerfy-joblisting-classic-wrap ">
                                                                                
                                                                                <h2><a href="client-dashboard-tasks-1-1.html" id="task-title-added"></a></h2>

                                                                                <p class="m-t-10 task-stats ">
                                                                                    <strong><i class="careerfy-icon careerfy-salary "></i> تكلفة المهمة :<small id="task-price-added"></small></strong>
                                                                                </p>
                                                                                <div class="careerfy-featured-listing-options ">
                                                                                    <p id="task-description-added"></p>
                                                                                    <p class="m-t-10 task-stats ">
                                                                                        <strong><i class="careerfy-icon careerfy-calendar-1 "></i><small id="task-date-added"></small></strong>
                                                                                        <strong><i class="careerfy-icon careerfy-location "></i> <small id="task-gov-added"></small> </strong>
                                                                                        <strong><small >0</small><i class="careerfy-icon careerfy-group "></i>  </strong>
                                                                                    </p>
                                                                                    @if(auth()->user()->userable_type == 'App\Models\Lawyer')
                                                                                    <a href="" class="careerfy-option-btn ">شاهد المزيد</a>
                                                                                    @elseif(auth()->user()->userable_type == 'App\Models\Client')
                                                                                    <a href="" class="careerfy-option-btn ">شاهد المزيد</a>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                @foreach($data['tasks'] as $task)
                                                                    <li class="careerfy-column-12 col-xs-12">
                                                                        <div class="careerfy-table-layer tasks-listing ">
                                                                            <div class="edit-panel">
                                                                                <div class="btn-group ">
                                                                                    <button type="button" class="dropdown-toggle mnu-btn" data-toggle="dropdown" aria-expanded="true">
                                                                                    <i class="fa fa-ellipsis-h"></i></button>
                                                                                    <ul class="dropdown-menu" role="menu">
                                                                                        
                                                                                        <li><a href="" data-toggle="modal" data-target="#edittask-{{ $task->id }}" class="first2">تعديل المهمة</a></li>
                                                                                        <li><a href="#" data-toggle="modal" data-target="#deletemodal-{{ $task->id }}"> حذف المهمة</a></li>
                                            
                                                                                        <li>
                                                                                            @if(auth()->user()->userable_type == 'App\Models\Lawyer')
                                                                                            <a href="{{ route('lawyer.show.task', [$task->id]) }}"> معاينة المهمة</a></li>
                                                                                            @elseif(auth()->user()->userable_type == 'App\Models\Client')
                                                                                            <a href="{{ route('client.show.task', [$task->id]) }}"> معاينة المهمة</a></li>
                                                                                            @endif
                                                                                    </ul>
                                                                                </div>
                                                                            </div>

                                                                            <div class=" careerfy-featured-listing-text careerfy-joblisting-classic-wrap ">
                                                                                @if(auth()->user()->userable_type == 'App\Models\Lawyer')
                                                                                <h2><a href="{{ route('lawyer.show.task', [$task->id]) }}">{{ $task->title ?? '' }}</a></h2>
                                                                                @elseif(auth()->user()->userable_type == 'App\Models\Client')
                                                                                <h2><a href="{{ route('client.show.task', [$task->id]) }}">{{ $task->title ?? '' }}</a></h2>
                                                                                @endif

                                                                                <p class="m-t-10 task-stats ">
                                                                                    <strong><i class="careerfy-icon careerfy-salary "></i> تكلفة المهمة :<small> {{ $task->price }} جنيه مصري</small></strong>
                                                                                </p>
                                                                                <div class="careerfy-featured-listing-options ">
                                                                                    <p>{{ $task->description ?? '' }} </p>
                                                                                    <p class="m-t-10 task-stats ">
                                                                                        <strong><i class="careerfy-icon careerfy-calendar-1 "></i><small>{{ $task->created_at ?? 'ديسمبر, 05, 2020'}}</small></strong>
                                                                                        <strong><i class="careerfy-icon careerfy-location "></i> <small>{{ $task->governorates }} </small> </strong>
                                                                                        <strong><small>{{ $task->applicants_count }}</small><i class="careerfy-icon careerfy-group "></i>  </strong>
                                                                                    </p>
                                                                                    @if(auth()->user()->userable_type == 'App\Models\Lawyer')
                                                                                    <a href="{{ route('lawyer.show.task', [$task->id]) }}" class="careerfy-option-btn ">شاهد المزيد</a>
                                                                                    @elseif(auth()->user()->userable_type == 'App\Models\Client')
                                                                                    <a href="{{ route('client.show.task', [$task->id]) }}" class="careerfy-option-btn ">شاهد المزيد</a>
                                                                                    @endif
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
                                                                @else
                                                                <ul class="careerfy-row">
                                                                    @foreach($data['inprogress'] as $key => $task)
                                                                    <li class="careerfy-column-12 col-xs-12 ">
                                                                        <div class="careerfy-table-layer tasks-listing ">
                                                                            <div class="edit-panel ">
                                                                                <div class="btn-group ">
                                                                                    <button type="button" class="dropdown-toggle mnu-btn" data-toggle="dropdown" aria-expanded="true">
                                                                                    <i class="fa fa-ellipsis-h"></i></button>
                                                                                    <ul class="dropdown-menu" role="menu">
                                                                                        <li><a href="" data-toggle="modal" data-target="#endmodal-{{ $task->id }}"> إلغاء المهمة</a></li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>

                                                                            <div class="careerfy-featured-listing-text careerfy-joblisting-classic-wrap ">
                                                                                <div class="widget_jobdetail_three_apply_wrap ">
                                                                                    <img src="{{ asset('uploads/' . $task->assignedlawyers[0]->userable->profile_image) }} " alt=" ">
                                                                                    <h6>{{ $task->assignedlawyers[0]->first_name }} {{ $task->assignedlawyers[0]->last_name }}</h6>
                                                                                    <div class="starss ">
                                                                                    @php $rating = $task->assignedlawyers[0]->userable->rate; @endphp  
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
                                                                                @if(auth()->user()->userable_type == 'App\Models\Lawyer')
                                                                                <h2><a href="{{ route('lawyer.show.task', [$task->id]) }}">{{ $task->title ?? '' }}</a></h2>
                                                                                @elseif(auth()->user()->userable_type == 'App\Models\Client')
                                                                                <h2><a href="{{ route('client.show.task', [$task->id]) }}">{{ $task->title ?? '' }}</a></h2>
                                                                                @endif
                                                                                <p class="m-t-10 task-stats ">
                                                                                    <strong><i class="careerfy-icon careerfy-salary "></i> تكلفة المهمة :<small> {{ $task->price }} جنيه مصري</small></strong>
                                                                                </p>
                                                                                <div class="careerfy-featured-listing-options ">
                                                                                    <p>{{ $task->decription }} </p>
                                                                                    <p class="m-t-10 task-stats ">
                                                                                        <strong><i class="careerfy-icon careerfy-calendar-1 "></i><small>{{ $task->starting_date ?? 'ديسمبر, 05, 2020' }}</small></strong>
                                                                                        <strong><i class="careerfy-icon careerfy-location "></i> <small>{{ $task->governorates }} </small> </strong>
                                                                                        <strong><small>{{ $task->applicants_count }}</small><i class="careerfy-icon careerfy-group "></i>  </strong>
                                                                                    </p>

                    

                                                                                    @if($data['chats'][$key]->first() != null)
                                                                                    @if(auth()->user()->userable_type == 'App\Models\Lawyer')
                                                                                    <a href="{{ route('lawyer.chat.room', $data['chats'][$key]->first()->id) }}" class="careerfy-option-btn"><i class="fa fa-comments "></i> ابدأ المحادثة </a>
                                                                                    @elseif(auth()->user()->userable_type == 'App\Models\Client')
                                                                                    <a href="{{ route('client.chat.room', $data['chats'][$key]->first()->id) }}" class="careerfy-option-btn"><i class="fa fa-comments "></i> ابدأ المحادثة </a>
                                                                                    @endif
                                                                                    @endif
                                                                                    
                                                                                    
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    @endforeach
                                                                </ul>
                                                                @endif
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
                                                                                <img src="{{ asset('uploads/' . $task->assignedlawyers[0]->userable->profile_image) }}" alt="">
                                                                                <h6>{{ $task->assignedlawyers[0]->first_name }} {{ $task->assignedlawyers[0]->last_name }}</h6>
                                                                                <div class="starss">
                                                                                @php $rating = $task->assignedlawyers[0]->userable->rate; @endphp  
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
                                                                            @if(auth()->user()->userable_type == 'App\Models\Lawyer')
                                                                            <h2><a href="{{ route('lawyer.show.task', [$task->id]) }}">{{ $task->title ?? '' }}</a></h2>
                                                                            @elseif(auth()->user()->userable_type == 'App\Models\Client')
                                                                            <h2><a href="{{ route('client.show.task', [$task->id]) }}">{{ $task->title ?? '' }}</a></h2>
                                                                            @endif
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
                                                                                <!-- <a href="#" data-toggle="modal" data-target="#finishtask-{{ $task->id }}" class="careerfy-option-btn"> انهاء المهمة </a> -->
                                                                                <a href="" data-toggle="modal" data-target="#finishtask-{{ $task->id }}" class="careerfy-option-btn">انهاء المهمة</a>

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
                                                                                <img src="{{ asset('uploads/' . $task->assignedlawyers[0]->userable->profile_image) }}" alt="">
                                                                                <h6>{{ $task->assignedlawyers[0]->first_name }} {{ $task->assignedlawyers[0]->last_name }}</h6>
                                                                                <div class="starss">
                                                                                @php $rating = $task->assignedlawyers[0]->userable->rate; @endphp  
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
                                                                            @if(auth()->user()->userable_type == 'App\Models\Lawyer')
                                                                            <h2><a href="{{ route('lawyer.show.task', [$task->id]) }}">{{ $task->title ?? '' }}</a></h2>
                                                                            @elseif(auth()->user()->userable_type == 'App\Models\Client')
                                                                            <h2><a href="{{ route('client.show.task', [$task->id]) }}">{{ $task->title ?? '' }}</a></h2>
                                                                            @endif

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
   


<div class="modal fade" id="addtask" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                @if(auth()->user()->userable_type == 'App\Models\Lawyer')
                <h5 class="modal-title" id="exampleModalLabel">نشر مهمة عمل   </h5>
                @elseif(auth()->user()->userable_type == 'App\Models\Client')
                <h5 class="modal-title" id="exampleModalLabel">نشر طلب مساعدة قانونية   </h5>
                @endif
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            @if(auth()->user()->userable_type == 'App\Models\Lawyer' && auth()->user()->userable->status == 0)
            <div class="modal-body">
                    <div class="jobsearch-filter-responsive-wrap job-alerts-sec">
                        <div class="jobsearch-search-filter-wrap jobsearch-without-toggle jobsearch-add-padding">
                            <div class="job-alert-box job-alert job-alert-container-top">
                                <div class="alerts-fields">
                                    <p>نأسف لذلك، ولكن لم يتم تفعيل حسابك بعد<br>سوف تصلك رسالة إلى البريد الإلكتروني الخاص بك قريبا عند تفعيل حسابك.<p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button " class="btn btn-secondary " data-dismiss="modal">إلغاء</button>
                </div>
            @else
                @if(auth()->user()->userable_type == 'App\Models\Lawyer')
                {!! Form::open(['route' => 'lawyer.tasks.store', 'method' => 'POST']) !!}
                @elseif(auth()->user()->userable_type == 'App\Models\Client')
                {!! Form::open(['route' => 'client.tasks.store', 'method' => 'POST']) !!}
                @endif
                <div class="modal-body">
                    <div class="jobsearch-filter-responsive-wrap job-alerts-sec">
                        <div class="jobsearch-search-filter-wrap jobsearch-without-toggle jobsearch-add-padding">
                            <div class="job-alert-box job-alert job-alert-container-top">
                                <div class="alerts-fields">
                                    <div class="form-group">
                                        <div id="successMsg" class="" role="alert"></div>
                                    </div>
                                    <div class="form-group">
                                    {!! Form::select('title',$data['titles'],'null',['class'=>'form-control', 'id' => 'title-input','placeholder'=>'موضوع المهمة']) !!}
                                    @error('title')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                    <div id="errorMsgTitle" class=""></div>
                                    </div>
                                    <div class="form-group">
                                    {!! Form::select('governorates', $data['governorates'], null,['class'=>'form-control', 'id' => 'gov-input','placeholder'=>'نطاق التنفيذ']) !!}
                                    @error('governorates')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                    <div id="errorMsgGov" class=""></div>
                                    </div>
                                    <div class="form-group">
                                    {!! Form::select('court', $data['courts'],'null',['class'=>'form-control', 'id' => 'court-input','placeholder'=>'المحكمة الكلية المختصة']) !!}
                                    @error('court')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                    <div id="errorMsgCourt" class=""></div>
                                    </div>
                                    <div class="form-group">
                                    {!! Form::label('starting_date', 'حدد أقصى تاريخ للتنفيذ :', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}

                                    {!! Form::text('starting_date', null, ['class' => 'form-control datepi', 'id' => 'date-input', 'placeholder' =>'اليوم - الشهر - السنة']) !!}
                                    @error('starting_date')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                    <div id="errorMsgDate" class=""></div>
                                    </div>
                                    <div class="form-group">
                                    {!! Form::label('price', 'حدد مبلغ مكافئة التنفيذ :', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}

                                    {!! Form::text('price', null, ['class' => 'form-control', 'id' => 'price-input']) !!}
                                    @error('price')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                    <div id="errorMsgPrice" class=""></div>
                                    </div>
                                    <div class="form-group">
                                    {!! Form::textarea('description', null, [
                                        'class' => 'form-control form-control-lg form-control-solid',
                                        'rows'       => 4, 
                                        'name'       => 'description',
                                        'id'         => 'desc-input',
                                        'placeholder'=> 'اشرح تفاصيل المهمة هنا'
                                    ]) !!}
                                    @error('description')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                    <div id="errorMsgDesc" class=""></div>
                                    
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
                </div>
                <div class="modal-footer">
                    {!! Form::button('إلغاء', ['class' => 'btn btn-secondary' , 'data-dismiss' => "modal"]) !!}
                    {!! Form::submit('نشر المهمة', ['class' => 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            @endif
        </div>
    </div>
</div>

   
@foreach($data['tasks'] as $task)
<div class="modal fade" id="edittask-{{ $task->id }}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تعديل مهمة عمل   </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            @if(auth()->user()->userable_type == 'App\Models\Lawyer')
            {!! Form::model($task,['route' => 'lawyer.tasks.store', 'method' => 'post']) !!}
            @elseif(auth()->user()->userable_type == 'App\Models\Client')
            {!! Form::model($task,['route' => 'client.tasks.store', 'method' => 'post']) !!}
            @endif
            <div class="modal-body">
                <div class="jobsearch-filter-responsive-wrap job-alerts-sec">
                    <div class="jobsearch-search-filter-wrap jobsearch-without-toggle jobsearch-add-padding">
                        <div class="job-alert-box job-alert job-alert-container-top">
                            <div class="alerts-fields">
                                <div class="form-group">
                                    <div id="successMsg" class="" role="alert"></div>
                                </div>
                                <div class="form-group">
                                {!! Form::select('title',[' خلاف وراثة' => ' خلاف وراثة'
                                ,'خلاف محكمة أسرة' => 'خلاف محكمة أسرة',
                                'خلاف حضانة أطفال' => 'خلاف حضانة أطفال',
                                'فسخ تعاقدات' => 'فسخ تعاقدات',
                                'خلاف إيجار قديم\جديد' => 'خلاف إيجار قديم\جديد',
                                ], $task->title,['class'=>'form-control', 'id' => 'title-input','placeholder'=>'موضوع المهمة']) !!}
                                @error('title')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <div id="errorMsgTitle" class=""></div>
                                </div>
                                <div class="form-group">
                                {!! Form::select('governorates',$govs, $task->governorates,['class'=>'form-control', 'id' => 'gov-input','placeholder'=>'نطاق التنفيذ']) !!}
                                @error('governorates')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <div id="errorMsgGov" class=""></div>
                                </div>
                                <div class="form-group">
                                {!! Form::select('court',[' محكمة شمال القاهرة الإبتدائية' => ' محكمة شمال القاهرة الإبتدائية'
                                ,'محكمة جتوب القاهرة الإبتدائية' => 'محكمة جنوب القاهرة الإبتدائية',
                                'محكمة القاهرة الجديدة الإبتدائية' => 'محكمة القاهرة الجديدة الإبتدائية',
                                'محكمة حلوان الإبتدائية' => 'محكمة حلوان الإبتدائية',
                                'محكمة شمال الجيزة الإبتدائية' => 'محكمة شمال الجيزة الإبتدائية',
                                'محكمة شمال بنها الإبتدائية' => 'محكمة شمال بنها الإبتدائية ',
                                'محكمة جتوب بنها الإبتدائية' => 'محكمة جنوب بنها الإبتدائية',
                                'محكمة غرب الإسكندرية الإبتدائية' => 'محكمة شرق الإسكندرية الإبتدائية',
                                ], $task->court,['class'=>'form-control', 'id' => 'court-input','placeholder'=>'المحكمة الكلية المختصة']) !!}
                                @error('court')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <div id="errorMsgCourt" class=""></div>
                                </div>
                                <div class="form-group">
                                {!! Form::label('starting_date', 'حدد أقصى تاريخ للتنفيذ :', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}

                                {!! Form::text('starting_date', null, ['class' => 'form-control datepi', 'id' => 'date-input-edit', 'placeholder' =>'اليوم - الشهر - السنة']) !!}
                                @error('starting_date')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <div id="errorMsgDate" class=""></div>
                                </div>
                                <div class="form-group">
                                {!! Form::label('price', 'حدد مبلغ مكافئة التنفيذ :', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}

                                {!! Form::text('price', null, ['class' => 'form-control', 'id' => 'price-input']) !!}
                                @error('price')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <div id="errorMsgPrice" class=""></div>
                                </div>
                                <div class="form-group">
                                {!! Form::textarea('description', null, [
                                    'class' => 'form-control form-control-lg form-control-solid',
                                    'rows'       => 4, 
                                    'name'       => 'description',
                                    'id'         => 'desc-input',
                                    'placeholder'=> 'اشرح تفاصيل المهمة هنا'
                                ]) !!}
                                @error('description')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <div id="errorMsgDesc" class=""></div>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {!! Form::button('إلغاء', ['class' => 'btn btn-secondary ', 'data-dismiss' => "modal"]) !!}

                {!! Form::submit(' حفظ', ['class' => 'btn btn-primary' , 'id' => 'edit-btn']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div> 
<div class="modal fade" id="deletemodal-{{ $task->id }}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">حذف المهمة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <h6>هل أنت متأكد من حذف المهمة ؟</h6>
            </div>
            <div class="modal-footer">
                @if(auth()->user()->userable_type == 'App\Models\Lawyer')
                {!! Form::open(['route' => ['lawyer.tasks.delete', $task->id], 'method' => 'delete']) !!}
                @elseif(auth()->user()->userable_type == 'App\Models\Client')
                {!! Form::open(['route' => ['client.tasks.delete', $task->id], 'method' => 'delete']) !!}
                @endif
                {!! Form::button('إلغاء', ['class' => 'btn btn-secondary ', 'data-dismiss' => "modal"]) !!}
                {!! Form::button('احذف المهمة', ['type' => 'submit', 'class' => 'btn btn-primary ', 'id' => 'open-success']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endforeach
@foreach($data['inprogress'] as $task)
<div class="modal fade" id="endmodal-{{ $task->id }}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">إلغاء المهمة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <h6>هل أنت متأكد من إلغاء هذه المهمة ؟</h6>
                <p>سوف يتم خصم {{$refund}}% من المبلغ المدفوع</p>
            </div>
            <div class="modal-footer">
                @if(auth()->user()->userable_type == 'App\Models\Lawyer')
                {!! Form::open(['route' => ['lawyer.refund'], 'method' => 'post']) !!}
                @elseif(auth()->user()->userable_type == 'App\Models\Client')
                {!! Form::open(['route' => ['client.refund'], 'method' => 'post']) !!}
                @endif
                {!! Form::hidden('mission_type', 'task') !!}
                {!! Form::hidden('mission_id', $task->id) !!}
                {!! Form::button('إلغاء', ['class' => 'btn btn-secondary ', 'data-dismiss' => "modal"]) !!}
                {!! Form::button('إلغاء المهمة', ['type' => 'submit', 'class' => 'btn btn-primary ', 'id' => 'open-success']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endforeach
@foreach($data['inreview'] as $task)
<div class="modal fade" id="finishtask-{{ $task->id }}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
    <div class="modal-dialog " role="document ">
        <div class="modal-content ">
            <div class="modal-header ">
                <h5 class="modal-title " id="exampleModalLabel ">انهاء المهمة</h5>
                <button type="button " class="close " data-dismiss="modal " aria-label="Close ">
                <span aria-hidden="true ">&times;</span>
                </button>
            </div>
            @if(auth()->user()->userable_type == 'App\Models\Lawyer')
            {!! Form::open(['route' => ['lawyer.complete.task', $task->id], 'method' => 'post']) !!}
            @elseif(auth()->user()->userable_type == 'App\Models\Client')
            {!! Form::open(['route' => ['client.complete.task', $task->id], 'method' => 'post']) !!}
            @endif
            <div class="modal-body text-center">  
                <h6>قم بانهاء المهمة وتقييم عمل المحامي</h6>
                <div class="rate" style="display: flex;align-items: center;justify-content: center; direction:ltr;">
                    <input type="radio" id="star5" name="rate" value="5" />
                    <label for="star5" title="text">5 stars</label>
                    <input type="radio" id="star4" name="rate" value="4" />
                    <label for="star4" title="text">4 stars</label>
                    <input type="radio" id="star3" name="rate" value="3" />
                    <label for="star3" title="text">3 stars</label>
                    <input type="radio" id="star2" name="rate" value="2" />
                    <label for="star2" title="text">2 stars</label>
                    <input type="radio" id="star1" name="rate" value="1" />
                    <label for="star1" title="text">1 star</label>
                </div>
            </div>
            <div class="modal-footer ">
                {!! Form::button('إلغاء', ['class' => 'btn btn-secondary ', 'data-dismiss' => "modal"]) !!}
                {!! Form::button('إنهاء المهمة', ['type' => 'submit', 'class' => 'btn btn-primary ']) !!}
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
<script>
    jQuery(document).ready(function() {
            jQuery(".jobsearch-usernotifics-menubtn a ").mouseenter(function() {
                jQuery(".jobsearch-hdernotifics-listitms ").css("opacity ", "1 ");
                jQuery(".jobsearch-hdernotifics-listitms ").css("visibility ", "visible ");

            })
            jQuery(".jobsearch-usernotifics-menubtn a ").mouseleave(function() {
                jQuery(".jobsearch-hdernotifics-listitms ").css("opacity ", "0 ");
                jQuery(".jobsearch-hdernotifics-listitms ").css("visibility ", "hidden ");

            })

            jQuery(".jobsearch-hdernotifics-listitms ").mouseenter(function() {
                jQuery(".jobsearch-hdernotifics-listitms ").css("opacity ", "1 ");
                jQuery(".jobsearch-hdernotifics-listitms ").css("visibility ", "visible ");

            })

            jQuery(".jobsearch-hdernotifics-listitms ").mouseleave(function() {
                jQuery(".jobsearch-hdernotifics-listitms ").css("opacity ", "0 ");
                jQuery(".jobsearch-hdernotifics-listitms ").css("visibility ", "hidden ");

            })

    });



    jQuery(document).ready(function() {
        jQuery(".jobsearch-userdash-menumain a.jobsearch-color ").mouseenter(function() {
            jQuery(".jobsearch-userdash-menumain .sub-menu ").css("opacity ", "1 ");
            jQuery(".jobsearch-userdash-menumain .sub-menu ").css("visibility ", "visible ");

        })
        jQuery(".jobsearch-userdash-menumain a.jobsearch-color ").mouseleave(function() {
            jQuery(".jobsearch-userdash-menumain .sub-menu ").css("opacity ", "0 ");
            jQuery(".jobsearch-userdash-menumain .sub-menu ").css("visibility ", "hidden ");

        })

        jQuery(".jobsearch-userdash-menumain .sub-menu ").mouseenter(function() {
            jQuery(".jobsearch-userdash-menumain .sub-menu ").css("opacity ", "1 ");
            jQuery(".jobsearch-userdash-menumain .sub-menu ").css("visibility ", "visible ");

        })

        jQuery(".jobsearch-userdash-menumain .sub-menu ").mouseleave(function() {
            jQuery(".jobsearch-userdash-menumain .sub-menu ").css("opacity ", "0 ");
            jQuery(".jobsearch-userdash-menumain .sub-menu ").css("visibility ", "hidden ");

        })

    });
</script>


@endsection
