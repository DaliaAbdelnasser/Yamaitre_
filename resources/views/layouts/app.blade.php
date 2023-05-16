<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="{{ asset('uploads/logo.png') }}" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @section('meta')
    <title>{{ config('app.name', 'Laravel') }}</title>
    @show    

    <!-- Css -->
    <link href="{{ asset('frontend-assets/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend-assets/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend-assets/css/flaticon.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend-assets/css/slick-slider.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend-assets/plugin-css/fancybox.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend-assets/plugin-css/plugin.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend-assets/css/color.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend-assets/style.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend-assets/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend-assets/css/homepage-five.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @auth
    <!-- firebase integration started -->
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
    <!-- Firebase App is always required and must be first -->
    <!--<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js"></script>-->

    <!-- Add additional services that you want to use -->
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-database.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-firestore.js"></script>
    <!--<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js"></script>-->
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-functions.js"></script>

    <!-- firebase integration end -->

    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-analytics.js"></script>
    @endauth
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">

    @stack('styles')
</head>
<body>
    <!-- header -->
    <div class="careerfy-wrapper">    
        <header id="careerfy-header" class="careerfy-header-one">
            <div class="container">
                @include('partials._header')
            </div>
        </div>
    </div>
    <!-- page content  -->
    @yield('content')
    <!-- end:page content -->
    <!-- footer -->
    <div>
        @include('partials._footer')
    </div>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{ asset('frontend-assets/script/jquery.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

    @if (Request::is('register'))
    <script src="{{ asset('js/register.js') }}"></script>
    @endif
    @if (Request::is('login'))
    <script src="{{ asset('js/login.js') }}"></script>
    @endif
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/myscript.js') }}"></script>
    <script src="{{ asset('js/myscript.js') }}"></script>
    <script src="{{ asset('frontend-assets/script/bootstrap.js') }}"></script>
    <script src="{{ asset('frontend-assets/script/slick-slider.js') }}"></script>
    <script src="{{ asset('frontend-assets/plugin-script/fancybox.pack.js') }}"></script>
    <script src="{{ asset('frontend-assets/plugin-script/isotope.min.js') }}"></script>
    <script src="{{ asset('frontend-assets/plugin-script/functions.js') }}"></script>    
 
    @auth
    <script>
    // Your web app's Firebase configuration
    var firebaseConfig = {
        apiKey: "AIzaSyCDQolBRZmshQCJRYwjP8HgG3e7PZiFOm4",
        authDomain: "yamaitre-fc7ea.firebaseapp.com",
        databaseURL: "https://yamaitre-fc7ea-default-rtdb.firebaseio.com",
        projectId: "yamaitre-fc7ea",
        storageBucket: "yamaitre-fc7ea.appspot.com",
        messagingSenderId: "609550492956",
        appId: "1:609550492956:web:83144310ad57ae91c146d9",
        measurementId: "G-KZWNDCMXST"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    //firebase.analytics();
    const messaging = firebase.messaging();
        messaging
    .requestPermission()
    .then(function () {
    //MsgElem.innerHTML = "Notification permission granted." 
        console.log("Notification permission granted.");

        // get the token in the form of promise
        return messaging.getToken()
    })
    .then(function(token) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{ route("store.token") }}',
            type: 'POST',
            data: {
                token: token
            },
            dataType: 'JSON',
            success: function (token) {
                // alert(response);

            },
            error: function (error) {
                // alert(error);
            },
        });
    // print the token on the HTML page     
    // console.log(token);
    
    })
    .catch(function (err) {
        console.log("Unable to get permission to notify.", err);
    });

    var count = 0;
    messaging.onMessage(function(payload) {
        count += 1;
    
        const currentDate = new Date();
        const options = { weekday: 'long', year: 'numeric', month: 'short', day: 'numeric' };        
        // console.log(currentDate.toLocaleDateString('ar-EG', options))

        $('#notifications-list').append(`
            <div class="jobsearch-notification-item">
                <div class="notificate-item-inner">
                    <strong><span class="notific-onlmsg-con">`+payload.notification.body+`</span></strong>
                    <span class="notific-item-datetime">`+currentDate.toLocaleDateString('ar-EG', options)+`</span>
                </div>
            </div>
        `);
        // console.log(count);
        // $('#notifications-count').append(`<span class="hderbell-notifics-count">`+count+`</span>`);
        document.getElementById("inner-notifications-count").hidden=false;
        document.getElementById("show-more-not").hidden=false;
        document.getElementById("no-notifications").hidden=true;
        document.getElementById('notifications-count').innerHTML = `<span class="hderbell-notifics-count">`+count+`</span>`;
        document.getElementById('inner-notifications-count').innerHTML = `<small>`+count+`</small> جديد`;
        
        // console.log(payload);
        // alert(payload);
        var notify;
        notify = new Notification(payload.notification.title,{
            body: payload.notification.body,
            icon: payload.notification.icon,
            tag: "Dummy"
        });
        // console.log(payload.notification);   
        
    });

    var database = firebase.database().ref().child("/users/");
    
    database.on('value', function(snapshot) {
        renderUI(snapshot.val());
    });

    // On child added to db
    database.on('child_added', function(data) {
        // console.log("Comming");
        if(Notification.permission!=='default'){
            var notify;
            
            notify= new Notification('CodeWife - '+data.val().username,{
                'body': data.val().message,
                'icon': 'bell.png',
                'tag': data.getKey()
            });
            notify.onclick = function(){
                alert(this.tag);
            }
        }else{
            alert('Please allow the notification first');
        }
    });

    self.addEventListener('notificationclick', function(event) {       
        event.notification.close();
    });
    </script>
    @endauth
    <script src="{{ asset('frontend-assets/script/functions.js') }}"></script>
    <script src="{{ asset('frontend-assets/script/fastselect.standalone.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $('.multipleSelect').fastselect();
    </script>

    @auth 
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{ route("update.transaction") }}',
            type: 'GET',
            dataType: 'JSON',
            success: function (success) {
                console.log(success);
            },
            error: function (error) {
            },
        });
    </script>
    @endauth

    @yield('script')
    
    <script>
        jQuery(document).ready(function() {
            $('#collapse-1').attr('style', '');
            $('#collapse-1').addClass('show in');
            $('#accordion-faq-1 .panel-title a').removeClass('collapsed');
            $(".main-banner").owlCarousel({
                rtl:true,
                items: 1,
                touchDrag: false,
                mouseDrag: false,
                autoplay: true,
                loop: true,
                autoplayTimeout: 7000,
                autoWidth: false,
                animateOut: 'fadeOut',
                dots: false,
            });
            $(".article-banner").owlCarousel({
                rtl:true,
                items: 1,
                touchDrag: false,
                mouseDrag: false,
                autoplay: true,
                loop: true,
                autoplayTimeout: 7000,
                autoWidth: false,
                dots: false,
            });



            ImgUpload();
            jQuery('.btny').on('click', function() {
                jQuery('.filey').trigger('click');
            });
            
            $('.filey').on('change', function() {
                var fileName = jQuery(this)[0].files[0].name;
                jQuery('#filey-name').val(fileName);
            });
        });

        function ImgUpload() {
            var imgWrap = "";
            var imgArray = [];

            $('.upload__inputfile').each(function() {
                $(this).on('change', function(e) {
                    imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
                    var maxLength = $(this).attr('data-max_length');

                    var files = e.target.files;
                    var filesArr = Array.prototype.slice.call(files);
                    var iterator = 0;
                    filesArr.forEach(function(f, index) {

                        if (!f.type.match('image.*')) {
                            return;
                        }

                        if (imgArray.length > maxLength) {
                            return false
                        } else {
                            var len = 0;
                            for (var i = 0; i < imgArray.length; i++) {
                                if (imgArray[i] !== undefined) {
                                    len++;
                                }
                            }
                            if (len > maxLength) {
                                return false;
                            } else {
                                imgArray.push(f);

                                var reader = new FileReader();
                                reader.onload = function(e) {
                                    var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                                    imgWrap.append(html);
                                    iterator++;
                                }
                                reader.readAsDataURL(f);
                            }
                        }
                    });
                });
            });

            $('body').on('click', ".upload__img-close", function(e) {
                var file = $(this).parent().data("file");
                for (var i = 0; i < imgArray.length; i++) {
                    if (imgArray[i].name === file) {
                        imgArray.splice(i, 1);
                        break;
                    }
                }
                $(this).parent().parent().remove();
            });
        }
    </script>

    <script>
        $( function() {
            $('.datepi').datepicker({
                dateFormat: 'yy-mm-dd'
            });



            // $('.datepiedit').datepicker({
            //     onChange: function () {
            //         $('.datepiedit').text(this.value);
            //     }
            // });
            // $('.datepi').select(function() {
            //     $('.datepi').val() = " ";
            //     var val = $(this).val();
            //     $('.datepi').text(val);
            //     });
            // $('.datepi').change(function() {
            //     $('.datepi').text(" ");
            //     alert("");
            //     var val = $(this).val();
            //     $('.datepi').text(val);
            // });
                // "option", "dateFormat", 'yy-mm-dd'
        });
    </script>
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




</body>
</html>
