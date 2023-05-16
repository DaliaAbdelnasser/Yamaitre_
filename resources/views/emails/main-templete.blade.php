<!doctype html>
<html dir="rtl">

<head>
    <meta charset="utf-8">
    <title>Ya Maitre</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">


    <style>
        a,
        a:hover,
        a:visited,
        a:focus,
        a:active {
            outline: none !important;
        }
        
        .color_white {
            color: #fff;
        }
        
        .bg_white {
            background: #fff !important;
        }
        
        .bg_gray {
            background: #0c4e8c
        }
        
        .bg_orange {
            background: #f69e3c;
            border-bottom: 30px solid #0c4e8c;
        }
        
        .email-box {
            background: #fff;
            border-bottom: 30px solid #0c4e8c;
            min-height: 400px;
            padding: 25px;
            margin-top: -50px
        }
        
        .bg_orange.orders {
            padding-top: 0 !important
        }
        
        .horizontal2 {
            display: block;
            padding-left: 0;
            margin: 20px auto 20px;
            width: 100%;
        }
        
        .horizontal2 li a {
            color: white;
            font-size: 15px;
        }
        
        footer h4 a {
            color: #0c4e8c !important;
            margin-bottom: 0
        }
        
        footer h4 {
            margin-bottom: 0;
            margin-top: 5px
        }
        
        .btn-gry {
            font-size: 15px;
            font-weight: normal;
            line-height: 30px;
            border-radius: 0!important;
            margin-right: 10px;
            background: #5f6062 !important;
            color: #fff !important;
            padding: 6px 16px
        }
        
        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 14px;
            line-height: 1.42857143;
            color: #333;
            background-color: #fff;
            margin: 0;
        }
    </style>



</head>

<body>
    <header>
        <div class=" bg_white text-center" style=" background: #243a4b !important; text-align:center">
            <div class="container" style="  margin-right: auto; margin-left: auto; max-width:600px; width:100%">
                <div class="row" style="">
                    <div class="col-md-12" style="width:100%;">
                        <div class=" p-t-50 p-b-50" style="padding-top:30px; padding-bottom:50px">
                            <a href="index.html" style="outline:none"><img width="100" src="{{ asset('uploads/logo.png') }}"></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </header>


    
    <div class="contents">
        <div class="bg_gray" style="background:#dcb76b">
            <div class="container" style=" margin-right: auto; margin-left: auto; width:100%; max-width:600px">
                <div class="row" style=" ">
                    <div class="col-md-12 col-sm-12 col-xs-12" style="width:100%; ">
                        <div class="p-t-30 p-b-80" style="padding-top:20px; padding-bottom:70px">
                            <h1 class="color_white" style="font-size:40px; color:#fff; text-align: center">مرحبا بك في تطبيق يامتر</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @yield('content')

    </div>


    <div class="clearfix" style="clear:both !important"></div>

    <footer class="bg_white text-center p-b-30" style="background:#fff; text-align:center; padding-bottom:30px; width:100%">
        <div class="container" style=" margin-right: auto; margin-left: auto; width:100%; max-width:600px">
            <div class="row" style=" ">
                <div class="clearfix" style="clear:both !important"></div>
                <h4 style="margin-bottom:0; margin-top:15px">حقوق النشر &copy;
                    <a href="https://yamaitre.com" target="_blank" style="color:#0c4e8c !important; text-decoration:none; margin-bottom:0"> يامتر </a></h4>
            </div>
        </div>

    </footer>

</body>

</html>