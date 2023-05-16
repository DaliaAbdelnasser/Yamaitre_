@extends('layouts.app')

@section('content')
<!-- SubHeader -->
<div class="careerfy-subheader careerfy-subheader-with-bg">
    <span class="careerfy-banner-transparent"></span>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="careerfy-page-title">
                    <h1>حسابي</h1>
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
                    <div id="dashboard-tab-stats" class="main-tab-section">
                        <div class="careerfy-employer-dasboard">
                            <div id="careerfy-notification-section" class="careerfy-employer-box-section careerfy-dashnotifics-bars">
                                <div class="careerfy-profile-title">
                                    <h2>طلباتي من الغير</h2>
                                    @if($user->balance->balance > 0)
                                    <h2 style="float:left;"> رصيدي : {{ $user->balance->balance }} جنيه</h2>
                                    @endif
                                </div>

                                <div class="careerfy-main-section articles-section gray-bg ">

                                    <div class="row">

                                        <!-- Blog -->
                                        <div class="careerfy-blog careerfy-blog-grid">

                                            <div class="col-md-3">
                                                <a >
                                                    <div class="service-box sm">

                                                        <h4><i class="careerfy-icon careerfy-paper"></i></h4>
                                                        <h4>طلباتي من الغير</h4>
                                                        <p>{{ count($user->tasks) }}</p>
                                                    </div>
                                                </a>
                                            </div>

                                            <div class="col-md-3">
                                                <a>
                                                    <div class="service-box sm golden-bg">

                                                        <h4><i class="careerfy-icon careerfy-resume-1"></i></h4>
                                                        <h4>قيد التنفيذ</h4>
                                                        <p>{{ $data['inprogress_count'] }}</p>

                                                    </div>
                                                </a>
                                            </div>

                                            <div class="col-md-3">
                                                <a>
                                                    <div class="service-box sm">

                                                        <h4><i class="careerfy-icon careerfy-edit"></i></h4>
                                                        <h4>قيد المراجعة</h4>
                                                        <p>{{ $data['inreview_count'] }}</p>

                                                    </div>
                                                </a>
                                            </div>
                                        
                                            <div class="col-md-3">
                                                <a>
                                                    <div class="service-box sm golden-bg">

                                                        <h4><i class="careerfy-icon careerfy-download-arrow"></i></h4>
                                                        <h4>مكتملة</h4>
                                                        <p>{{ $data['completed_count'] }}</p>

                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div id="careerfy-notification-section" class="careerfy-employer-box-section careerfy-dashnotifics-bars">
                                <div class="careerfy-profile-title">
                                    <h2> مهام لحساب الغير </h2>
                                </div>

                                <div class="careerfy-main-section articles-section gray-bg ">

                                    <div class="row">

                                        <!-- Blog -->
                                        <div class="careerfy-blog careerfy-blog-grid">

                                            <div class="col-md-3">
                                                <a >
                                                    <div class="service-box sm">
                                                        <h4><i class="careerfy-icon careerfy-paper"></i></h4>
                                                        <h4>مهام لحساب الغير</h4>
                                                        <p>{{ count($user->assignedtasks) }}</p>
                                                    </div>
                                                </a>
                                            </div>

                                            <div class="col-md-3">
                                                <a>
                                                    <div class="service-box sm golden-bg">
                                                        <h4><i class="careerfy-icon careerfy-resume-1"></i></h4>
                                                        <h4>قيد التنفيذ</h4>
                                                        <p>{{ $data['inprogress_others'] }}</p>

                                                    </div>
                                                </a>
                                            </div>

                                            <div class="col-md-3">
                                                <a>
                                                    <div class="service-box sm">
                                                        <h4><i class="careerfy-icon careerfy-edit"></i></h4>
                                                        <h4>قيد المراجعة</h4>
                                                        <p>{{ $data['inreview_others'] }}</p>

                                                    </div>
                                                </a>
                                            </div>
                                        
                                            <div class="col-md-3">
                                                <a>
                                                    <div class="service-box sm golden-bg">
                                                        <h4><i class="careerfy-icon careerfy-download-arrow"></i></h4>
                                                        <h4>مكتملة</h4>
                                                        <p>{{ $data['completed_others'] }}</p>

                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            @if($data['tasks']->first() != null)
                            <div id="careerfy-notification-section" class="careerfy-employer-box-section careerfy-dashnotifics-bars">
                                <div class="careerfy-profile-title">
                                    <h2>  مهامي المعروضة على المحامين </h2>

                                </div>

                                <div class="careerfy-managejobs-list cs-dashboard cs-tasks-dashboard">
                                    
                                    <ul class="row">
                                        @foreach($data['tasks'] as $task)
                                        <li class="">
                                            <div class="careerfy-table-layer tasks-listing ">
                                                {{-- <div class="edit-panel">
                                                    <div class="btn-group ">
                                                        <button type="button" class="dropdown-toggle mnu-btn" data-toggle="dropdown-{{ $task->id }}" aria-expanded="true">
                                                    <i class="fa fa-ellipsis-h"></i></button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            
                                                            <li><a href="#" data-toggle="modal" data-target="#edittask-{{ $task->id }}" class="first2 edit-btn">تعديل المهمة</a></li>
                                                            <li><a href="#" data-toggle="modal" data-target="#deletemodal-{{ $task->id }}"> حذف المهمة</a></li>
                
                                                            <li>
                                                                @if(auth()->user()->userable_type == 'App\Models\Lawyer')
                                                                <a href="{{ route('lawyer.show.task', [$task->id]) }}"> معاينة المهمة</a>
                                                                @elseif(auth()->user()->userable_type == 'App\Models\Client')
                                                                <a href="{{ route('client.show.task', [$task->id]) }}"> معاينة المهمة</a>
                                                                @endif
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div> --}}

                                                <div class=" careerfy-featured-listing-text careerfy-joblisting-classic-wrap ">
                                                    <h2 id="{{ $task->id }}"></h2>
                                                    <h2><a href="client-dashboard-tasks-1-1.html" id="task-title-edited">{{ $task->title ?? '' }}</a></h2>

                                                    <p class="m-t-10 task-stats ">
                                                        <strong><i class="careerfy-icon careerfy-salary "></i> تكلفة المهمة :<small id="task-price-edited"> {{ $task->price }} جنيه مصري</small></strong>
                                                    </p>
                                                    <div class="careerfy-featured-listing-options ">
                                                        <p id="task-description-edited">{{ $task->description ?? '' }} </p>
                                                        <p class="m-t-10 task-stats ">
                                                            <strong><i class="careerfy-icon careerfy-calendar-1 "></i><small>{{ $task->created_at ?? 'ديسمبر, 05, 2020'}}</small></strong>
                                                            <strong><i class="careerfy-icon careerfy-location "></i> <small id="task-gov-edited">{{ $task->governorates }} </small> </strong>
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

                                        {{-- <div class="modal fade" id="edittask-{{ $task->id }}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">تعديل مهمة عمل   </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    @if(auth()->user()->userable_type == 'App\Models\Lawyer')
                                                    {!! Form::model($task,['route' => ['lawyer.tasks.edit', $task->id], 'method' => 'patch']) !!}
                                                    @elseif(auth()->user()->userable_type == 'App\Models\Client')
                                                    {!! Form::model($task,['route' => ['client.tasks.edit', $task->id], 'method' => 'patch']) !!}
                                                    @endif
                                                    <div class="modal-body">
                                                        <div class="jobsearch-filter-responsive-wrap job-alerts-sec">
                                                            <div class="jobsearch-search-filter-wrap jobsearch-without-toggle jobsearch-add-padding">
                                                                <div class="job-alert-box job-alert job-alert-container-top">
                                                                    <div class="alerts-fields">
                                                                        <div class="form-group">
                                                                            <div id="successMsg-edit-task" class="" role="alert"></div>
                                                                        </div>
                                                                        <!-- <div hidden="hidden" id="task-id" value="$task->id"></div> -->
                                                                        {!! Form::hidden('id-'.$task->id, $task->id, ['class' => 'form-control', 'id' => 'task-'.$task->id]) !!}
                                                                        <div class="form-group">
                                                                        {!! Form::select('title',[' خلاف وراثة' => ' خلاف وراثة'
                                                                        ,'خلاف محكمة أسرة' => 'خلاف محكمة أسرة',
                                                                        'خلاف حضانة أطفال' => 'خلاف حضانة أطفال',
                                                                        'فسخ تعاقدات' => 'فسخ تعاقدات',
                                                                        'خلاف إيجار قديم\جديد' => 'خلاف إيجار قديم\جديد',
                                                                        ], $task->title,['class'=>'form-control', 'id' => 'title-input-edit','placeholder'=>'موضوع المهمة']) !!}
                                                                        @error('title')
                                                                        <div class="error">{{ $message }}</div>
                                                                        @enderror
                                                                        <div id="errorMsgTitle" class=""></div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                        {!! Form::select('governorates',[' القاهرة' => ' القاهرة'
                                                                        ,'الأسكندرية' => 'الأسكندرية',
                                                                        'الجيزة' => 'الجيزة',
                                                                        'أسوان' => 'أسوان',
                                                                        'الفيوم' => 'الفيوم',
                                                                        'بني سويف' => 'بني سويف',
                                                                        'بورسعيد' => 'بورسعيد',
                                                                        'المنيا' => 'المنيا',
                                                                        'أسيوط' => 'أسيوط',
                                                                        'الغردقة' => 'الغردقة',
                                                                        'شرم الشيخ' => 'شرم الشيخ ',
                                                                        'المنوفية' => 'المنوفية',
                                                                        'الاسماعيلية' => 'الاسماعيلية',
                                                                        'الدقهلية' => 'الدقهلية',
                                                                        'الشرقية' => 'الشرقية',
                                                                        ], $task->governorates,['class'=>'form-control', 'id' => 'gov-input-edit','placeholder'=>'نطاق التنفيذ']) !!}
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
                                                                        ], $task->court,['class'=>'form-control', 'id' => 'court-input-edit','placeholder'=>'المحكمة الكلية المختصة']) !!}
                                                                        @error('court')
                                                                        <div class="error">{{ $message }}</div>
                                                                        @enderror
                                                                        <div id="errorMsgCourt" class=""></div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                        {!! Form::label('starting_date', 'حدد أقصى تاريخ للتنفيذ :', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
                                        
                                                                        {!! Form::text(date('d-m-Y', strtotime('starting_date')), $task->starting_date, ['class' => 'form-control', 'id' => 'date-input-edit']) !!}
                                                                        @error('starting_date')
                                                                        <div class="error">{{ $message }}</div>
                                                                        @enderror
                                                                        <div id="errorMsgDate" class=""></div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                        {!! Form::label('price', 'حدد مبلغ مكافئة التنفيذ :', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
                                        
                                                                        {!! Form::text('price', null, ['class' => 'form-control', 'id' => 'price-input-edit']) !!}
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
                                                                            'id'         => 'desc-input-edit',
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
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                                        {!! Form::submit(' حفظ', ['class' => 'btn btn-primary']) !!}
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
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                                        @if(auth()->user()->userable_type == 'App\Models\Lawyer')
                                                        {!! Form::open(['route' => ['lawyer.tasks.delete', $task->id], 'method' => 'delete']) !!}
                                                        @elseif(auth()->user()->userable_type == 'App\Models\Client')
                                                        {!! Form::open(['route' => ['client.tasks.delete', $task->id], 'method' => 'delete']) !!}
                                                        @endif
                                                        {!! Form::button('احذف المهمة', ['type' => 'submit', 'class' => 'btn btn-primary ', 'id' => 'open-success']) !!}
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                        @endforeach
                                    </ul>

                                </div>
                            </div>
                            @endif

                            @if($data['my_recent_articles']->first() != null)
                            <div id="careerfy-notification-section" class="careerfy-employer-box-section careerfy-dashnotifics-bars">
                                <div class="careerfy-profile-title">
                                    <h2>  منشوراتي  </h2>

                                </div>

                                <div class="careerfy-managejobs-list cs-dashboard">
                                    
                                    <ul class="row">
                                        @foreach ($data['my_recent_articles'] as $article )
                                        <li>
                                            <div class="careerfy-table-layer tasks-listing">
                                                <div class="careerfy-featured-listing-text careerfy-joblisting-classic-wrap">
                                                    {{-- <div class="edit-panel">
                                                        <div class="btn-group">
                                                            <button type="button" class="dropdown-toggle mnu-btn" data-toggle="dropdown-{{ $article->id }}" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-h"></i></button>
                                                            <ul class="dropdown-menu" role="menu" style="">
                                                                <li><a href="{{ route('lawyer.articles.edit', [$article->id]) }} class="first2">تعديل المنشور</a></li>
                                                                <li><a href="#" data-toggle="modal" data-target="#deletemodal-{{ $article->id }}">حذف المنشور</a></li>
    
                                                            </ul>
                                                        </div>
                                                    </div> --}}
    
                                                    <h2><a href="{{ route('single.article', [$article->id]) }}"> {{$article->title ?? ''}} </a></h2>
    
                                                    <p class="m-t-10 task-stats">
                                                        <strong><i class="careerfy-icon careerfy-calendar-1"></i> تاريخ المدونة: <small>{{ date('d-m-Y', strtotime($article->created_at ?? ''))}}</small></strong>
                                                        <strong><i class="careerfy-icon careerfy-location"></i> الحالة: <small> {{ ( $article->status == true ) ? 'تم النشر' : 'قيد المراجعة'}} </small> </strong>
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        {{-- <div class="modal fade" id="deletemodal-{{ $article->id }}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">حذف المنشور</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    {!! Form::model($article, ['route' => ['lawyer.articles.delete', $article->id], 'method' => 'delete']) !!}
                                                    <div class="modal-body">
                                                        <h6>هل أنت متأكد من حذف هذا المنشور؟</h6>
                                                    </div>
                                                    <div class="modal-footer">
                                                        {!! Form::button('إلغاء', ['class' => 'btn btn-secondary', 'data-dismiss' => "modal"]) !!}
                                                        {!! Form::submit('احذف المنشور', ['class' => 'btn btn-primary']) !!}
                                                    </div>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div> --}}
                                        @endforeach
                                    </ul>

                                </div>
                            </div>
                            @endif

                            @if($data['my_recent_taxes']->first() != null)
                            <div id="careerfy-notification-section" class="careerfy-employer-box-section careerfy-dashnotifics-bars">
                                <div class="careerfy-profile-title">
                                    <h2> إقراراتي الضريبية  </h2>

                                </div>

                                <div class="careerfy-managejobs-list cs-dashboard">
                                    
                                    <ul class="row">
                                        @foreach ($data['my_recent_taxes'] as $tax )
                                        <li>
                                            <div class="careerfy-table-layer tasks-listing">
                                                <div class="careerfy-featured-listing-text careerfy-joblisting-classic-wrap">
                                    
    
                                                    <h2> {{$tax->tax_name ?? ''}} </h2>
                                                   

                                                    <p class="m-t-10 task-stats">
                                                        <strong><i class="careerfy-icon careerfy-calendar-1"></i> تاريخ ارسال الاقرار: <small>{{ date('d-m-Y', strtotime($tax->created_at ?? ''))}}</small></strong>
                                                        <strong><i class="careerfy-icon careerfy-location"></i> الحالة: <small> {{ ( $tax->feedback != null ) ? 'تم ارسال الاقرار الضريبي اليك قم بتحميل الملف' : 'جاري العمل على الإقرار'}} </small> </strong>
                                                    </p>
                                                    @if ($tax->feedback != null)
                                                    <a href="{{ asset('uploads/' . $tax->tax_file) }}" class="careerfy-read-more careerfy-bgcolor" download> تحميل الإقرار</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach 
                                    </ul>

                                </div>
                            </div>
                            @endif

                            @if($data['my_recent_sos']->first() != null)
                            <div id="careerfy-notification-section" class="careerfy-employer-box-section careerfy-dashnotifics-bars">
                                <div class="careerfy-profile-title">
                                    <h2>  نداءات الإستغاثة  </h2>

                                </div>

                                <div class="careerfy-managejobs-list cs-dashboard">
                                    
                                    <ul class="row">
                                        @foreach ($data['my_recent_sos'] as $dist )
                                        <li>
                                            <div class="careerfy-table-layer tasks-listing">
                                                <div class="careerfy-featured-listing-text careerfy-joblisting-classic-wrap">
                                                    {{-- <div class="edit-panel">
                                                        <div class="btn-group">
                                                            <button type="button" class="dropdown-toggle mnu-btn" data-toggle="dropdown-{{ $dist->id }}" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-h"></i></button>
                                                            <ul class="dropdown-menu" role="menu" style="">
                                                                <li><a href="#" class="first2" data-toggle="modal" data-target="#editsos-{{ $dist->id }}">تعديل الإستغاثة</a></li>
                                                                <li><a href="#" data-toggle="modal" data-target="#deletemodal-{{ $dist->id }}">حذف الإستغاثة</a></li>

                                                            </ul>
                                                        </div>
                                                    </div> --}}
    
                                                    <h2><a href="#">{{ $dist->type }}</a></h2>
    
                                                    <p class="m-t-10 task-stats">
                                                        <strong><i class="careerfy-icon careerfy-calendar-1"></i> تاريخ الإستغاثة: <small>{{ $dist->created_at ?? 'ديسمبر, 05, 2020' }}</small></strong>
                                                        <strong><i class="careerfy-icon careerfy-location"></i> المحافظة: <small>{{ $dist->governorate }} </small> </strong>
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        {{-- <div class="modal fade" id="deletemodal-{{ $dist->id }}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">حذف نداء الإستغاثة</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    {!! Form::model($dist, ['route' => ['lawyer.sos.delete', $dist->id], 'method' => 'delete']) !!}
                                                    <div class="modal-body">
                                                        <h6>هل أنت متأكد من حذف نداء الاستغاثة؟</h6>
                                                    </div>
                                                    <div class="modal-footer">
                                                        {!! Form::button('إلغاء', ['class' => 'btn btn-secondary', 'data-dismiss' => "modal"]) !!}
                                                        {!! Form::submit('احذف نداء الاستغاثة', ['class' => 'btn btn-primary']) !!}
                                                    </div>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="modal fade" id="editsos-{{ $dist->id }}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">تعديل نداء إستغاثة</h5>
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
                                                    {!! Form::model($dist, ['route' => ['lawyer.sos.edit', $dist->id], 'method' => 'patch']) !!}
                                                    <div class="modal-body">
                                                            <div class="jobsearch-filter-responsive-wrap job-alerts-sec">
                                                                <div class="jobsearch-search-filter-wrap jobsearch-without-toggle jobsearch-add-padding">
                                                                    <div class="job-alert-box job-alert job-alert-container-top">
                                                                        <div class="alerts-fields">


                                                                            <div class="form-group">
                                                                            {!! Form::label('type', 'حدد حالة الطوارئ :', [ 'class' => 'form-label']) !!}

                                                                            {!! Form::select('type', $data['types'], $dist->type,['class'=>'form-control', 'placeholder'=>'حدد نوع حالة الطوارئ']) !!}
                                                                            </div>
                                                                            @error('type')
                                                                            <div class="error">{{ $message }}</div>
                                                                            @enderror

                                                                            <div class="form-group">
                                                                            {!! Form::label('governorate', 'النشر في نطاق :', [ 'class' => 'form-label']) !!}

                                                                            

                                                                            {!! Form::select('governorate', $data['governorates'], $dist->governorate,['class'=>'form-control','placeholder'=>'حدد نطاق النشر']) !!}
                                                                            </div>
                                                                            @error('governorate')
                                                                            <div class="error">{{ $message }}</div>
                                                                            @enderror

                                                                            <div class="form-group">
                                                                            {!! Form::label('description', 'تفاصيل نداء الاستغاثة :', [ 'class' => 'form-label']) !!}

                                                                            {!! Form::textarea('description', $dist->description, [
                                                                                'class' => 'form-control',
                                                                                'rows'       => 4, 
                                                                                'name'       => 'description',
                                                                                'placeholder'=> 'اكتب تفاصيل ماتتعرض له للنشر على زملائك'
                                                                            ]) !!}
                                                                            </div>
                                                                            @error('description')
                                                                            <div class="error">{{ $message }}</div>
                                                                            @enderror

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        {!! Form::button('إلغاء', ['class' => 'btn btn-secondary', 'data-dismiss' => "modal"]) !!}
                                                        {!! Form::submit('حفظ ', ['class' => 'btn btn-primary']) !!}
                                                    </div>
                                                    {!! Form::close() !!}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="descriptionmore-{{ $dist->id }}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">تفاصيل نداء الإستغاثة </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>{{ $dist->description }}</p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div> --}}

                                        @endforeach 
                                    </ul>

                                </div>
                            </div>
                            @endif

                            @if($data['my_recent_ads']->first() != null)
                            <div id="careerfy-notification-section" class="careerfy-employer-box-section careerfy-dashnotifics-bars">
                                <div class="careerfy-profile-title">
                                    <h2>  إعلاناتي  </h2>

                                </div>

                                <div class="careerfy-managejobs-list cs-dashboard">
                                    
                                    <ul class="row">
                                        @foreach ($data['my_recent_ads'] as $ads )
                                        <li>
                                            <div class="careerfy-table-layer tasks-listing">
                                                <div class="careerfy-featured-listing-text careerfy-joblisting-classic-wrap">
                                                    <h2>مكان الاعلان : {{ $data['places'][$ads->place] ?? ''}}</h2>
                                                    <p class="m-t-10 task-stats">
                                                        <strong><i class="careerfy-icon careerfy-calendar-1"></i> تاريخ طلب الاعلان: <small>{{ date('d-m-Y', strtotime($ads->created_at ?? ''))}}</small></strong>
                                                        <strong><i class="careerfy-icon careerfy-calendar-1"></i> تاريخ نشر الاعلان: <small>{{ date('d-m-Y', strtotime($ads->updated_at ?? ''))}}</small></strong>
                                                        <strong><i class="careerfy-icon careerfy-location"></i> الحالة: <small> {{ ( $ads->status == true ) ? 'تم النشر' : 'جاري العمل على اعلانك'}} </small> </strong>
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @endif
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
