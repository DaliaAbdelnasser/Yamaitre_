@extends('layouts.app')

@section('content')
<!-- SubHeader -->
<div class="careerfy-subheader careerfy-subheader-with-bg">
    <span class="careerfy-banner-transparent"></span>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="careerfy-page-title">
                    <h1>{{ $task->title ?? '' }}</h1>
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
                        @if (session()->has('success'))
                            <div class="alert alert-success text-center" role="alert">{{ session('success') }}</div>
                        @endif
                        @if ($errors->any())
                        @foreach ($errors->all() as $key => $error)
                            <div class="alert alert-danger text-center" role="alert">{{ $error }}</div>
                        @endforeach
                        @endif 
                        <div class="careerfy-employer-box-section ">
                            <div class="careerfy-profile-title">
                                <h2> طلباتي من الغير</h2>
                            </div>
                            <div class="careerfy-main-section articles-section gray-bg ">
                                <div class="careerfy-blog careerfy-blog-grid">
                                    <div class="careerfy-jobdetail-content-section rltv">
                                        <h3 class="task-title-1">{{ $task->title ?? ''}}</h3>
                                        <p class="m-t-10 task-stats">
                                            <strong><i class="careerfy-icon careerfy-calendar-1"></i> تاريخ التنفيذ: <small>{{ $task->starting_date ?? 'ديسمبر, 05, 2020' }}</small></strong>
                                            <strong><i class="careerfy-icon careerfy-location"></i> المحافظة: <small>{{ $task->governorates }} </small> </strong>
                                            <strong><i class="careerfy-icon careerfy-group"></i> متقدمين: <small>{{ $task->applicants_count }} </small> </strong>

                                        </p>
                                        <div class="careerfy-jobdetail-services">
                                            <ul class="careerfy-row">
                                                <li class="careerfy-column-4">
                                                    <i class="careerfy-icon careerfy-salary"></i>
                                                    <div class="careerfy-services-text">تكلفة المهمة: <small>£{{ $task->price }}+</small></div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>
                                    <hr>

                                    <div class="careerfy-content-title">

                                        <h2 class="m-t-20">تفاصيل المهمة</h2>
                                    </div>

                                    <div class="careerfy-description">
                                        <p>{{ $task->description }}</p>
                                    </div>

                                </div>
                                <div class="clearfix"></div>
                                <hr>
                                @if($task->applicantlawyers->first() != null)    
                                <div class="careerfy-job-listing careerfy-featured-listing">
                                    <h5 class="m-t-20">المتقدمين للمهمة </h5>
                                    <ul class="careerfy-row inside-lawyers">
                                        @foreach($task->applicantlawyers as $lawyer)
                                        <li class="careerfy-column-12 col-xs-12">
                                            <div class="careerfy-table-layer tasks-listing careerfy-candidate-view4">
                                                <div class="careerfy-employer-slider-wrap">
                                                    <div class="careerfy-content-wrapper careerfy-candidate careerfy-candidate-view4">
                                                        <div class="careerfy-candidate-view4-wrap">
                                                            <figure>
                                                                <img src="{{ asset('uploads/' . $lawyer->userable->profile_image) }}" alt="">
                                                            </figure>
                                                            <div class="lawyer-info">
                                                                <h2>{{ $lawyer->first_name }} {{ $lawyer->last_name }}</h2>
                                                                <p>محامي بال {{ $lawyer->userable->court_name }}</p>
                                                                <p>محافظة {{ $lawyer->userable->governorates }}</p>
                                                                <span>{{ $lawyer->userable->tasks_count }} مهمة</span>
                                                                <p>{{ $lawyer->userable->description }}</p>
                                                                <div class="starss">@php $rating = $lawyer->userable->rate; @endphp  
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
                                                                <hr>
                                                                <div class="text-center">
                                                                    <div class="careerfy-option-btn careerfy-read-more careerfy-bgcolor">
                                                                        <a>{{ $lawyer->pivot->cost }} جنيه</a>
                                                                        
                                                                    </div>
                                                                    <div class="careerfy-option-btn"><a href="#" data-toggle="modal" data-target="#givetask-{{$lawyer->id}}"> إسناد المهمة</a></div>
                                                                {{--{!! Form::open(['route' => ['pay']], ['method' => 'post', 'target' => '_blank']) !!}
                                                                    {!! Form::hidden('mission_type', 'task') !!}
                                                                    {!! Form::hidden('mission_id', $task->id) !!}
                                                                    {!! Form::hidden('name', $task->title) !!}
                                                                    {!! Form::hidden('description', $task->description) !!}
                                                                    {!! Form::hidden('amount_cents', $lawyer->pivot->cost) !!}
                                                                    {!! Form::hidden('user_id', $lawyer->id) !!}--}}
                                                                        <!-- <a href="#" class="careerfy-option-btn" data-toggle="modal" data-target="#givetask-{{$lawyer->id}}"> إسناد المهمة</a> -->
                                                                    <!-- <div class="careerfy-option-btn">
                                                                        {{--{!! Form::submit('إسناد المهمة') !!}--}}

                                                                    </div> -->
                                                                {{--{!! Form::close() !!}--}}

                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>

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

@foreach($task->applicantlawyers as $lawyer)
<div class="modal fade" id="givetask-{{$lawyer->id}}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">إسناد المهمة وسداد قيمتها </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            {!! Form::open(['route' => ['pay']], ['method' => 'post', 'target' => '_blank']) !!}
            <div class="modal-body">
                {!! Form::hidden('mission_type', 'task') !!}
                {!! Form::hidden('mission_id', $task->id) !!}
                {!! Form::hidden('name', $task->title) !!}
                {!! Form::hidden('description', $task->description) !!}
                {!! Form::hidden('amount_cents', $lawyer->pivot->cost) !!}
                {!! Form::hidden('user_id', $lawyer->id) !!}
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
                <div class="form-group">
                    <p>تذكر أنه عند الدفع بالفيزا سيتم إضافة رسوم خدمة {{ $cash_in }}% إلى المبلغ المستحق <br>
                        تكلفة الخدمة بعد إضافة الرسوم : <strong> {{ $lawyer->pivot->cost + (($cash_in/100 )*$lawyer->pivot->cost) }} جنيه</strong>
                    </p>   
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                {!! Form::submit('إسناد المهمة', ['class' => 'btn btn-primary ']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endforeach
@section('script')
<script>
$('li > a').click(function() {
    $('li').removeClass();
    $(this).parent().addClass('active');
});
</script>
@endsection
