@extends('layouts.admin-app')

@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">الموكلين</h1>
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
                    <li class="breadcrumb-item text-dark">تعديل</li>
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
             {{-- @include('coreui-templates::common.errors') --}}
             <div class="row">
                 <div class="col-lg-12">
                      <div class="card">
                          <div class="card-header">
                            <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">تعديل بيانات المحامي</h1>
                          </div>
                          <div class="card-body">
                              {!! Form::model($lawyer, ['route' => ['admin.lawyers.update', $lawyer->userable_id], 'method' => 'patch', 'files' => true]) !!}

                                    <div class="row">
                                        @include('admin.lawyers.fields')
                                    </div>

                              {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
         </div>
    </div>
@endsection
