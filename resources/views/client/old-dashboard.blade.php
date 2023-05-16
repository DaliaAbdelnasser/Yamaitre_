@extends('layouts.app')

@section('content')
    {{-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Client-Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in As Client!') }}
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
<div class="careerfy-banner careerfy-typo-wrap">
    <span class="careerfy-banner-transparent"></span>
    <div class="careerfy-banner-caption">
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
        @endif 
        <div class="container">
            <h1> !مرحبا بك</h1>
            <p>لقد سجلت الدخول كـ موكل</p>
        </div>
    </div>
</div>
<div class="careerfy-employer careerfy-employer-slider careerfy-blog careerfy-blog-grid cs-ar-grid">
    <div class="careerfy-employer-slider-wrap">

        <div class="careerfy-content-wrapper careerfy-candidate careerfy-candidate-view4">
            <div class="careerfy-blog-grid-text">

                <h2><a href="#">إدفع للإستشارة القانونية</a></h2>
                {!! Form::open(['route' => ['pay', ['name' => 'my first consultation', 'amount' => '200', 'description' => 'the first consultation', 'id' => '1', 'type' => 'consultation']],  'method' => 'post']) !!}
                  <!-- <input style="width: fit-content" type="submit" value="Paymob" class="btn"> -->
                {!! Form::submit('200 LE', ['class' => 'btn']) !!}
                {!! Form::close() !!}
                <h2><a href="#">إلغاء دفع للإستشارة القانونية</a></h2>
                {!! Form::open(['route' => ['refund', ['id' => '1', 'type' => 'consultation']],  'method' => 'post']) !!}
                  <!-- <input style="width: fit-content" type="submit" value="Paymob" class="btn"> -->
                {!! Form::submit('200 LE', ['class' => 'btn']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="careerfy-employer-slider-wrap">

        <div class="careerfy-content-wrapper careerfy-candidate careerfy-candidate-view4">
            <div class="careerfy-blog-grid-text">

                <h2><a href="#">إدفع للمهمة</a></h2>
                <p></p>
                {!! Form::open(['route' => ['pay', ['name' => 'my first task', 'amount' => '100', 'description' => 'the first task', 'id' => '2', 'type' => 'task']],  'method' => 'post']) !!}
                  <!-- <input style="width: fit-content" type="submit" value="Paymob" class="btn"> -->
                {!! Form::submit('100 LE', ['class' => 'btn']) !!}
                {!! Form::close() !!}
                <h2><a href="#">إلغاء دفع  للمهمة</a></h2>
                {!! Form::open(['route' => ['refund', ['id' => '1', 'type' => 'task']],  'method' => 'post']) !!}
                  <!-- <input style="width: fit-content" type="submit" value="Paymob" class="btn"> -->
                {!! Form::submit('100 LE', ['class' => 'btn']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
