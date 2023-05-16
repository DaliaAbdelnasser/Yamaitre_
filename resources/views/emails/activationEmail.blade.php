@extends('emails.main-templete')

@section('content')
<div class="orders bg_orange" style="background:#243a4b;border-bottom:30px solid #dcb76b; padding:0 5px !important">
    <div class="container" style=" margin-right: auto; margin-left: auto; width:100%; max-width:600px">
        <div class="row" style="">
            <div class="col-md-12 col-sm-12 col-xs-12" style="width:100%; ">
                <div class="email-box clearfix" style="clear:both !important; background:#fefefe; position:relative; border-bottom:30px solid #dcb76b; min-height:250px; padding:25px; margin-top:-50px">
                    <div class="mail-bg" style="background:url(https://amyalexpress.com/admin_assets/img/mail-bg.png); background-position:bottom right; background-repeat:no-repeat; width: 231px; height: 99px; position: absolute; bottom: 0px; right: 0;"></div>
                    <h4 style="text-align: right; direction:rtl;">مرحبا {{ $name }} في تطبيق يا متر. </h4>
                    <p style="text-align: right;">لقد تم تفعيل حسابك الان، يمكنك الان اضافة مهام الى حسابك</p>
                    <p style="text-align: right;">شكرا لاستخدامك تطبيق يامتر</p>
                    <p style="text-align: right;">فريق عمل يامتر</p>
                </div>
                <div class="clearfix" style="clear:both !important"></div>
            </div>
        </div>
    </div>
</div>
@endsection