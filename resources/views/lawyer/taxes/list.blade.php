@extends('layouts.app')

@section('content')
<!-- SubHeader -->
<div class="careerfy-subheader careerfy-subheader-with-bg">
    <span class="careerfy-banner-transparent"></span>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="careerfy-page-title">
                    <h1>إقراراتي الضريبية</h1>
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
                                            <h2> إقراراتي الضريبية</h2>
                                            <a href="#" data-toggle="modal" data-target="#addtax" class="careerfy-static-btn careerfy-bgcolor m-t-20 m-b-20">طلب إقرار ضريبي</a>

                                        </div>

                                        <div class="careerfy-main-section articles-section gray-bg ">

                                            <div class="row">

                                                <!-- Blog -->
                                                <div class="careerfy-blog careerfy-blog-grid">
                                                    <div id="exTab1">
                                                        <ul class="nav nav-pills">
                                                            <li class="active">
                                                                <a href="#1b" data-toggle="tab" aria-expanded="false">إقرارات تحت التنفيذ </a>
                                                            </li>
                                                            <li><a href="#2b" data-toggle="tab" aria-expanded="true">إقرارات مكتملة </a>
                                                            </li>

                                                        </ul>

                                                        <div class="tab-content clearfix">
                    
                                                            <div class="tab-pane active" id="1b">
                                                            @if($data['inprogress_taxes']->first() == null)
                                                                <p style="margin-right: 269px; margin-top: 35px; font-size: 20px">لا يوجد إقرارت ضريبية بعد</p>
                                                            @endif
                                                                @foreach($data['inprogress_taxes'] as $tax)
                                                                <div class="col-md-6 col-xs-12">

                                                                    <div class="careerfy-table-layer tasks-listing">
                                                                        <div class="careerfy-featured-listing-text careerfy-joblisting-classic-wrap">


                                                                            <h2><a>إقرار ضريبي</a></h2>

                                                                            <p class="m-t-10 task-stats">
                                                                                <strong><a href="{{ asset('uploads/' . $tax->tax_file) }}" target="_blank"><i class="careerfy-icon careerfy-resume-document"></i></a> إقرار شهر: <small>ديسمبر, 2020</small></strong>
                                                                            </p>
                                                                            <p class="careerfy-option-btn"> جاري العمل على الإقرار</p>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endforeach
                                                                {{-- @include('partials._pagination', ['records' => $data['inprogress_taxes']]) --}}
                                                            </div>
                                                            <div class="tab-pane" id="2b">
                                                            @if($data['completed_taxes']->first() == null)
                                                                <p style="margin-right: 269px; margin-top: 35px; font-size: 20px">لا يوجد إقرارت ضريبية بعد</p>
                                                            @endif
                                                                @foreach($data['completed_taxes'] as $tax)
                                                                <div class="col-md-6 col-xs-12">

                                                                    <div class="careerfy-table-layer tasks-listing">
                                                                        <div class="careerfy-featured-listing-text careerfy-joblisting-classic-wrap">


                                                                            <h2><a>إقرار ضريبي</a></h2>

                                                                            <p class="m-t-10 task-stats">
                                                                                <strong><a href="{{ asset('uploads/' . $tax->tax_file) }}" target="_blank"><i class="careerfy-icon careerfy-resume-document"></i></a> إقرار شهر: <small>ديسمبر, 2020</small></strong>

                                                                            </p>
                                                                            <a href="{{ asset('uploads/' . $tax->tax_file) }}" class="careerfy-read-more careerfy-bgcolor" download> تحميل الإقرار</a>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endforeach
                                                                {{-- @include('partials._pagination', ['records' => $data['completed_taxes']]) --}}
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


