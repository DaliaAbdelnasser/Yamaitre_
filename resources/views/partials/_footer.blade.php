<!-- Footer -->
<footer id="careerfy-footer" class="careerfy-footer-one">
    <div class="container">
        <!-- Footer Widget -->
        <div class="careerfy-footer-widget">
            <div class="row">
                <aside class="widget col-md-3 widget_contact_info">
                    <div class="widget_contact_wrap">
                        <a class="careerfy-footer-logo" href="{{ route('home') }}"><img src="{{ asset('uploads/logo-light.png') }}" alt=""></a>
                        <p>{{ $footer_description }}</p>

                    </div>
                </aside>
                <aside class="widget col-md-3 widget_nav_manu">
                    <div class="footer-widget-title">
                        <h2>القائمة الرئيسية</h2>
                    </div>
                    <ul>
                        <li><a href="{{ route('home') }}">الرئيسية</a></li>
                        @if (count($alltodotasks))
                        <li><a href="{{ route('tasks.list') }}">المهام القانونية</a></li>
                        @endif
                        @if (count($alllawyers))
                        <li><a href="{{ route('lawyers.list') }}">المحامين</a></li>
                        @endif
                        @if (count($allarticles))
                        <li><a href="{{ route('articles.list') }}">المنشورات</a></li>
                        @endif
                        @auth
                        @if (auth()->user()->userable_type == 'App\Models\Lawyer')
                        @if (count($allsos))
                        <li><a href="{{ route('sos.list') }}">نداءات الاستغاثة</a></li>
                        @endif
                        @endif
                        @endauth
                    </ul>
                </aside>
                <aside class="widget col-md-3 widget_nav_manu">
                    <div class="footer-widget-title">
                        <h2>عن يامتر</h2>
                    </div>
                    <ul>
                        <li><a href="{{ route('about') }}">من نحن</a></li>
                        <li><a href="{{ route('contact') }}">اتصل بنا</a></li>
                        <li><a href="{{ route('terms') }}">شروط الاستخدام</a></li>
                        <li><a href="{{ route('statement') }}">اتفاقية المعاملة القانونية</a></li>
                        <li><a href="{{ route('policy')}}">سياسة الخصوصية</a></li>
                        <li><a href="{{ route('help')}}">الأسئلة الشائعة</a></li>
                    </ul>
                </aside>
                <aside class="widget col-md-3 ">
                    <div class="footer-widget-title">
                        <h2>تواصل معنا</h2>
                    </div>
                    <p class="cnct-item"><i class="fa fa-map-marker"></i><span>{{ $site_address }}</span></p>
                    <p class="cnct-item"><i class="fa fa-phone"></i> <span>{{ $site_phone }}</span></p>
                    <p class="cnct-item"><i class="fa fa-phone"></i> <span>01145612792</span></p>
                    <p class="cnct-item"><i class="fa fa-envelope"></i> <span><a href="mailto:{{ $site_email }}">{{ $site_email }}</a></span></p>
                    <ul class="careerfy-social-network">
                        <li>
                            <a href="{{$facebook}}" class="careerfy-bgcolorhover fa fa-facebook" target="_blank"></a>
                        </li>
                        <li>
                            <a href="{{$twitter}}" class="careerfy-bgcolorhover fa fa-twitter" target="_blank"></a>
                        </li>
                        <li>
                            <a href="{{$instagram}}" class="careerfy-bgcolorhover fa fa-instagram" target="_blank"></a>
                        </li>
                        <li>
                            <a href="{{$youtube}}" class="careerfy-bgcolorhover cs-yout" target="_blank"><i class="fa fa-youtube-play"></i></a>
                        </li>
                        <li>
                            <a href="{{$linkedin}}" class="careerfy-bgcolorhover fa fa-linkedin" target="_blank"></a>
                        </li>
 
                    </ul>
                </aside>
            </div>
        </div>
        <!-- Footer Widget -->
        <!-- CopyRight -->
        <div class="careerfy-copyright">
            <p>Copyrights © 2023 All Rights Reserved by Yamaitre. Powered By <a href="https://PrimaxCode.com" target="_blank" class="careerfy-color" style="color: #dcb76b;">PrimaxCode</a></p>

        </div>
        <!-- CopyRight -->
    </div>
</footer>
<!-- Footer -->