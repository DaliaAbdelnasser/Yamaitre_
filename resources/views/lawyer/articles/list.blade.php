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
                            @if ($errors->any())
                            @foreach ($errors->all() as $key => $error)
                                <div class="alert alert-danger text-center" role="alert">{{ $error }}</div>
                            @endforeach
                            @endif 
                            <div id="dashboard-tab-stats" class="main-tab-section">
                                <div class="careerfy-employer-dasboard">
                                    <div id="careerfy-notification-section" class="careerfy-employer-box-section careerfy-dashnotifics-bars">
                                        <div class="careerfy-profile-title">
                                            <h2>منشوراتي</h2>
                                            @if(auth()->user()->userable_type == 'App\Models\Lawyer' && auth()->user()->userable->status == 0)
                                            <a href="" data-toggle="modal" data-target="#addart" class="careerfy-static-btn careerfy-bgcolor m-t-20 m-b-20">اضف منشور</a>
                                            @else
                                            <a href="{{ route('lawyer.articles.create') }}" class="careerfy-static-btn careerfy-bgcolor m-t-20 m-b-20">اضف منشور</a>
                                            @endif
                                        </div>
                                        <div class="careerfy-main-section articles-section gray-bg ">

                                            <div class="row">

                                                <!-- Blog -->
                                                <div class="careerfy-blog careerfy-blog-grid">
                                                    <ul class="row">
                                                        @if($data['articles']->first() == null)
                                                            <p style="margin-right: 269px; margin-top: 35px; font-size: 20px">لا يوجد منشورات بعد</p>
                                                        @endif
                                                        @foreach($data['articles'] as $article)
                                                        <li class="col-md-6">
                                                            <div class="careerfy-employer-slider-wrap">
                                                                <div class="edit-panel">
                                                                    <div class="btn-group ">
                                                                        <button type="button" class="dropdown-toggle mnu-btn" data-toggle="dropdown" aria-expanded="true">
                                                                    <i class="fa fa-ellipsis-h"></i></button>
                                                                        <ul class="dropdown-menu" role="menu">
                                                                            <li><a href="{{ route('lawyer.articles.edit', [$article->id]) }} class="first2">تعديل المنشور</a></li>
                                                                            <li><a href="#" data-toggle="modal" data-target="#deletemodal-{{ $article->id }}">حذف المنشور</a></li>

                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="careerfy-content-wrapper careerfy-candidate careerfy-candidate-view4">
                                                                    <figure>
                                                                        <a href="{{ route('single.article', [$article->id]) }}"><img src="{{ asset('uploads/' . $article->image_feature) }}"></a>
                                                                    </figure>
                                                                    <div class="careerfy-blog-grid-text">

                                                                        <h2><a href="single-post.html">{{ $article->title }}</a></h2>
                                                                        <ul class="careerfy-blog-grid-option">
                                                                            <li>{{ $article->author_name }}</li>
                                                                            <li><time datetime="2008-02-14 20:00">{{ $article->created_at ?? 'OCT 6, 2016' }}</time></li>
                                                                        </ul>
                                                                        @php
                                                                        $start = strpos($article->description, '<p>');
                                                                        $end = strpos($article->description, '</p>', $start);
                                                                        $excerpt = substr($article->description, $start, $end-$start+4);
                                                                        $excerpt = html_entity_decode(strip_tags($excerpt));
                                                                        @endphp
                                                                        <p>{{ implode(' ', array_slice(explode(' ', $excerpt), 0, 8)) }}@if ( str_word_count($excerpt) > 8 )...@endif</p>                                                                        <a href="{{ route('single.article', [$article->id]) }}" class="careerfy-read-more careerfy-bgcolor">اقرأ المزيد</a>
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
                            @include('partials._pagination', ['records' => $data['articles']])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="addart" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">إضافة منشور</h5>
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
            @endif
        </div>
    </div>
</div>


@foreach($data['articles'] as $article)
<div class="modal fade" id="deletemodal-{{ $article->id }}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
