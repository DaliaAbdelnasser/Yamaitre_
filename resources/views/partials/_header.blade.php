<!-- Header -->
<div class="row">
    <aside class="col-md-2 col-xs-6 col-sm-6 cs_mob_logo">
        <a href="{{ route('home') }}" class="careerfy-logo"><img src="{{ asset('uploads/logo.png') }}" alt=""></a>
    </aside>
    <aside class="col-md-8 col-xs-6 col-sm-6 pos-unset no-pd cs_mob_menu">
        <nav class="careerfy-navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#careerfy-navbar-collapse-1" aria-expanded="false">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <ul class="careerfy-user-section cs-acc-menu dsply-mob">
                @auth

                {{-- @if(auth()->user()->userable_type == 'App\Models\Client')
                <li class="btn1"><a class="careerfy-color careerfy-open-signin-tab" href="{{route('client.dashboard')}}"><i class="fa fa-user"></i></a></li>
                @else
                <li class="btn1"><a class="careerfy-color careerfy-open-signin-tab" href="{{route('lawyer.dashboard')}}"><i class="fa fa-user"></i></a></li>
                @endif --}}

                @if(\Auth::user()->userable_type == 'App\Models\Lawyer' || \Auth::user()->userable_type == 'App\Models\Client')
                <li class="jobsearch-usernotifics-menubtn menu-item menu-item-type-custom menu-item-object-custom ">
                    <a href="javascript:void(0);" class="elementor-item elementor-item-anchor"><i class="fa fa-bell-o" id="notifications-count"></i></a>
                    <div class="jobsearch-hdernotifics-listitms">
                        <div class="hdernotifics-title-con">
                            <span class="hder-notifics-count" id="inner-notifications-count" hidden></span>
                            <span class="hder-notifics-title">إشعارات</span>
                            <hr>
                        </div>
                        <div class="jobsearch-hdrnotifics-list" id="notifications-list">
                            <p id="no-notifications">لا يوجد إشعارات بعد</p>
                        </div>
                        <div class="hdernotifics-after-con">

                            <a href="{{ route('notifications.list') }}" class="hdernotifics-viewall-btn jobsearch-color" id="show-more-not" hidden>شاهد المزيد</a>
                        </div>
                    </div>
                </li>
                <li class="jobsearch-userdash-menumain menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children">
                    <a href="#" class="jobsearch-color elementor-item elementor-item-anchor active"><i class="fa fa-user"></i></a>
                    @if(auth()->user()->userable_type == 'App\Models\Client')
                    <ul class="nav-item-children sub-menu elementor-nav-menu--dropdown"  >
                        <li class="{{ Request::is('client/dashboard') ? 'active' : '' }}"><a href="{{ route('client.dashboard') }}">حسابي </a></li>
                        <li><a href="{{ route('client.tasks.list') }}">طلبات المساعدة القانونية </a></li>
                        <li><a href="{{ route('client.consultations.list') }}">استشاراتي القانونية </a></li>
                        <li><a href="{{ route('client.ads.list') }}"> إعلاناتي</a></li>
                        <li><a href="{{ route('client.rooms') }}">المحادثات </a></li>
                        <li class="{{ Request::is('balance') ? 'active' : '' }}"><a href="{{ route('balance') }}">رصيدي </a></li>
                        <li><a href="{{ route('notifications.list') }}">الإشعارات </a></li>
                        <li><a href="{{ route('client.profile') }}">الإعدادات </a></li>
                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">تسجيل الخروج </a></li>
                    </ul>
                    @elseif(auth()->user()->userable_type == 'App\Models\Lawyer')
                    <ul class="nav-item-children sub-menu elementor-nav-menu--dropdown"  >
                        <li class="{{ Request::is('lawyer/dashboard') ? 'active' : '' }}"><a href="{{ route('lawyer.dashboard') }}">حسابي </a></li>
                        <li><a href="{{ route('lawyer.lawyer-tasks.list') }}">مهامي </a></li>
                        <li><a href="{{ route('lawyer.articles.list') }}">منشوراتي </a></li>
                        <li><a href="{{ route('lawyer.taxes.list') }}"> اقراراتي الضريبية</a></li>
                        <li><a href="{{ route('lawyer.sos.list') }}"> نداءات الاستغاثة</a></li>
                        <li><a href="{{ route('lawyer.ads.list') }}"> إعلاناتي</a></li>
                        <li><a href="{{ route('lawyer.rooms') }}">المحادثات </a></li>
                        <li><a href="{{ route('notifications.list') }}">الإشعارات</a></li>
                        <li class="{{ Request::is('balance') ? 'active' : '' }}"><a href="{{ route('balance') }}">رصيدي </a></li>
                        <li><a href="{{ route('lawyer.profile') }}">الإعدادات </a></li>
                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">تسجيل الخروج </a></li>
                    </ul>
                    @endif
                </li>
                @else
                <li><a class="careerfy-color careerfy-open-signup-tab" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">تسجيل الخروج</a></li>
                @endif

                {{-- <li class="logout-btn"><a class="careerfy-color careerfy-open-signin-tab" href="{{route('logout')}}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i></a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form> --}}
                @else
                <li class="btn1"><a class="careerfy-color careerfy-open-signin-tab" href="{{route('login')}}"><i class="fa fa-sign-in"></i></a></li>
                @if (Route::has('register'))
                <li class="btn2"><a class="careerfy-color careerfy-open-signup-tab" href="{{route('register')}}"><i class="fa fa-user-o"></i></a></a></li>
                @endif
                @endauth
            </ul>
            <div class="collapse navbar-collapse" id="careerfy-navbar-collapse-1">
                <ul class="navbar-nav">
                    <li  class="{{ Request::is('home') ? 'active' : '' }}"><a href="{{ route('home') }}">الرئيسية</a>

                    </li>
                    @if (count($alltodotasks))
                    <li  class="{{ Request::is('tasks') ? 'active' : '' }}"><a href="{{ route('tasks.list') }}">المهام القانونية</a>
                    @endif

                    </li>
                    @if (count($activelawyers))
                    <li  class="{{ Request::is('lawyers') ? 'active' : '' }}"><a href="{{ route('lawyers.list') }}">المحامين</a></li>
                    @endif

                    @if (count($activearticles))
                    <li  class="{{ Request::is('articles') ? 'active' : '' }}"><a href="{{ route('articles.list') }}">المنشورات</a></li>
                    @endif

                    @auth
                    @if (auth()->user()->userable_type == 'App\Models\Lawyer')
                    @if (count($allsos))
                    <li  class="{{ Request::is('distresses') ? 'active' : '' }}"><a href="{{ route('sos.list') }}">نداءات الاستغاثة</a></li>
                    @endif
                    @endif
                    @endauth
                   

                    <li  class="{{ Request::is('about-us') ? 'active' : '' }}"><a href="{{ route('about') }}">من نحن</a></li>

                    <li  class="{{ Request::is('contact-us') ? 'active' : '' }}"><a href="{{ route('contact') }}">اتصل بنا</a></li>
                </ul>
            </div>
        </nav>
    </aside>
    <aside class="col-md-2 col-xs-5 no-pd dsply-dsk">
        <div class="careerfy-btns-con">
        <div class="careerfy-right">
            <ul class="careerfy-user-section cs-acc-menu">
                @if (Route::has('login'))
                @guest
                <li><a class="careerfy-color careerfy-open-signin-tab" href="{{ route('register') }}">مستخدم جديد</a></li>
                <li><a class="careerfy-color careerfy-open-signup-tab" href="{{ route('login') }}">دخول</a></li>
                @endguest
                @endif
                @auth
                @if(\Auth::user()->userable_type == 'App\Models\Lawyer' || \Auth::user()->userable_type == 'App\Models\Client')
                <li class="jobsearch-usernotifics-menubtn menu-item menu-item-type-custom menu-item-object-custom ">
                    <a href="javascript:void(0);" class="elementor-item elementor-item-anchor"><i class="fa fa-bell-o" id="notifications-count"></i></a>
                    <div class="jobsearch-hdernotifics-listitms">
                        <div class="hdernotifics-title-con">
                            <span class="hder-notifics-count" id="inner-notifications-count" hidden></span>
                            <span class="hder-notifics-title">إشعارات</span>
                            <hr>
                        </div>
                        <div class="jobsearch-hdrnotifics-list" id="notifications-list">
                            <p id="no-notifications">لا يوجد إشعارات بعد</p>
                        </div>
                        <div class="hdernotifics-after-con">

                            <a href="{{ route('notifications.list') }}" class="hdernotifics-viewall-btn jobsearch-color" id="show-more-not" hidden>شاهد المزيد</a>
                        </div>
                    </div>
                </li>
                <li class="jobsearch-userdash-menumain menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children">
                    <a href="#" class="jobsearch-color elementor-item elementor-item-anchor active">حسابي</a>
                    @if(auth()->user()->userable_type == 'App\Models\Client')
                    <ul class="nav-item-children sub-menu elementor-nav-menu--dropdown"  >
                        <li class="{{ Request::is('client/dashboard') ? 'active' : '' }}"><a href="{{ route('client.dashboard') }}">حسابي </a></li>
                        <li><a href="{{ route('client.tasks.list') }}">طلبات المساعدة القانونية </a></li>
                        <li><a href="{{ route('client.consultations.list') }}">استشاراتي القانونية </a></li>
                        <li><a href="{{ route('client.ads.list') }}"> إعلاناتي</a></li>
                        <li><a href="{{ route('client.rooms') }}">المحادثات </a></li>
                        <li class="{{ Request::is('balance') ? 'active' : '' }}"><a href="{{ route('balance') }}">رصيدي </a></li>
                        <li><a href="{{ route('notifications.list') }}">الإشعارات </a></li>
                        <li><a href="{{ route('client.profile') }}">الإعدادات </a></li>
                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">تسجيل الخروج </a></li>
                    </ul>
                    @elseif(auth()->user()->userable_type == 'App\Models\Lawyer')
                    <ul class="nav-item-children sub-menu elementor-nav-menu--dropdown"  >
                        <li class="{{ Request::is('lawyer/dashboard') ? 'active' : '' }}"><a href="{{ route('lawyer.dashboard') }}">حسابي </a></li>
                        <li><a href="{{ route('lawyer.lawyer-tasks.list') }}">مهامي </a></li>
                        <li><a href="{{ route('lawyer.articles.list') }}">منشوراتي </a></li>
                        <li><a href="{{ route('lawyer.taxes.list') }}"> اقراراتي الضريبية</a></li>
                        <li><a href="{{ route('lawyer.sos.list') }}"> نداءات الاستغاثة</a></li>
                        <li><a href="{{ route('lawyer.ads.list') }}"> إعلاناتي</a></li>
                        <li><a href="{{ route('lawyer.rooms') }}">المحادثات </a></li>
                        <li><a href="{{ route('notifications.list') }}">الإشعارات</a></li>
                        <li class="{{ Request::is('balance') ? 'active' : '' }}"><a href="{{ route('balance') }}">رصيدي </a></li>
                        <li><a href="{{ route('lawyer.profile') }}">الإعدادات </a></li>
                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">تسجيل الخروج </a></li>
                    </ul>
                    @endif
                </li>
                @else
                <li><a class="careerfy-color careerfy-open-signup-tab" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">تسجيل الخروج</a></li>
                @endif
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                @endauth
            </ul>
            
        </div>
        </div>
    </aside>
</div>

<!-- Header -->

@section('script')
<script>
    jQuery(document).ready(function() {
        jQuery(".jobsearch-usernotifics-menubtn a").mouseenter(function() {
            jQuery(".jobsearch-hdernotifics-listitms").css("opacity", "1");
            jQuery(".jobsearch-hdernotifics-listitms").css("visibility", "visible");

        })
        jQuery(".jobsearch-usernotifics-menubtn a").mouseleave(function() {
            jQuery(".jobsearch-hdernotifics-listitms").css("opacity", "0");
            jQuery(".jobsearch-hdernotifics-listitms").css("visibility", "hidden");

        })

        jQuery(".jobsearch-hdernotifics-listitms").mouseenter(function() {
            jQuery(".jobsearch-hdernotifics-listitms").css("opacity", "1");
            jQuery(".jobsearch-hdernotifics-listitms").css("visibility", "visible");

        })

        jQuery(".jobsearch-hdernotifics-listitms").mouseleave(function() {
            jQuery(".jobsearch-hdernotifics-listitms").css("opacity", "0");
            jQuery(".jobsearch-hdernotifics-listitms").css("visibility", "hidden");

        })

    });



    jQuery(document).ready(function() {
        jQuery(".jobsearch-userdash-menumain a.jobsearch-color").mouseenter(function() {
            jQuery(".jobsearch-userdash-menumain .sub-menu").css("opacity", "1");
            jQuery(".jobsearch-userdash-menumain .sub-menu").css("visibility", "visible");

        })
        jQuery(".jobsearch-userdash-menumain a.jobsearch-color").mouseleave(function() {
            jQuery(".jobsearch-userdash-menumain .sub-menu").css("opacity", "0");
            jQuery(".jobsearch-userdash-menumain .sub-menu").css("visibility", "hidden");

        })

        jQuery(".jobsearch-userdash-menumain .sub-menu").mouseenter(function() {
            jQuery(".jobsearch-userdash-menumain .sub-menu").css("opacity", "1");
            jQuery(".jobsearch-userdash-menumain .sub-menu").css("visibility", "visible");

        })

        jQuery(".jobsearch-userdash-menumain .sub-menu").mouseleave(function() {
            jQuery(".jobsearch-userdash-menumain .sub-menu").css("opacity", "0");
            jQuery(".jobsearch-userdash-menumain .sub-menu").css("visibility", "hidden");

        })

    });
</script>
@endsection