<div class="modal fade" id="addtax" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">طلب خدمة الإقرار الضريبي</h5>
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
            {!! Form::open(['route' => ['pay'], 'method' => 'POST', 'files' => true]) !!}
            <div class="modal-body">
                    <div class="jobsearch-filter-responsive-wrap job-alerts-sec">
                        <div class="jobsearch-search-filter-wrap jobsearch-without-toggle jobsearch-add-padding">
                            <div class="job-alert-box job-alert job-alert-container-top">
                                <div class="alerts-fields">
                                    <div class="form-group">
                                        {!! Form::label('tax_file', 'إرفق صورة البطاقة الضريبية :', [ 'class' => 'form-label']) !!}
                                        {!! Form::file('tax_file', array_merge(['class' => 'form-control', 'accept' => ".png, .jpg, .jpeg, .csv, .txt, .xlx, .xls, .pdf"])) !!}
                                    </div>
                                    @error('tax_file')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group">
                                        {!! Form::label('name', 'اسم المستخدم الضريبي :', [ 'class' => 'form-label']) !!}

                                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => "اسم المستخدم الضريبي"]) !!}
                                    </div>
                                    @error('name')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group">
                                        {!! Form::label('tax_password', 'كلمة مرور التسجيل الضريبي :', [ 'class' => 'form-label']) !!}

                                        {!! Form::text('tax_password', null, ['class' => 'form-control', 'placeholder' => "كلمة مرور التسجيل الضريبي"]) !!}
                                    </div>
                                    @error('tax_password')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group">
                                        {!! Form::label('description', 'ملاحظات اضافية :', [ 'class' => 'form-label']) !!}

                                        {!! Form::textarea('description', null, [
                                            'class' => 'form-control form-control-lg form-control-solid',
                                            'rows'       => 4, 
                                            'name'       => 'description',
                                            'id'         => 'desc-input',
                                            'placeholder'=> 'ملاحظات اضافية'
                                        ]) !!}
                                    </div>
                                    @error('description')
                                    <div class="error">{{ $message }}</div>
                                    @enderror

                                    <div class="form-group" style="display: block;">
                                        {!! Form::label('method', 'طريقة الدفع :', [ 'class' => 'form-label']) !!}
                                            <div class="pay_option">
                                                {{ Form::radio('payment_method', 'card', false, ['id'=>'method-0']) }}
                                                {{ Form::label('method-0', 'الدفع بواسطة الفيزا') }}
                                            </div>
                                           
                                            <div class="pay_option">
                                                {{ Form::radio('payment_method', 'balance', false, ['id'=>'method-1']) }}   
                                                {{ Form::label('method-1', 'خصم مباشر من رصيدي') }}
                                            </div>
                                    </div>
                                    @error('payment_method')
                                    <div class="error">{{ $message }}</div>
                                    @enderror

                                    @if(auth()->user()->accept_terms < 2)
                                    <div class="form-group">
                                        <p>يجب الموافقة على <span><a href="{{ route('terms') }}" target="_blank">الشروط والأحكام</a></span> حتى يتم قبول طلبك</p>
                                    {!! Form::checkbox('accept_terms', true, null, ['id' => 'accept_terms']) !!} 
                                    {!! Form::label('accept_terms', ' أوافق على الشروط و الأحكام ') !!}    
                                    </div>
                                    @endif
                                    {!! Form::hidden('mission_type', 'tax') !!}
                                    {!! Form::hidden('amount_cents', $tax_cost ) !!}
                                    <div class="form-group">
                                        <p>تكلفة خدمة الإقرار الضريبي {{ $tax_cost }} جنيه. قم بإرفاق الملف الضريبي وسيعمل فريق عملنا على إنجازه وتقديمه في مدة لاتتعدى ثلاثة أيام.
                                        </p>
                                        <p>تذكر أنه عند الدفع بالفيزا سيتم إضافة رسوم خدمة {{ $cash_in }}% إلى المبلغ المستحق <br>
                                            تكلفة الخدمة بعد إضافة الرسوم : <strong> {{ $tax_cost + (($cash_in/100 )*$tax_cost) }} جنيه</strong>
                                        </p>   
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                {!! Form::button('إلغاء', ['class' => 'btn btn-secondary', 'data-dismiss' => "modal"]) !!}
                {!! Form::submit('اطلب الخدمة', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
            @endif
        </div>
    </div>
</div>
   
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
