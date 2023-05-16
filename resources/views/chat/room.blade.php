
@extends('layouts.app')


@section('content')
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
                                    <div id="careerfy-notification-section" class="careerfy-employer-box-section careerfy-dashnotifics-bars">
                                        <div class="careerfy-profile-title">
                                            <h2> المحادثات</h2>
                                        </div>
                                        <div class="careerfy-main-section articles-section gray-bg ">

                                            <div class="row">
                                            @if($chats->first() == null)
                                                <p style="margin-right: 270px; margin-top: 35px;margin-bottom: 25px; font-size: 20px">لا يوجد محادثات بعد</p>
                                            @else
                                                <div id="jobsearch-chat-container" class="jobsearch-chat-main-container jobsearch-chat-front-full">
                                                    <aside>
                                                        <div class="jobsearch-chat-sort-list">
                                                            <div class="jobsearch-chat-filter-wrapper">
                                                                <div class="jobsearch-chat-filter-input-field">
                                                                    <form class="careerfy-employer-search">
                                                                        <input value="Search Messages" onblur="if(this.value == '') { this.value ='Search Messages'; }" onfocus="if(this.value =='Search Messages') { this.value = ''; }" type="text">
                                                                        <input type="submit" value="">
                                                                        <i class="careerfy-icon careerfy-search"></i>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="jobsearch-chat-user-list">
                                                            <input type="hidden" name="employer-user-offset" value="7">
                                                            <input type="hidden" name="candidate-user-offset" value="7">
                                                            <input type="hidden" name="scrollTop-emp" value="600">
                                                            <input type="hidden" name="scrollTop-cand" value="600">
                                                            <div class="jobsearch-chat-users-list jobsearch-chat-user-employer" style="overflow: hidden; outline: currentcolor none medium;" tabindex="1">
                                                                <ul>
                                                                    {{--<li class="jobsearch-chat-user-1 active">
                                                                        <img src="{{ asset('uploads/' . $chats[0]->reciever->userable->profile_image) }}">
                                                                        <span class="status status-with-thumb green"></span>
                                                                        <div class="jobsearch-load-user-chat user-info active" data-user-chat="1">
                                                                            <h2 class="name">{{ $chats[0]->reciever->first_name }} {{ $chats[0]->reciever->last_name }}<small>9:48am</small></h2>
                                                                            <p> https://www.youtube.com/watch?... <span class="jobsearch-chat-unread-message hidden">0</span></p>
                                                                        </div>
                                                                    </li>--}}
                                                                    @foreach($chats as $key => $chat)
                                                                    @if($chat->sender->id == auth()->user()->id)
                                                                    @if(auth()->user()->userable_type == 'App\Models\Lawyer')
                                                                    <a href="{{ route('lawyer.chat.room', $chat->id) }}">
                                                                    <li class="jobsearch-chat-user-{{$key}} {{ Request::is('lawyer/chats/room/$chats[$key]->id ') ? 'active' : '' }}">
                                                                    @else
                                                                    <a href="{{ route('client.chat.room', $chat->id) }}">
                                                                    <li class="jobsearch-chat-user-{{$key}} {{ Request::is('client/chats/room/$chats[$key]->id ') ? 'active' : '' }}">
                                                                    @endif
                                                                        <img src="{{ asset('uploads/' . $chat->reciever->userable->profile_image) }}">
                                                                        <!-- <span class="status status-with-thumb orange"></span> -->
                                                                        <div class="jobsearch-load-user-chat name" data-user-chat="{{$key}}">
                                                                            <h2>{{ $chat->reciever->first_name }} {{ $chat->reciever->last_name }} <small></small></h2>
                                                                            <p> <span class="jobsearch-chat-unread-message hidden">0</span></p>
                                                                        </div>
                                                                    </li>
                                                                    </a>
                                                                    @else
                                                                    @if(auth()->user()->userable_type == 'App\Models\Lawyer')
                                                                    <a href="{{ route('lawyer.chat.room', $chat->id) }}">
                                                                    <li class="jobsearch-chat-user-{{$key}} {{ Request::is('lawyer/chats/room/$chats[$key]->id') ? 'active' : '' }}">
                                                                    @else
                                                                    <a href="{{ route('client.chat.room', $chat->id) }}">
                                                                    <li class="jobsearch-chat-user-{{$key}} {{ Request::is('client/chats/room/$chats[$key]->id') ? 'active' : '' }}">
                                                                    @endif
                                                                        <img src="{{ asset('uploads/' . $chat->sender->userable->profile_image) }}">
                                                                        <!-- <span class="status status-with-thumb orange"></span> -->
                                                                        <div class="jobsearch-load-user-chat name" data-user-chat="{{$key}}">
                                                                            <h2>{{ $chat->sender->first_name }} {{ $chat->sender->last_name }}<small></small></h2>
                                                                            <p> <span class="jobsearch-chat-unread-message hidden">0</span></p>
                                                                        </div>
                                                                    </li>
                                                                    </a>
                                                                    @endif
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </aside> 
                                                    @if($singlechat != null)
                                                    <div class="jobsearch-user-chat-content jobsearch-user-chat-messages user-{{$chat->id}}">
                                                        <div class="jobsearch-user-chat-header">
                                                            <div class="jobsearch-user-detail">
                                                                @if($singlechat->sender->id == auth()->user()->id)
                                                                <img src="{{ asset('uploads/' . $singlechat->reciever->userable->profile_image) }}" alt="">
                                                                <!-- <span class="status status-with-thumb "></span> -->
                                                                <div class="jobsearch-user-status-wrapper">
                                                                    <h2>{{ $singlechat->reciever->first_name ?? ''}} {{ $singlechat->reciever->last_name ?? ''}}</h2>
                                                                </div>
                                                                @else
                                                                <img src="{{ asset('uploads/' . $singlechat->sender->userable->profile_image) }}" alt="">
                                                                <!-- <span class="status status-with-thumb "></span> -->
                                                                <div class="jobsearch-user-status-wrapper">
                                                                    <h2>{{ $singlechat->sender->first_name ?? ''}} {{ $singlechat->sender->last_name ?? ''}}</h2>
                                                                </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <ul id="chat" class="jobsearch-chat-messages-list" style=" outline: currentcolor none medium;" tabindex="3">
                                                            @foreach($singlechat->content as $key => $content )
                                                            @if($content->message != " " || $content->file != null)
                                                            @if($content->senderable_id == auth()->user()->id)
                                                            <li class="dn-sender">
                                                                @if($singlechat->reciever->id == auth()->user()->id)
                                                                <img src="{{ asset('uploads/' . $singlechat->reciever->userable->profile_image) }}">
                                                                @else
                                                                <img src="{{ asset('uploads/' . $singlechat->sender->userable->profile_image) }}">
                                                                @endif
                                                                <div class="jobsearch-chat-entete-wrapper chat-688" >
                                                                    @if($content->message != null && $content->message != " ")
                                                                    <p>
                                                                        {{ $content->message }}
                                                                    </p>
                                                                    @endif
                                                                    @if($content->file != null)
                                                                    <a href="{{ asset('uploads//' . $content->file) }}" download style="font-size:12px"><i class="fa fa-cloud-download"></i> {{ $content->file_name }}</a>
                                                                    @endif
                                                                    <div class="jobsearch-chat-entete">
                                                                        <h3>{{ $content->created_at ?? '' }}</h3>
                                                                        <a href="javascript:void(0)" class="jobsearch-color jobsearch-chat-seen">Seen</a>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            @else
                                                            <li class="dn-receiver">
                                                                <div class="jobsearch-chat-entete-wrapper chat-688" style="direction: ltr;">
                                                                    @if($content->message != null && $content->message != " ")
                                                                    <p>
                                                                        {{ $content->message }}
                                                                    </p>
                                                                    @endif
                                                                    @if($content->file != null)
                                                                    <a href="{{ asset('uploads/' . $content->file) }}" download style="font-size:12px"><i class="fa fa-cloud-download"></i> {{ $content->file_name }}</a>
                                                                    @endif
                                                                    <div class="jobsearch-chat-entete">
                                                                        <h3>{{ $content->created_at}}</h3>
                                                                        <a href="javascript:void(0)" class="jobsearch-color jobsearch-chat-seen">Seen</a>
                                                                    </div>
                                                                </div>
                                                                @if($singlechat->reciever->id == auth()->user()->id)
                                                                <img src="{{ asset('uploads/' . $singlechat->sender->userable->profile_image) }}">
                                                                @else
                                                                <img src="{{ asset('uploads/' . $singlechat->reciever->userable->profile_image) }}">
                                                                @endif
                                                            </li>
                                                            @endif
                                                            @endif
                                                            @endforeach
                                                            <!-- <li class="you-send" id="senderimg">
                                                                <img src="{{ asset('uploads/' . auth()->user()->userable->profile_image) }}">
                                                                
                                                                <div class="jobsearch-chat-entete-wrapper chat-732" id="msg">
                                                                    
                                                                </div>
                                                            </li> -->
                                                        </ul>
                                                        <!-- for sending new message -->
                                                        <div class="jobsearch-chat-form-wrapper">
                                                            <form class="jobsearch-chat-form" method="post" enctype="multipart/form-data" id="message-form" action="{{ route('send.web', [$singlechat->id]) }}">
                                                                @csrf
                                                                <textarea placeholder="أدخل رسالتك" name="message" id="message-input" class="filename"></textarea>
                                                                <input type="hidden" name="sender_id" value="15">
                                                                <input type="hidden" name="reciever_id" value="1">
                                                                <input type="hidden" class="typing" name="typing" value="false">
                                                                <input type="hidden" id="uploaded_file" name="uploaded" value="false">
                                                                <input type="hidden" name="sender_image" value="{{ asset('frontend-assets/images/team3') }}">
                                                                <input type="hidden" name="receiver_image" value="{{ asset('frontend-assets/images/team10') }}">
                                                                <input type="file" name="chat_file" class="jobsearch-chat-share-file hidden"  id="file_button">
                                                                <div class="jobsearch-chat-share-file-wrapper">
                                                                    <div class="jobsearch-chat-share-file">
                                                                        <label for="file_button" id="selected_file">
                                                                            <a class="jobsearch-tooltipcon">
                                                                                <i class="fa fa-link"></i>
                                                                            </a>
                                                                        </label>
                                                                    </div>
                                                                    <div class="jobsearch-chat-typing-wrapper">
                                                                        <span class="jobsearch-chat-user-typing bounce"></span>
                                                                        <input type="submit" id="send-btn" class="jobsearch-chat-send-message" value="ارسل">
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    @endif
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
            </div>
        </div>
    </div>
    <!-- Main Section -->

