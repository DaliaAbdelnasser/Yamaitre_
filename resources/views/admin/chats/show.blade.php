@extends('layouts.admin-app')

@section('content')
<!--begin::Toolbar-->
<div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">المحادثات</h1>
                <!--begin::Separator-->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!--end::Separator-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">لوحة التحكم</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">عرض بيانات المحادثة</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->            
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">عرض بيانات المحادثة</h1>
                        </div>
                    </div>
                    <div class="content">
                        <!--begin::Layout-->
                        <div class="d-flex flex-column flex-lg-row">
                            <!--begin::Sidebar-->
                            <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-10">
                                <!--begin::Card-->
                                <div class="card mb-5 mb-xl-8">
                                    <!--begin::Card body-->
                                    <div class="card-body">
                                        <!--begin::Summary-->
                                        <!--begin::User Info-->
                                        <div class="d-flex flex-center flex-column py-5">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-100px symbol-circle mb-7">
                                                <!-- <img src="{{ asset('uploads/logo.png') }}" alt="image" /> -->
                                            </div>
                                            <!--end::Avatar-->
                                            <!--begin::Name-->
                                            <a class="fs-3 text-gray-800 text-hover-primary fw-bolder mb-3">{{ $chat->chat_channel }}</a>
                                            <!--end::Name-->
                                            <!--begin::Position-->
                                            <div class="mb-9">
                                                <!--begin::Badge-->
                                                <div class="badge badge-lg badge-light-primary d-inline">{{ $chat->created_at }}</div>
                                                
                                                <!--begin::Badge-->
                                            </div>
                                            <!--end::Position-->
                                        </div>
                                        <!--end::User Info-->
                                        <!--end::Summary-->
                                        <!--begin::Details toggle-->
                                        <div class="d-flex flex-stack fs-4 py-3">
                                            <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse" href="#kt_user_view_details" role="button" aria-expanded="false" aria-controls="kt_user_view_details">التفاصيل
                                            <span class="ms-2 rotate-180">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                                <span class="svg-icon svg-icon-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </span></div>
                                            
                                        </div>
                                        <!--end::Details toggle-->
                                        <div class="separator"></div>
                                        <!--begin::Details content-->
                                        <div id="kt_user_view_details" class="collapse show">
                                            <div class="pb-5 fs-6">
                                                <!--begin::Details item-->
                                                <div class="fw-bolder mt-5">رقم المحادثة</div>
                                                <div class="text-gray-600">{{ $chat->id  ?? '' }}</div>
                                                <!--begin::Details item-->
                                                <!--begin::Details item-->
                                                <div class="fw-bolder mt-5">المُرسِل</div>
                                                <div class="text-gray-600">
                                                    <a class="text-gray-600 text-hover-primary">{{ $chat->sender->first_name ?? '' }}</a>
                                                </div>
                                                <!--begin::Details item-->
                                                <!--begin::Details item-->
                                                <div class="fw-bolder mt-5">المُرسَل إليه</div>
                                                <div class="text-gray-600">{{ $chat->reciever->first_name ?? '' }}</div>
                                                <!--begin::Details item-->
                                                <!--begin::Details item-->
                                                <div class="fw-bolder mt-5"></div>
                                            </div>
                                        </div>
                                        <!--end::Details content-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card-->
                            </div>
                            <!--end::Sidebar-->
                            <!--begin::Content-->
                            <div class="flex-lg-row-fluid ms-lg-15">
                                @include('flash::message')
                                

                                @if(count($chat->content))
                                <div class="card mt-8">
                                    <!--begin::Card header-->
                                    <div class="card-header border-0 py-3">
                                        <!--begin::Card title-->
                                        <div class="card-title">
                                            <h3>المحادثة {{$chat->id}}</h3>
                                        </div>
                                        <!--begin::Card title-->
                                    </div>
                                    <!--end::Card header-->
                                    <div class="card-body">
                                        <div id="" class="">
                                            <div class="pb-5 fs-6">
                                                <div class="jobsearch-user-chat-content jobsearch-user-chat-messages user-{{$chat->id}}">
                                                
                                                    <ul >
                                                        @foreach($chat->content as $key => $content )
                                                        @if($content->senderable_id == auth()->user()->id)
                                                        <li class="dn-sender">
                                                            @if($chat->reciever->id == auth()->user()->id)
                                                            <img src="{{ asset('uploads/' . $chat->reciever->userable->profile_image) }}">
                                                            @else
                                                            <img src="{{ asset('uploads/' . $chat->sender->userable->profile_image) }}">
                                                            @endif
                                                            <div class="jobsearch-chat-entete-wrapper chat-688" >
                                                                <p>
                                                                    {{ $content->message ?? ''}}
                                                                </p>
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
                                                                <p>
                                                                    {{ $content->message}}
                                                                </p>
                                                                @if($content->file != null)
                                                                <a href="{{ asset('uploads/' . $content->file) }}" download style="font-size:12px"><i class="fa fa-cloud-download"></i> {{ $content->file_name }}</a>
                                                                @endif
                                                                <div class="jobsearch-chat-entete">
                                                                    <h3>{{ $content->created_at}}</h3>
                                                                    <a href="javascript:void(0)" class="jobsearch-color jobsearch-chat-seen">Seen</a>
                                                                </div>
                                                            </div>
                                                            @if($chat->reciever->id == auth()->user()->id)
                                                            <img src="{{ asset('uploads/' . $chat->sender->userable->profile_image) }}">
                                                            @else
                                                            <img src="{{ asset('uploads/' . $chat->reciever->userable->profile_image) }}">
                                                            @endif
                                                        </li>
                                                        @endif
                                                        @endforeach
                                                    </ul>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Layout-->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection