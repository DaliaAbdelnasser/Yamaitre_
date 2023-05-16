@extends('layouts.app')

@section('content')
<!-- SubHeader -->
<div class="careerfy-subheader careerfy-subheader-with-bg">
    <span class="careerfy-banner-transparent"></span>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="careerfy-page-title">
                    <h1>نداءات الإستغاثة</h1>
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
                                            <h2>نداءات الإستغاثة</h2>
                                            <a href="#" data-toggle="modal" data-target="#addsos" class="careerfy-static-btn careerfy-bgcolor m-t-20 m-b-20">اضف نداء إستغاثة</a>

                                        </div>

                                        <div class="careerfy-main-section articles-section gray-bg ">

                                            <div class="row">

                                                <!-- Blog -->
                                                <div class="careerfy-blog careerfy-blog-grid">
                                                    <ul class="row">
                                                        @if($data['distresses']->first() == null)
                                                            <p style="margin-right: 269px; margin-top: 35px; font-size: 20px">لا يوجد نداءات إستغاثة بعد</p>
                                                        @endif
                                                        @foreach($data['distresses'] as $dist)
                                                        <li class="col-md-6">
                                                            <div class="careerfy-table-layer tasks-listing">
                                                                <div class="careerfy-featured-listing-text careerfy-joblisting-classic-wrap">
                                                                    <div class="edit-panel">
                                                                        <div class="btn-group ">
                                                                            <button type="button" class="dropdown-toggle mnu-btn" data-toggle="dropdown" aria-expanded="true">
                                                                        <i class="fa fa-ellipsis-h"></i></button>
                                                                            <ul class="dropdown-menu" role="menu">
                                                                                <li><a href="#" class="first2" data-toggle="modal" data-target="#editsos-{{ $dist->id }}">تعديل الإستغاثة</a></li>
                                                                                <li><a href="#" data-toggle="modal" data-target="#deletemodal-{{ $dist->id }}">حذف الإستغاثة</a></li>

                                                                            </ul>
                                                                        </div>
                                                                    </div>

                                                                    <h2><a href="#">{{ $dist->type }}</a></h2>

                                                                    <p class="m-t-10 task-stats">
                                                                        <strong><i class="careerfy-icon careerfy-calendar-1"></i> تاريخ الإستغاثة: <small>{{ $dist->created_at ?? 'ديسمبر, 05, 2020' }}</small></strong>
                                                                        <strong><i class="careerfy-icon careerfy-location"></i> المحافظة: <small>{{ $dist->governorate }} </small> </strong>


                                                                    </p>
                                                                    <div class="careerfy-featured-listing-options">
                                                                        <p>{{ $dist->description }} </p>

                                                                        <a href="{{ route('single.sos', [$dist->id]) }}" class="careerfy-option-btn">شاهد المزيد</a>
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
                            @include('partials._pagination', ['records' => $data['distresses']])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="addsos" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">إضافة نداء إستغاثة</h5>
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
            {!! Form::open(['route' => ['lawyer.sos.store'], 'method' => 'POST']) !!}
            <div class="modal-body">
                    <div class="jobsearch-filter-responsive-wrap job-alerts-sec">
                        <div class="jobsearch-search-filter-wrap jobsearch-without-toggle jobsearch-add-padding">
                            <div class="job-alert-box job-alert job-alert-container-top">
                                <div class="alerts-fields">


                                    <div class="form-group">
                                    {!! Form::label('type', 'حدد حالة الطوارئ :', [ 'class' => 'form-label']) !!}

                                    {!! Form::select('type', $data['types'],'null',['class'=>'form-control', 'placeholder'=>'حدد نوع حالة الطوارئ']) !!}
                                    </div>
                                    @error('type')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group">
                                    {!! Form::label('governorate', 'حدد نطاق النشر :', [ 'class' => 'form-label']) !!}

                                    {!! Form::select('governorate', $data['governorates'],'null',['class'=>'form-control', 'placeholder'=>'حدد نطاق النشر']) !!}
                                    </div>
                                    @error('governorate')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group">
                                        {!! Form::label('description', 'تفاصيل نداء الاستغاثة :', [ 'class' => 'form-label']) !!}

                                        {!! Form::textarea('description', null, [
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
                {!! Form::submit('نشر الاستغاثة على الزملاء', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
            @endif
        </div>
    </div>
</div>

@foreach($data['distresses'] as $dist)
<div class="modal fade" id="deletemodal-{{ $dist->id }}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
</div>
@endforeach
@endsection

@section('script')
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