</div>
<!-- Main Content -->

@if($singlechat != null)
<script src="{{ asset('js/app.js') }}"></script>

<script>
    const username_ = document.getElementById('message-owner');
    const message_ = document.getElementById('data-message');
    const message_input = document.getElementById('message-input');
    const message_form = document.getElementById('message-form');
    const message_submit = document.getElementById('send-btn');
    const message_sent = document.getElementById('msg');
    const sender_img = document.getElementById('senderimg');
    var chat_file = document.getElementById('file_button');
    
    var imagefile = document.querySelector('#file_button');

    message_submit.addEventListener('click', function(e){
    e.preventDefault();

     
    let has_errors = false;

    if(message_input.value == '' && imagefile.files[0] == null)
    {
        // alert("please enter your message first");
        has_errors = true;
    }
    
    if(has_errors)
    {
        return;
    }
    
    var headers = {
    		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Content-Type': 'multipart/form-data',
            // 'files' : chat_file.value.replace(/.*(\/|\\)/, '')
		}
    const options = {
        method: 'post',
        url: "/chats/room/<?php echo $singlechat->id ?>",
        headers: headers,
        data: {
            message: message_input.value,
            file: imagefile.files[0]
        }
    }
    
    transformResponse:[(data) => {
        return data;
    }]

    axios(options);

    });

    const Echo = window.Echo;

    let channel = Echo.channel("<?php echo $singlechat->chat_channel ?>");
    channel.listen(".message", (e)=> {
        message_input.value = '';
        console.log(e.data); 
        let date = new Date().toJSON().slice(0, 19);

        // const currentDate = new Date();
        // const options = { weekday: 'long', year: 'numeric', month: 'short', day: 'numeric' };        
        // console.log(currentDate.toLocaleDateString('ar-EG', options))
        // // الجمعة، ٢ يوليو ٢٠٢١

       
        console.log(e);
        var file_text = e.data.file;

        if(e.data.file !== null)
        {
            file_text = `<a href="{{ asset('uploads/`+e.data.file+`') }}" download style="font-size:12px"><i class="fa fa-cloud-download"></i> `+e.data.file_name+`</a>`;
            message_text = "";
        }
        // else
        // {
        //     file_text = "";
        // }

        else if(e.data.message !== null && e.data.message !== " " )
        {
            message_text = `<p>`+e.data.message+`</p>`;
            file_text = "";
        }
        // else
        // {
        //     message_text = "";
        // }

        $('#chat').append(`
            <li class="dn-sender" id="senderimg">
                <img src="{{ asset('uploads/`+e.sender_data.user.userable.profile_image+`') }}">
                
                <div class="jobsearch-chat-entete-wrapper chat-732" id="msg">
                    `+message_text+`
                    <span></span>
                    `+file_text+`
                    <div class="jobsearch-chat-entete">
                        <h3 style="direction:rtl;">`+date+`</h3>
                        <a href="javascript:void(0)" class="jobsearch-color jobsearch-chat-seen">Seen</a>
                    </div>
                </div>
            </li>
        `);
        // document.getElementById('file-selected-now').hidden = true;
        document.getElementById('file_button').value = '';
        document.getElementById('selected_file').hidden = false;
    });
    
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>

    (function($){
        $(function(){
            $('#message-input').keypress(function (e){
                console.log(e);
                document.getElementById('selected_file').hidden = true;
            });
            $(window).keydown(function(event) {
                 const key = event.key; // const {key} = event; ES6+
                if (key === "Backspace") {
                    if(message_input.value.length == 1)
                    {
                        console.log('yes');
                        document.getElementById('selected_file').hidden = false;
                    }
                  console.log(event);
                }
                
            });
            $("#file_button").on('change', function(){
                var file = $('#file_button').val();
                if(file !== null)
                {
                    if($('.filename').val() !== null){
                        $($('.filename')).empty();
                        // document.getElementById('selected_file').innerHTML = `<span style="font-size:10px" id="file-selected-now">File Selected</span>
                        //  <a class="jobsearch-tooltipcon"><i class="fa fa-link"></i></a>`;
                        
                        document.getElementById('message-input').value = file.replace(/.*(\/|\\)/, '');
                        
                        // $('#selected_file') = `<span style="font-size:10px" id="file-selected-now">File Selected</span>`;
                        // document.getElementById('selected_file').innerHTML.preappend('<span style="font-size:10px">File Selected</span>');
                    }
                }
            });
        });
    })(jQuery);
</script>
@endif
@endsection
