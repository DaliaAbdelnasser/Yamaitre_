@extends('layouts.app')

@section('content')
<!-- SubHeader -->
<div class="careerfy-subheader careerfy-subheader-with-bg">
    <span class="careerfy-banner-transparent"></span>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="careerfy-page-title">
                    <h1>إعلانــــاتي</h1>
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
                    <div class="careerfy-typo-wrap">
                        <div class="careerfy-employer-dasboard">
                        <div id="dashboard-tab-stats" class="main-tab-section">
                            <div class="careerfy-employer-dasboard">
                                <div class="text-center" >@include('flash::message')</div>
                                @if ($errors->any())
                                @foreach ($errors->all() as $key => $error)
                                    <div class="alert alert-danger text-center" role="alert">{{ $error }}</div>
                                @endforeach
                                @endif
                                <div id="careerfy-notification-section" class="careerfy-employer-box-section careerfy-dashnotifics-bars">
                                    <div class="careerfy-profile-title">
                                        <h2> إعلاناتي</h2>
                                        <a href="#" data-toggle="modal" data-target="#addads" class="careerfy-static-btn careerfy-bgcolor m-t-20 m-b-20">  طلب إعلان</a>

                                    </div>

                                    <div class="careerfy-main-section articles-section gray-bg ">

                                        <div class="row">

                                            <!-- Blog -->
                                            <div class="careerfy-blog careerfy-blog-grid">
                                                <ul class="row">
                                                    <div class="col-md-12">
                                                        @include('partials._my-ads')
                                                    </div>
                                                </ul>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                                <div id="careerfy-notification-section" class="careerfy-employer-box-section careerfy-dashnotifics-bars">
                                    <div class="careerfy-profile-title">
                                        <h2> إعلاناتي المعلقة</h2>
                                    </div>

                                    <div class="careerfy-main-section articles-section gray-bg ">

                                        <div class="row">
                                            <!-- Blog -->
                                            <div class="careerfy-blog careerfy-blog-grid">
                                                <ul class="row">
                                                    @if($data['pending_announcements']->first() == null)
                                                        <p style="margin-right: 269px; margin-top: 35px; font-size: 20px">لا يوجد إعلانات معلّقة بعد</p>
                                                    @endif
                                                    @foreach($data['pending_announcements'] as $announce)
                                                    <li class="col-md-6" >
                                                        <div class="careerfy-table-layer tasks-listing">
                                                            <div class="careerfy-featured-listing-text careerfy-joblisting-classic-wrap" style="max-height:89.5px;">
                                                                <p class="m-t-10 task-stats">
                                                                    <strong> التاريخ: <small>{{ $announce->created_at ?? 'ديسمبر, 05, 2020'}} </small> </strong>
                                                                    <strong> الصفحة : <small> {{ $data['places'][$announce->place] ?? $announce->place}} </small></strong>
                                                                </p>
                                                                <div class="banner-box">
                                                                    <!-- <img src="{{ asset('uploads/' . $announce->image) }}"> -->
                                                                
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                                <div id="careerfy-notification-section" class="careerfy-employer-box-section careerfy-dashnotifics-bars">
                                    <div class="careerfy-profile-title">
                                        <h2> إعلاناتي التي تم نشرها</h2>
                                    </div>

                                    <div class="careerfy-main-section articles-section gray-bg ">

                                        <div class="row">
                                            <!-- Blog -->
                                            <div class="careerfy-blog careerfy-blog-grid">
                                                <ul class="row">
                                                    @if($data['published_announcements']->first() == null)
                                                        <p style="margin-right: 269px; margin-top: 35px; font-size: 20px">لا يوجد إعلانات منشورة بعد</p>
                                                    @endif
                                                    @foreach($data['published_announcements'] as $announce)
                                                    <li class="col-md-6">
                                                        <div class="careerfy-table-layer tasks-listing">
                                                            <div class="careerfy-featured-listing-text careerfy-joblisting-classic-wrap">
                                                                <p class="m-t-10 task-stats">
                                                                    <strong> التكلفة : <small> {{ $announce->price }} جنيه </small></strong>
                                                                    <strong> تاريخ النشر: <small>{{ $announce->created_at ?? 'ديسمبر, 05, 2020'}} </small> </strong>
                                                                    <strong> تاريخ الإنتهاء: <small>{{ $announce->created_at->addDays($announce->period) ?? 'ديسمبر, 05, 2020'}} </small> </strong>
                                                                    <strong> الصفحة : <small> {{ $data['places'][$announce->place] ?? $announce->place}} </small></strong>
                                                                    <strong> المدة : <small> {{ $announce->period }} أيام </small></strong>
                                                                </p>
                                                                <div class="banner-box">
                                                                    <img src="{{ asset('uploads/' . $announce->image) }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                                <div id="careerfy-notification-section" class="careerfy-employer-box-section careerfy-dashnotifics-bars">
                                    <div class="careerfy-profile-title">
                                        <h2> إعلاناتي المنتهية</h2>
                                    </div>
                                    <div class="careerfy-main-section articles-section gray-bg ">

                                        <div class="row">
                                            <!-- Blog -->
                                            <div class="careerfy-blog careerfy-blog-grid">
                                                <ul class="row">
                                                    @if($data['completed_announcements']->first() == null)
                                                        <p style="margin-right: 269px; margin-top: 35px; font-size: 20px">لا يوجد إعلانات منتهية بعد</p>
                                                    @endif
                                                    @foreach($data['completed_announcements'] as $announce)
                                                    <li class="col-md-6">
                                                        <div class="careerfy-table-layer tasks-listing">
                                                            <div class="careerfy-featured-listing-text careerfy-joblisting-classic-wrap">
                                                                <p class="m-t-10 task-stats">
                                                                    <strong> التكلفة : <small> {{ $announce->price }} جنيه </small></strong>
                                                                    <strong> تاريخ النشر : <small>{{ $announce->created_at ?? 'ديسمبر, 05, 2020'}} </small> </strong>
                                                                    <strong> تاريخ الإنتهاء : <small>{{ $announce->updated_at ?? 'ديسمبر, 05, 2020'}} </small> </strong>
                                                                    <strong> الصفحة : <small> {{ $data['places'][$announce->place] ?? $announce->place}} </small></strong>
                                                                    <strong> المدة : <small> {{ $announce->period }} أيام </small></strong>
                                                                </p>
                                                                <div class="banner-box">
                                                                    <img src="{{ asset('uploads/' . $announce->image) }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                        @include('partials._pagination', ['records' => $data['announcements']])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="addads" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">طلب إعلان</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            @if(auth()->user()->userable_type == 'App\Models\Lawyer' && auth()->user()->userable->status == 0)
            <div class="modal-body">
                    <div class="jobsearch-filter-responsive-wrap job-alerts-sec">
                        <div class="jobsearch-search-filter-wrap jobsearch-without-toggle jobsearch-add-padding">
                            <div class="job-alert-box job-alert job-alert-container-top">
                                <div class="alerts-fields">
                                    <p>نأسف لذلك، ولكن لم يتم تفعيل حسابك بعد<br>سوف تصلك رسالة إلى البريد الإلكتروني الخاص بك قريبا عند تفعيل حسابك.<p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button " class="btn btn-secondary " data-dismiss="modal">إلغاء</button>
                </div>
            @else
            @if(auth()->user()->userable_type == 'App\Models\Lawyer')
            {!! Form::open(['route' => ['lawyer.ads.store'], 'method' => 'POST']) !!}
            @elseif(auth()->user()->userable_type == 'App\Models\Client')
            {!! Form::open(['route' => ['client.ads.store'], 'method' => 'POST']) !!}
            @endif
            <div class="modal-body">
                    <div class="jobsearch-filter-responsive-wrap job-alerts-sec">
                        <div class="jobsearch-search-filter-wrap jobsearch-without-toggle jobsearch-add-padding">
                            <div class="job-alert-box job-alert job-alert-container-top">
                                <div class="alerts-fields">
                                    <div class="form-group">
                                    {!! Form::label('place', 'حدد صفحة الإعلان :', [ 'class' => 'form-label']) !!}

                                    {!! Form::select('place', $data['places'],null,['class'=>'form-control', 'placeholder'=>'صفحة الإعلان']) !!}
                                    
                                    </div>
                                    @error('place')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                    @if(auth()->user()->accept_terms < 2)
                                    <div class="form-group">
                                        <p>يجب الموافقة على <span><a href="{{ route('terms') }}">الشروط والأحكام</a></span> حتى يتم قبول طلبك</p>
                                    {!! Form::checkbox('accept_terms', true, null, ['id' => 'accept_terms']) !!} 
                                    {!! Form::label('accept_terms', ' أوافق على الشروط و الأحكام ') !!}    
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                {!! Form::button('إلغاء', ['class' => 'btn btn-secondary', 'data-dismiss' => "modal"]) !!}
                {!! Form::submit('طلب الإعلان', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
            @endif
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    jQuery(document).ready(function() {
            jQuery(".jobsearch-usernotifics-menubtn a ").mouseenter(function() {
                jQuery(".jobsearch-hdernotifics-listitms ").css("opacity ", "1 ");
                jQuery(".jobsearch-hdernotifics-listitms ").css("visibility ", "visible ");

            })
            jQuery(".jobsearch-usernotifics-menubtn a ").mouseleave(function() {
                jQuery(".jobsearch-hdernotifics-listitms ").css("opacity ", "0 ");
                jQuery(".jobsearch-hdernotifics-listitms ").css("visibility ", "hidden ");

            })

            jQuery(".jobsearch-hdernotifics-listitms ").mouseenter(function() {
                jQuery(".jobsearch-hdernotifics-listitms ").css("opacity ", "1 ");
                jQuery(".jobsearch-hdernotifics-listitms ").css("visibility ", "visible ");

            })

            jQuery(".jobsearch-hdernotifics-listitms ").mouseleave(function() {
                jQuery(".jobsearch-hdernotifics-listitms ").css("opacity ", "0 ");
                jQuery(".jobsearch-hdernotifics-listitms ").css("visibility ", "hidden ");

            })

    });



    jQuery(document).ready(function() {
        jQuery(".jobsearch-userdash-menumain a.jobsearch-color ").mouseenter(function() {
            jQuery(".jobsearch-userdash-menumain .sub-menu ").css("opacity ", "1 ");
            jQuery(".jobsearch-userdash-menumain .sub-menu ").css("visibility ", "visible ");

        })
        jQuery(".jobsearch-userdash-menumain a.jobsearch-color ").mouseleave(function() {
            jQuery(".jobsearch-userdash-menumain .sub-menu ").css("opacity ", "0 ");
            jQuery(".jobsearch-userdash-menumain .sub-menu ").css("visibility ", "hidden ");

        })

        jQuery(".jobsearch-userdash-menumain .sub-menu ").mouseenter(function() {
            jQuery(".jobsearch-userdash-menumain .sub-menu ").css("opacity ", "1 ");
            jQuery(".jobsearch-userdash-menumain .sub-menu ").css("visibility ", "visible ");

        })

        jQuery(".jobsearch-userdash-menumain .sub-menu ").mouseleave(function() {
            jQuery(".jobsearch-userdash-menumain .sub-menu ").css("opacity ", "0 ");
            jQuery(".jobsearch-userdash-menumain .sub-menu ").css("visibility ", "hidden ");

        })

    });
</script>

<!-- <script>
    // edit variables
    const btn_edit_task = document.getElementById('edit-task-btn');
    
    const input_title_edit = document.getElementById('title-input-edit');
    const input_court_edit = document.getElementById('court-input-edit');
    const input_gov_edit = document.getElementById('gov-input-edit');
    const input_date_edit = document.getElementById('date-input-edit');
    const input_price_edit = document.getElementById('price-input-edit');
    const input_desc_edit = document.getElementById('desc-input-edit');

    var task_id;
    const editBtns = document.querySelectorAll('.edit-btn');
    editBtns.forEach(getMissionId);
    function  getMissionId(item) {
        item.addEventListener('click', function (e){
            e.preventDefault();
            var taskId;
            // alert(this.getAttribute('data-target').match(/\d+/)[0]);
            var taskId = this.getAttribute('data-target').match(/\d+/)[0];
            task_id = taskId;
            // task_id.push(taskId);

        });
    }

    // console.log(task_id);

    document.getElementById('edit-task-btn-'+task_id).addEventListener('click', function(e){
        alert("ay 7aga"+task_id);
        e.preventDefault();
        axios.post('edit-task/', {
            title: input_title_edit.value,
            governorates: input_gov_edit.value,
            court: input_court_edit.value,
            price: input_price_edit.value,
            starting_date: input_date_edit.value,
            description: input_desc_edit.value,
            taskid: task_id,
        })
        .then(function (response) {
            document.getElementById("successMsg-edit-task").className = "alert alert-success";
            document.getElementById("successMsg-edit-task").innerHTML = "لقد تم تعديل مهمتك بنجاح";

            document.getElementById(task_id.value).innerHTML  = task_id.value;
            document.getElementById('task-title-edited').innerHTML =  input_title_edit.value;
            document.getElementById('task-price-edited').innerHTML =  input_price_edit.value +" جنيه مصري";
            document.getElementById('task-description-edited').innerHTML =  input_desc_edit.value;
            document.getElementById('task-gov-edited').innerHTML =  input_gov_edit.value;
            console.log(response);
        })
        .catch(function (error) {
            console.log(error.response.data.errors);
            document.getElementById("errorMsgCourt").innerHTML = error.response.data.errors.court ?? '';
            document.getElementById("errorMsgCourt").className = "text-danger";

            document.getElementById("errorMsgGov").innerHTML = error.response.data.errors.governorates ?? '';
            document.getElementById("errorMsgGov").className = "text-danger";

            document.getElementById("errorMsgDate").innerHTML = error.response.data.errors.starting_date ?? '';
            document.getElementById("errorMsgDate").className = "text-danger";

            document.getElementById("errorMsgDesc").innerHTML = error.response.data.errors.description ?? '';
            document.getElementById("errorMsgDesc").className = "text-danger";

            document.getElementById("errorMsgTitle").innerHTML = error.response.data.errors.title ?? '';
            document.getElementById("errorMsgTitle").className = "text-danger";

            document.getElementById("errorMsgPrice").innerHTML = error.response.data.errors.price ?? '';
            document.getElementById("errorMsgPrice").className = "text-danger";

        });
    });

</script> -->

<script>
    // add variables
    const btn_submit = document.getElementById('submit-btn');
    const input_title = document.getElementById('title-input');
    const input_court = document.getElementById('court-input');
    const input_gov = document.getElementById('gov-input');
    const input_date = document.getElementById('date-input');
    const input_price = document.getElementById('price-input');
    const input_desc = document.getElementById('desc-input');

    btn_submit.addEventListener('click', function(e){
        e.preventDefault();
        axios.post('tasks', {
            title: input_title.value,
            governorates: input_gov.value,
            court: input_court.value,
            price: input_price.value,
            starting_date: input_date.value,
            description: input_desc.value,
        })
        .then(function (response) {
            document.getElementById("successMsg").className = "alert alert-success";
            document.getElementById("successMsg").innerHTML = "لقد تم نشر مهمتك بنجاح";

            document.getElementById("new-task-added").hidden = false;
            document.getElementById('task-title-added').innerHTML =  input_title.value;
            document.getElementById('task-price-added').innerHTML =  " " + input_price.value +" جنيه مصري";
            document.getElementById('task-description-added').innerHTML =  input_desc.value;
            document.getElementById('task-gov-added').innerHTML =  input_gov.value;
            var dt = new Date(input_date.value);
            document.getElementById('task-date-added').innerHTML =  dt.toString();

            console.log(response);
        })
        .catch(function (error) {
            console.log(error.response.data.errors);
            document.getElementById("errorMsgCourt").innerHTML = error.response.data.errors.court ?? '';
            document.getElementById("errorMsgCourt").className = "text-danger";

            document.getElementById("errorMsgGov").innerHTML = error.response.data.errors.governorates ?? '';
            document.getElementById("errorMsgGov").className = "text-danger";

            document.getElementById("errorMsgDate").innerHTML = error.response.data.errors.starting_date ?? '';
            document.getElementById("errorMsgDate").className = "text-danger";

            document.getElementById("errorMsgDesc").innerHTML = error.response.data.errors.description ?? '';
            document.getElementById("errorMsgDesc").className = "text-danger";

            document.getElementById("errorMsgTitle").innerHTML = error.response.data.errors.title ?? '';
            document.getElementById("errorMsgTitle").className = "text-danger";

            document.getElementById("errorMsgPrice").innerHTML = error.response.data.errors.price ?? '';
            document.getElementById("errorMsgPrice").className = "text-danger";

        });
    });

</script>

@endsection
