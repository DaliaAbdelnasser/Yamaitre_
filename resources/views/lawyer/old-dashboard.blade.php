@extends('layouts.app')

@section('content')
<div class="careerfy-banner careerfy-typo-wrap">
    <span class="careerfy-banner-transparent"></span>
    <div class="careerfy-banner-caption">
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
        @endif 
        <div class="container">
            <h1> !مرحبا بك</h1>
            <p>لقد سجلت الدخول كـ محامي</p>
        </div>
    </div>
</div>
<div class="careerfy-employer careerfy-employer-slider careerfy-blog careerfy-blog-grid cs-ar-grid">
    <div class="careerfy-employer-slider-wrap">

        <div class="careerfy-content-wrapper careerfy-candidate careerfy-candidate-view4">
            <div class="careerfy-blog-grid-text">

                <h2><a href="#">إدفع للإقرار الضريبي</a></h2>
                {!! Form::open(['route' => ['pay', ['name' => 'my first tax', 'amount' => '150', 'description' => 'the first tax', 'id' => '1', 'type' => 'tax']],  'method' => 'post']) !!}
                {!! Form::token() !!}
                  <!-- <input style="width: fit-content" type="submit" value="Paymob" class="btn"> -->
                {!! Form::submit('150 LE', ['class' => 'btn']) !!}
                {!! Form::close() !!}
                <h2><a href="#">إلغاء دفع للإقرار الضريبي</a></h2>
                {!! Form::open(['route' => ['refund', ['id' => '1', 'type' => 'tax']],  'method' => 'post']) !!}
                  <!-- <input style="width: fit-content" type="submit" value="Paymob" class="btn"> -->
                {!! Form::submit('150 LE', ['class' => 'btn']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="careerfy-employer-slider-wrap">

        <div class="careerfy-content-wrapper careerfy-candidate careerfy-candidate-view4">
            <div class="careerfy-blog-grid-text">

                <h2><a href="#">إدفع للمهمة</a></h2>
                <p></p>
                {!! Form::open(['route' => ['pay',['name' => 'my first task', 'amount' => '100', 'description' => 'the first task', 'id' => '1', 'type' => 'task']], 'method' => 'POST']) !!}
                {!! Form::token() !!}
                  <!-- <input style="width: fit-content" type="submit" value="Paymob" class="btn"> -->
                {!! Form::submit('100 LE', ['class' => 'btn']) !!}
                {!! Form::close() !!}
                <h2><a href="#">إلغاء دفع للمهمة</a></h2>
                <p></p>
                {!! Form::open(['route' => ['refund',['id' => '1', 'type' => 'task']], 'method' => 'POST']) !!}
                  <!-- <input style="width: fit-content" type="submit" value="Paymob" class="btn"> -->
                {!! Form::submit('100 LE', ['class' => 'btn']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<div class="careerfy-user-form">

<aside>
    {{-- Rooms --}}
    <div class="jobsearch-chat-user-list">
        <input type="hidden" name="employer-user-offset" value="7">
        <input type="hidden" name="candidate-user-offset" value="7">
        <input type="hidden" name="scrollTop-emp" value="600">
        <input type="hidden" name="scrollTop-cand" value="600">
        <div class="jobsearch-chat-users-list"
            style="overflow: hidden; outline: currentcolor none medium;" tabindex="1">
            <ul>
                @foreach ($data['chat'] as $room)
                    <a href="#">
                        <li class="jobsearch-chat-user-1 {{ $room->id == @$content_chat_id??0 ? 'active' : ''}}">
                            {{--<img src="{{ $room->other->profile_image_original_path }}">--}}
                            
                            {{-- @if (false)
                                <span class="status status-with-thumb green"></span>
                            @else
                                <span class="status status-with-thumb orange"></span>
                            @endif --}}

                            <div class="jobsearch-load-user-chat user-info active" data-user-chat="1">
                                <h2 class="name">
                                    {{ $room->reciever->first_name??'' }}
                                    <small>{{ $room->updated_at->format('M, d, Y')??'' }}</small>
                                </h2>
                                <p> 
                                    {{ $room->sender->first_name??'' }} 
                                    @foreach ($room->content as $content)
                                        <span class="">{{ $content->message }}</span>
                                    @endforeach
                                </p>
                            </div>
                        </li>
                    </a>
                @endforeach
                    
                {{-- <li class="jobsearch-chat-user-15">
                    <a href="{{ route('room',1) }}">
                        <img src="images/team8.jpg">
                        <span class="status status-with-thumb orange"></span>
                        <div class="jobsearch-load-user-chat name" data-user-chat="15">
                            <h2>Rebecca Cox <small></small></h2>
                            <p> <span class="jobsearch-chat-unread-message hidden">0</span>
                            </p>
                        </div>
                    </a>
                </li> --}}
            </ul>
        </div>

    </div>
</aside>
<div class="container">
    <div class="row mt-5">
        <div class="col-6 offset-3">
            <div class="card">
                <div class="card-header">
                    Chat Room
                </div>
                <div class="card-body">
                        <br>
                        <div class="form-group" id="data-message" style="float:left;">
                        </div>
                        <br>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="name" id="message-owner">
                        </div>
                        <div class="form-group">
                            <textarea type="text" class="form-control" placeholder="Message" id="message-input"></textarea>
                        </div>
                        <div class="form-group">
                            <button id="send-btn" class="btn btn-block btn-primary">send</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{--<div class="careerfy-user-form">
<aside>
    {{-- Rooms --}}
    <div class="jobsearch-chat-user-list">
        <input type="hidden" name="employer-user-offset" value="7">
        <input type="hidden" name="candidate-user-offset" value="7">
        <input type="hidden" name="scrollTop-emp" value="600">
        <input type="hidden" name="scrollTop-cand" value="600">
        <div class="jobsearch-chat-users-list"
            style="overflow: hidden; outline: currentcolor none medium;" tabindex="1">
            <ul>
                @foreach ($data['chat'] as $room)
                    <a href="#">
                        <li class="jobsearch-chat-user-1 {{ $room->id == @$content_chat_id??0 ? 'active' : ''}}">
                            {{--<img src="{{ $room->other->profile_image_original_path }}">--}}
                            
                            {{-- @if (false)
                                <span class="status status-with-thumb green"></span>
                            @else
                                <span class="status status-with-thumb orange"></span>
                            @endif --}}

                            <div class="jobsearch-load-user-chat user-info active" data-user-chat="1">
                                <h2 class="name">
                                    {{ $room->reciever->name??'' }}
                                    <small>{{ $room->updated_at->format('M, d, Y')??'' }}</small>
                                </h2>
                                <p> 
                                    {{ $room->sender->name??'' }} 
                                    @foreach ($room->content as $content)
                                        <span class="">{{ $content->message }}</span>
                                    @endforeach
                                </p>
                            </div>
                        </li>
                    </a>
                    <hr>
                @endforeach
                    
                {{-- <li class="jobsearch-chat-user-15">
                    <a href="{{ route('room',1) }}">
                        <img src="images/team8.jpg">
                        <span class="status status-with-thumb orange"></span>
                        <div class="jobsearch-load-user-chat name" data-user-chat="15">
                            <h2>Rebecca Cox <small></small></h2>
                            <p> <span class="jobsearch-chat-unread-message hidden">0</span>
                            </p>
                        </div>
                    </a>
                </li> --}}
            </ul>
        </div>

    </div>
</aside>
</div>--}}

@endsection
