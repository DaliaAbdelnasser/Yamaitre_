@extends('layouts.app')

@section('content')
<!-- SubHeader -->
<div class="careerfy-subheader careerfy-subheader-with-bg">
    <span class="careerfy-banner-transparent"></span>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="careerfy-page-title">
                    <h1>إدارة حسابي</h1>
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
                                <div class="text-center" >@include('flash::message')</div>
                                @if ($errors->any())
                                @foreach ($errors->all() as $key => $error)
                                    <div class="alert alert-danger text-center" role="alert">{{ $error }}</div>
                                @endforeach
                                @endif 
                                    <div id="careerfy-notification-section" class="careerfy-employer-box-section careerfy-dashnotifics-bars">
                                        <div class="careerfy-profile-title">
                                            <h2> الإعدادات</h2>
                                        </div>
                                        <div class="careerfy-main-section articles-section gray-bg ">
                                            <div class="row">
                                                <!-- Blog -->
                                                <div class="careerfy-blog careerfy-blog-grid">
                                                    <div class="careerfy-employer-dasboard">

                                                        <div class="careerfy-employer-box-section">
                                                        {!! Form::model(auth()->user() ,['route' => ['update.profile'], 'method' => 'PATCH']) !!}
                                                            <ul class="careerfy-row careerfy-employer-profile-form">
                                                                <li class="careerfy-column-6">
                                                                    {!! Form::label('first_name', 'الأسم الأول ', [ 'class' => 'form-label']) !!}
                                                                    {!! Form::text('first_name',  null, ['class' => 'form-control', 'placeholder' => 'الأسم الأول']) !!}
                                                                    @error('first_name')
                                                                    <div class="error">{{ $message }}</div>
                                                                    @enderror
                                                                </li>
                                                                <li class="careerfy-column-6">
                                                                    {!! Form::label('last_name', 'الأسم الثاني ', [ 'class' => 'form-label']) !!}
                                                                    {!! Form::text('last_name',  null, ['class' => 'form-control', 'placeholder' => 'الأسم الثاني']) !!}
                                                                    @error('last_name')
                                                                    <div class="error">{{ $message }}</div>
                                                                    @enderror
                                                                </li>
                                                                <li class="careerfy-column-6">
                                                                    {!! Form::label('phone', 'الموبايل ', [ 'class' => 'form-label']) !!}
                                                                    {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'الموبايل']) !!}
                                                                    @error('phone')
                                                                    <div class="error">{{ $message }}</div>
                                                                    @enderror

                                                                </li>
                                                                <li class="careerfy-column-6">
                                                                    {!! Form::label('email', 'البريد الإلكتروني ', [ 'class' => 'form-label']) !!}
                                                                    {!! Form::text('email',  null, ['class' => 'form-control', 'placeholder' => 'البريد الإلكتروني']) !!}
                                                                    @error('email')
                                                                    <div class="error">{{ $message }}</div>
                                                                    @enderror
                                                                </li>
                                                                <li class="careerfy-column-6">
                                                                    {!! Form::label('governorates', 'المحافظة / محل العمل ', [ 'class' => 'form-label']) !!}
                                                                    {!! Form::select('governorates', $data['governorates'],  auth()->user()->userable->governorates,['class'=>'form-control', 'placeholder'=>'اختر المحافظة']) !!}
                                                                    @error('governorates')
                                                                    <div class="error">{{ $message }}</div>
                                                                    @enderror
                                                                </li>
                                                                @if(auth()->user()->userable_type == 'App\Models\Lawyer')                                                                
                                                                <li class="careerfy-column-6">
                                                                    {!! Form::label('court_name', 'المحكمة الكلية التابع لها ', [ 'class' => 'form-label']) !!}
                                                                    {!! Form::select('court_name', $data['courts'], auth()->user()->userable->court_name,['class'=>'form-control', 'placeholder'=>'اختر المحكمة']) !!}
                                                                    @error('court_name')
                                                                    <div class="error">{{ $message }}</div>
                                                                    @enderror
                                                                </li>

                                                                <li class="careerfy-column-12">
                                                                    {!! Form::label('description', 'نبذة عنك ', [ 'class' => 'form-label']) !!}
                                                                    {!! Form::textarea('description', auth()->user()->userable->description, [
                                                                        'class' => 'form-control form-control-lg form-control-solid',
                                                                        'rows'       => 4, 
                                                                        'name'       => 'description',
                                                                        'id'         => 'description',
                                                                        'placeholder' => "اكتب عن نفسك هنا"
                                                                    ]) !!}
                                                                    @error('description')
                                                                    <div class="error">{{ $message }}</div>
                                                                    @enderror
                                                                </li>
                                                                @endif
                                                                <li class="careerfy-column-12">
                                                                {!! Form::submit('تحديث البيانات', ['class' => 'careerfy-employer-profile-submit']) !!}
                                                                </li>
                                                            </ul>
                                                            {!! Form::close() !!}

                                                            {!! Form::open(['route' => ['change.password'], 'method' => 'POST']) !!}
                                                            <ul class="careerfy-row careerfy-employer-profile-form">
                                                                <li class="careerfy-column-12">
                                                                    {!! Form::label('old_password', 'كلمة المرور الحالية *', [ 'class' => 'form-label']) !!}
                                                                    {!! Form::password('old_password', array_merge(['class' => 'form-control', 'placeholder' => 'كلمة المرور الحالية']) ) !!}
                                                                    @error('old_password')
                                                                    <div class="error">{{ $message }}</div>
                                                                    @enderror
                                                                </li>
                                                                <li class="careerfy-column-6">
                                                                    {!! Form::label('new_password', 'كلمة المرور الجديدة *', [ 'class' => 'form-label']) !!}
                                                                    {!! Form::password('new_password', array_merge(['class' => 'form-control', 'placeholder' => 'كلمة المرور الجديدة']) ) !!}
                                                                    @error('new_password')
                                                                    <div class="error">{{ $message }}</div>
                                                                    @enderror
                                                                </li>
                                                                <li class="careerfy-column-6">
                                                                    {!! Form::label('new_password_confirmation', 'تأكيد كلمة المرور الجديدة *', [ 'class' => 'form-label']) !!}
                                                                    {!! Form::password('new_password_confirmation', array_merge(['class' => 'form-control', 'placeholder' => 'تأكيد كلمة المرور الجديدة']) ) !!}
                                                                    @error('new_password_confirmation')
                                                                    <div class="error">{{ $message }}</div>
                                                                    @enderror
                                                                </li>
                                                                <li class="careerfy-column-12">
                                                                    {!! Form::submit('تغيير كلمة المرور', ['class' => 'careerfy-employer-profile-submit']) !!}
                                                                </li>
                                                            </ul>
                                                            {!! Form::close() !!}
                                                            <div class="clearfix"></div>
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
