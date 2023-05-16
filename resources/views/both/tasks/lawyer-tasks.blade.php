@extends('layouts.app')

@section('content')
<!-- SubHeader -->
<div class="careerfy-subheader careerfy-subheader-with-bg">
    <span class="careerfy-banner-transparent"></span>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="careerfy-page-title">
                    <h1>مهامي القانونية</h1>
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
                        <div id="dashboard-tab-stats" class="main-tab-section">
                            <div class="careerfy-employer-dasboard">
                                <div id="careerfy-notification-section" class="careerfy-employer-box-section careerfy-dashnotifics-bars">
                                    <div class="careerfy-profile-title">
                                        <h2> مهــامي</h2>

                                    </div>

                                    <div class="careerfy-main-section articles-section gray-bg ">

                                        <div class="row">

                                            <!-- Blog -->
                                            <div class="careerfy-blog careerfy-blog-grid">

                                                <div class="col-md-4">
                                                    <a href="{{ url('lawyer/tasks') }}">
                                                        <div class="service-box">

                                                            <h4><i class="careerfy-icon careerfy-briefcase"></i></h4>
                                                            <h4>طلباتي من الغير</h4>
                                                        </div>
                                                    </a>
                                                </div>

                                                <div class="col-md-4">
                                                    <a href="{{ url('lawyer/others-tasks') }}">
                                                        <div class="service-box golden-bg">

                                                            <h4><i class="careerfy-icon careerfy-resume-1"></i></h4>
                                                            <h4>مهام لحساب الغير</h4>
                                                        </div>
                                                    </a>
                                                </div>


                                                <div class="col-md-4">
                                                    <a href="{{ url('lawyer/offers-tasks') }}">
                                                        <div class="service-box">

                                                            <h4><i class="careerfy-icon careerfy-resume-document"></i></h4>
                                                            <h4>عروض الوظائف</h4>
                                                        </div>
                                                    </a>
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
    </div>
</div>
   
@endsection

@section('script')
<script>
$('li > a').click(function() {
    $('li').removeClass();
    $(this).parent().addClass('active');
});
</script>
@endsection
