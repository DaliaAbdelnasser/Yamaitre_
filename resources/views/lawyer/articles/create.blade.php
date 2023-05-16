@extends('layouts.app')

@section('content')
<!-- SubHeader -->
<div class="careerfy-subheader careerfy-subheader-with-bg">
    <span class="careerfy-banner-transparent"></span>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="careerfy-page-title">
                    <h1>منشوراتي</h1>
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
                            <div id="dashboard-tab-stats" class="main-tab-section">
                                <div class="careerfy-employer-dasboard">
                                    <div id="careerfy-notification-section" class="careerfy-employer-box-section careerfy-dashnotifics-bars">
                                        <div class="careerfy-profile-title">
                                            <h2>إضافة منشور</h2>
                                        </div>

                                        <div class="careerfy-main-section articles-section gray-bg ">

                                            <div class="row">

                                                <!-- Blog -->
                                                <div class="careerfy-blog careerfy-blog-grid">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            {{-- <div class="banner-box">
                                                                <img src="{{ asset('frontend-assets/img/bnr1.jpg') }}">
                                                            </div> --}}
                                                        </div>
                                                        {!! Form::open(['route' => ['lawyer.articles.store'], 'method' => 'POST', 'files' => true]) !!}

                                                            <div class="form-group">
                                                                {!! Form::label('title', 'عنوان المنشور :', [ 'class' => 'form-label m-b-15']) !!}

                                                                {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => "عنوان المنشور"]) !!}
                                                            </div>
                                                            @error('title')
                                                            <div class="error">{{ $message }}</div>
                                                            @enderror

                                                            <div class="upload__box">
                                                                <div class="upload__btn-box">
                                                                {!! Form::label('image[]', 'ارفق صور المنشور ', [ 'class' => 'upload__btn']) !!}

                                                                {!! Form::file('image[]', array_merge(['class' => 'upload__inputfile', 'accept' => ".png, .jpg, .jpeg,", 'multiple' => true])) !!}
                                                                <br>
                                                                <small>المقاس المرغوب للصور 1200x675px</small>

                                                                </div>
                                                                <div class="upload__img-wrap"></div>
                                                                @error('image')
                                                                <div class="error">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div id="editor">
                                                            {!! Form::label('description', 'اكتب ما تفكر به :', [ 'class' => 'form-label']) !!}
                                                            <br>
                                                            {!! Form::textarea('description', null, [
                                                                'class' => 'form-control ckeditor',
                                                                'placeholder'=> ' بماذا تفكر اليوم .. '
                                                            ]) !!}
                                                            </div>
                                                            @error('description')
                                                            <div class="error">{{ $message }}</div>
                                                            @enderror
                                                            <button class="careerfy-static-btn careerfy-bgcolor m-t-20 m-b-20">اضف المنشور</button>

                                                        {!! Form::close() !!}
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
