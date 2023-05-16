<aside class="careerfy-column-3 dsply-dsk">
    <div class="careerfy-typo-wrap">
        <div class="careerfy-employer-dashboard-nav widget_jobdetail_three_apply_wrap">
            <figure>
                @if(auth()->user()->userable->profile_image == null)
                <a href="javascript:void(0);" class="employer-dashboard-thumb"><img src="{{ asset('uploads/profile_placeholder.png') }}" alt=""></a>
                @else
                <a href="javascript:void(0);" class="employer-dashboard-thumb"><img src="{{ asset('uploads/' . auth()->user()->userable->profile_image) }}" alt=""></a>
                @endif
                <figcaption>
                    {!! Form::open(['id' => 'user_image_form', 'route' => ['update.profile'], 'method' => 'PATCH', 'files' => true]) !!}
                    <div class="careerfy-fileUpload">
                        <span><i class="careerfy-icon careerfy-add"></i> اضافة صورة البروفايل</span>
                        {!! Form::file('profile_image', array_merge(['class' => 'careerfy-upload', 'accept' => ".png, .jpg, .jpeg", 'id' => 'user_image'])) !!}
                    </div>

                    {!! Form::close() !!}
                    <h2><a href="javascript:void(0);">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</a></h2>
                </figcaption>
            </figure>
            
            @if(auth()->user()->userable_type == 'App\Models\Lawyer')
            {{--<div class="starss"><span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span> 
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span></div>--}}
            <div class="starss" >
                @php $rating = auth()->user()->userable->rate; @endphp  
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

            <p><i class="fa fa-map-marker"></i> {{ auth()->user()->userable->governorates }}</p>
            <p><i class="fa fa-link"></i> {{ auth()->user()->userable->court_name }}</p>
            <p> {{ auth()->user()->userable->description }}</p>
            @elseif(auth()->user()->userable_type == 'App\Models\Client')
            <p><i class="fa fa-map-marker"></i> {{ auth()->user()->userable->governorates }}</p>
            @endif

            @if(auth()->user()->userable_type == 'App\Models\Client')
            <ul>
                <li class="{{ Request::is('client/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('client.dashboard') }}">
                          حسابي </a>
                </li>

                <li class="{{ Request::is('client/tasks') ? 'active' : '' }}">
                    <a href="{{ route('client.tasks.list') }}">
                        طلبات المساعدة القانونية </a>
                </li>
                <li class="{{ Request::is('client/consultations') ? 'active' : '' }}">
                    <a href="{{ route('client.consultations.list') }}">
                        استشاراتي القانونية </a>
                </li>
                <li class="{{ Request::is('client/announcements') ? 'active' : '' }}">
                    <a href="{{ route('client.ads.list') }}">إعلاناتي </a>
                </li>
                <li class="{{ Request::is('client/chats', 'client/chat-room') ? 'active' : '' }}">
                    <a href="{{ route('client.rooms') }}">المحادثات </a>
                </li>
                <li class="{{ Request::is('notifications') ? 'active' : '' }}">
                    <a href="{{ route('notifications.list') }}">
                    الاشعارات </a>
                </li>
                <li class="{{ Request::is('balance') ? 'active' : '' }}">
                    <a href="{{ route('balance') }}">
                     رصيدي </a>
                </li>
                <li class="{{ Request::is('client/settings') ? 'active' : '' }}">
                    <a href="{{ route('client.profile') }}">الإعدادات </a>
                </li>

                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                        تسجيل الخروج </a>
                </li>

            </ul>
            @elseif(auth()->user()->userable_type == 'App\Models\Lawyer')
            <ul>
                <li class="{{ Request::is('lawyer/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('lawyer.dashboard') }}">
                          حسابي </a>
                </li>
                
                <li class="{{ Request::is('lawyer/lawyer-tasks', 'lawyer/tasks', 'lawyer/others-tasks', 'lawyer/offers-tasks') ? 'active' : '' }}">
                    <a href="{{ route('lawyer.lawyer-tasks.list') }}">
                        مهامي </a>
                </li>
                <li class="{{ Request::is('lawyer/articles', 'lawyer/article/*') ? 'active' : '' }}">
                    <a href="{{ route('lawyer.articles.list') }}">
                        منشوراتي </a>
                </li>
                <li class="{{ Request::is('lawyer/taxes') ? 'active' : '' }}"><a href="{{ route('lawyer.taxes.list') }}"> اقراراتي الضريبية</a></li>

                <li class="{{ Request::is('lawyer/sos') ? 'active' : '' }}"><a href="{{ route('lawyer.sos.list') }}"> نداءات الاستغاثة</a></li>

                <li class="{{ Request::is('lawyer/announcements') ? 'active' : '' }}">
                    <a href="{{ route('lawyer.ads.list') }}">إعلاناتي </a>
                </li>
                <li class="{{ Request::is('lawyer/chats', 'lawyer/chat-room') ? 'active' : '' }}">
                    <a href="{{ route('lawyer.rooms') }}">المحادثات </a>
                </li>
                <li class="{{ Request::is('notifications') ? 'active' : '' }}">
                    <a href="{{ route('notifications.list') }}">
                    الاشعارات </a>
                </li>
                <li class="{{ Request::is('balance') ? 'active' : '' }}">
                    <a href="{{ route('balance') }}">
                     رصيدي </a>
                </li>

                <li class="{{ Request::is('lawyer/settings') ? 'active' : '' }}">
                    <a href="{{ route('lawyer.profile') }}">الإعدادات </a>
                </li>
                <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                        تسجيل الخروج </a>
                </li>
            </ul>
            @endif
        </div>
    </div>
</aside>

@section('script')
    <script>
        $('.multipleSelect').fastselect();

        // if (document.getElementById("candidate_image").files.length == 0) {
        //     console.log("no files selected");
        // } else {
            document.getElementById("user_image").onchange = function() {
                console.log("file selected");
                document.getElementById("user_image_form").submit();
            };
        // }
    </script>
@endsection