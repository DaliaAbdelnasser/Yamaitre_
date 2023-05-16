@extends('layouts.app')

@section('meta')
<title> {{ $data['page']->title }}  </title>
 <meta name="title" content="{{ $data['page']->meta_title??'' }}">
<meta name="description" content="{{ $data['page']->meta_desc??'' }}">
@endsection

@section('content')

<div class="careerfy-subheader careerfy-subheader-with-bg" style="background: url(frontend-assets/img/{{$data['slider']->image}});">
            <span class="careerfy-banner-transparent"></span>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="careerfy-page-title">
                            <h1>{{ $data['slider']->title }}</h1>
                            <p>{{ $data['slider']->subtitle }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="careerfy-breadcrumb">

            </div>
        </div>
        <!-- Main Content -->
        <div class="clearfix"></div>

<!-- Main Section -->
<div class="careerfy-main-section m-t-100 m-b-20 videos-filter">
    <div class="container">
        <div class="row">

            <div class="col-md-12 ">
                @include('partials._ads-banners')

                <div class="row">
                    @if (count($data['governorates']))
                    @if (session()->has('success'))
                        <div class="alert alert-success text-center" role="alert">{{ session('success') }}</div>
                    @endif 
                    @if ($errors->any())
                    @foreach ($errors->all() as $key => $error)
                        <div class="alert alert-danger text-center" role="alert">{{ $error }}</div>
                    @endforeach
                    @endif
                    <form class="m-t-20">
                        <div class="col-md-2"></div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <!-- <select class="form-control" id="meeting">
                                <option>اختر المحافظة</option>
                                <option>Select a meeting</option>
                                </select> -->
                                <select onchange="window.location.href=this.options[this.selectedIndex].value;" class="form-control" id="meeting">
                                    <option value="">اختر المحافظة</option>
                                    @foreach($data['governorates']  as $city)
                                    <option value="{{ route('lawyers.list', ['governorates' => $city]) }}">
                                        {{ $city }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <select onchange="window.location.href=this.options[this.selectedIndex].value;"  class="form-control" id="topic">
                                    <option value="">ترتيب المحامين</option>=
                                    <option value="{{ route('lawyers.list', ['rate' => 'desc']) }}">الأعلى تقييمًا</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                        <div class="clearfix"></div>
                    </form>
                    @endif
                </div>
                <div class="careerfy-job-listing careerfy-featured-listing">
                    <ul class="careerfy-row">
                        @foreach($data['users'] as $user)


                        <li class="careerfy-column-3">
                            <div class="careerfy-table-layer tasks-listing careerfy-candidate-view4">
                                <div class="careerfy-employer-slider-wrap">
                                    <div class="careerfy-content-wrapper careerfy-candidate careerfy-candidate-view4">
                                        <div class="careerfy-candidate-view4-wrap">
                                            <figure style="margin-right: 39px;margin-left: 39px;">
                                                <a href="javascript:void(0);" class="careerfy-candidate-view4-thumb"><img src="{{ asset('uploads/' . $user->userable->profile_image) }}" style="height:110px; width:110px;" alt="lawyer"></a>
                                            </figure>
                                            <h2> <a href="javascript:void(0);">{{ $user->first_name }} {{ $user->last_name }}</a> </h2>
                                            <p>محامي بــ {{ $user->userable->court_name }}</p>
                                            <p>محافظة {{ $user->userable->governorates }}</p>
                                            <span>{{ $user->userable->tasks_count }} مهمة</span>
                                            @php $rating = $user->userable->rate; @endphp 
                                            <div class="starss">
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
                                            <hr>
                                            <div class="text-center">
                                                {{-- <div class="careerfy-option-btn">
                                                    <a href="">شاهد المزيد</a>
                                                </div> --}}
                                                @auth
                                                @if(auth()->user()->id != $user->id)
                                                <div class="careerfy-option-btn">
                                                    <a href="" data-toggle="modal" data-target="#invitetotask-{{ $user->id }}">دعوة لمهمة</a>
                                                </div>
                                                @endif
                                                @endauth
                                                @guest
                                                <div class="careerfy-option-btn">
                                                    <a href="{{ route('login') }}">دعوة لمهمة</a>  
                                                </div>
                                                @endguest
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        @endforeach
                    </ul>
                </div>
                <!-- Featured Jobs Listings -->

            </div>

        </div>
    </div>
</div>
<!-- Main Section -->



@auth
@foreach($data['users'] as $user)
@if(auth()->user()->id != $user->id)
<div class="modal fade" id="invitetotask-{{ $user->id }}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">دعوة لتنفيذ مهمة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            @if(auth()->user()->userable_type == 'App\Models\Lawyer')
            {!! Form::open(['route' => ['lawyer.invite.lawyer', $user->id], 'method' => 'POST']) !!}
            @elseif(auth()->user()->userable_type == 'App\Models\Client')
            {!! Form::open(['route' => ['client.invite.lawyer', $user->id], 'method' => 'POST']) !!}
            @endif
            <div class="modal-body">
                <div class="jobsearch-filter-responsive-wrap job-alerts-sec">
                    <div class="jobsearch-search-filter-wrap jobsearch-without-toggle jobsearch-add-padding">
                        <div class="job-alert-box job-alert job-alert-container-top">
                            <div class="alerts-fields">
                                {!! Form::label('id', 'اختر مهمة ', [ 'class' => 'form-label']) !!}

                                {!! Form::select('id', $data['titles'],null,['class'=>'form-control', 'placeholder'=>'مهامي المضافة سابقا']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {!! Form::button('إلغاء', ['class' => 'btn btn-secondary', 'data-dismiss' => "modal"]) !!}
                {!! Form::submit('ارسال الدعوة', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endif
@endforeach
@endauth

@include('partials._pagination', ['records' => $data['users']])

@endsection