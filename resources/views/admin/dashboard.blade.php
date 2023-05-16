@extends('layouts.admin-app')

@section('content')

        <!--begin::Toolbar-->
        <div class="toolbar" id="kt_toolbar">
            <!--begin::Container-->
            <div id="kt_toolbar_container" class="container-fluid d-flex">
                <!--begin::Page title-->
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <!--begin::Title-->
                    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">لوحة التحكم
                    <!--end::Title-->
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">



                 <!-- Admins Statistics -->
                 <!--begin::Row-->
                <div class="row gy-5 g-xl-12">
                    <!--begin::Col-->
                    <div class="col-xl-5">
                        <!--begin::Tables Widget 9-->
                        <div class="card card-xl-stretch mb-5 mb-xl-8">
                            <!--begin::Header-->
                            <div class="card-header border-0 pt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bolder fs-3 mb-1">طلبات الاعلانات</span>
                                    <span class="text-muted mt-1 fw-bold fs-7"> لديك {{ count($allannouncements) }} اعلان جديد</span>
                                </h3>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body py-3 cs-pb">
                                <!--begin::Table container-->
                                <div class="table-responsive">
                                    @if(count($announ_short_list))
                                    <!--begin::Table-->
                                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                        <!--begin::Table head-->
                                        <thead>
                                            <tr class="fw-bolder text-muted">
                                                <th class="min-w-200px">العنوان</th>
                                                <th class="min-w-125px">بيانات المستخدم</th>
                                                <th class="min-w-100px text-end">الاجراءات</th>
                                            </tr>
                                        </thead>
                                        <!--end::Table head-->
                                        <!--begin::Table body-->

                                        <tbody>
                                            @foreach ($announ_short_list as $announ)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="d-flex justify-content-start flex-column">
                                                            <a href="{{ route('admin.announcements.show', $announ->id) }}" class="text-dark fw-bolder text-hover-primary fs-6">{{$places[$announ->place] ?? ''}}</a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="d-flex justify-content-start flex-column">
                                                            <a class="text-dark fw-bolder text-hover-primary fs-6">{{$announ->users->first()->first_name ?? ''}} {{$announ->users->first()->last_name ?? ''}}</a>
                                                            <span class="text-muted fw-bold text-muted d-block fs-7">{{$announ->users->first()->phone ?? ''}}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-end flex-shrink-0">
                                                        <a href="{{ route('admin.announcements.edit', $announ->id) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                            <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                            <span class="svg-icon svg-icon-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                                                                    <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </a>
                                                     
                                                    </div>
                                                </td>
                                            </tr> 
                                            @endforeach
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                    @else
                                    <p>لا يوجد طلبات اعلان جديدة</p>
                                    @endif
                                </div>
                                <!--end::Table container-->
                                @if(count($announ_short_list))
                                <div class="view-all"><a href="{{ route('admin.announcements.index') }}" class="btn btn-sm btn-primary fw-bolder">مشاهدة المزيد</a></div>
                                @endif
                            </div>
                            <!--begin::Body-->
                        </div>
                        <!--end::Tables Widget 9-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-xl-7">
                        <!--begin::Tables Widget 9-->
                        <div class="card card-xl-stretch mb-5 mb-xl-8">
                            <!--begin::Header-->
                            <div class="card-header border-0 pt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bolder fs-3 mb-1">إحصائيات المسؤولين</span>
                                    <span class="text-muted mt-1 fw-bold fs-7"> لديك {{ count($alladmins) }} مسؤول</span>
                                </h3>
                                <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover">
                                    <a href="{{ route('admin.admins.create') }}" class="btn btn-sm btn-light btn-active-primary">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                    <span class="svg-icon svg-icon-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor" />
                                            <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->اضف مسؤول</a>
                                </div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body py-3 cs-pb">
                                <!--begin::Table container-->
                                <div class="table-responsive">
                                    @if(count($admin_short_list))
                                    <!--begin::Table-->
                                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                        <!--begin::Table head-->
                                        <thead>
                                            <tr class="fw-bolder text-muted">
                                                <th class="min-w-200px">المسؤول</th>
                                                <th class="min-w-125px">تاريخ الانضمام</th>
                                                <th class="min-w-100px text-end">الاجراءات</th>
                                            </tr>
                                        </thead>
                                        <!--end::Table head-->
                                        <!--begin::Table body-->

                                        <tbody>
                                            @foreach ($admin_short_list as $admin)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="symbol symbol-45px me-5">
                                                            <div class="symbol-label fs-3 bg-light-danger text-danger">{{ strtoupper(substr($admin->name ?? '', 0, 1)) }}</div>
                                                        </div>
                                                        <div class="d-flex justify-content-start flex-column">
                                                            <a href="@if (!$admin->id == 1){{ route('admin.admins.edit', $admin->id) }} @else javascript:void(0) @endif" class="text-dark fw-bolder text-hover-primary fs-6">{{$admin->name ?? ''}}</a>
                                                            <span class="text-muted fw-bold text-muted d-block fs-7">{{$admin->email ?? ''}}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-muted me-2 fs-7 fw-bold">{{ $admin->created_at->format('M, d, Y') ?? ''}}</td>
                                                @if (!$admin->id == 1)
                                                <td class="text-end">
                                                    <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">اجراءات
                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                                    <span class="svg-icon svg-icon-5 m-0">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon--></a>
                                                    <!--begin::Menu-->
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="{{ route('admin.admins.edit', $admin->id) }}" class="menu-link px-3">تعديل</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                       
                                                    </div>
                                                    <!--end::Menu-->
                                                </td>
                                                @endif
                                            </tr> 
                                            @endforeach
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                    @else
                                    <p>لا يوجد مسؤولين</p>
                                    @endif
                                </div>
                                <!--end::Table container-->
                                @if(count($admin_short_list))
                                <div class="view-all"><a href="{{ route('admin.admins.index') }}" class="btn btn-sm btn-primary fw-bolder">مشاهدة المزيد</a></div>
                                @endif
                            </div>
                            <!--begin::Body-->
                        </div>
                        <!--end::Tables Widget 9-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->

                                <!-- tasks Statistics -->
                <!--begin::Row-->
                <div class="row gy-5 g-xl-12">
                    <!--begin::Col-->
                    <div class="col-xl-8">
                        <!--begin::Tables Widget 9-->
                        <div class="card card-xl-stretch mb-5 mb-xl-8">
                            <!--begin::Header-->
                            <div class="card-header border-0 pt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bolder fs-3 mb-1">إحصائيات المهام</span>
                                    <span class="text-muted mt-1 fw-bold fs-7"> لديك {{ count($alltasks) }} مهمة</span>
                                </h3>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body py-3 cs-pb">
                                <!--begin::Table container-->
                                <div class="table-responsive">
                                    @if(count($tasks_short_list))
                                    <!--begin::Table-->
                                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                        <!--begin::Table head-->
                                        <thead>
                                            <tr class="fw-bolder text-muted">
                                                <th class="min-w-200px">المهمة</th>
                                                <th class="min-w-125px">تاريخ النشر</th>
                                                <th class="min-w-100px text-end">الاجراءات</th>
                                            </tr>
                                        </thead>
                                        <!--end::Table head-->
                                        <!--begin::Table body-->

                                        <tbody>
                                            @foreach ($tasks_short_list as $task)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="d-flex justify-content-start flex-column">
                                                            <a href="{{ route('admin.tasks.show', $task->id) }}" class="text-dark fw-bolder text-hover-primary fs-6">{{$task->title ?? ''}}</a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-muted me-2 fs-7 fw-bold">{{ $task->created_at ?? ''}}</td>
                                                <td class="text-end">
                                                    <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">اجراءات
                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                                    <span class="svg-icon svg-icon-5 m-0">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon--></a>
                                                    <!--begin::Menu-->
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="{{ route('admin.tasks.show', $task->id) }}" class="menu-link px-3">التفاصيل</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                       
                                                    </div>
                                                    <!--end::Menu-->
                                                </td>
                                            </tr> 
                                            @endforeach
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                    @else
                                    <p>لا يوجد موكلين</p>
                                    @endif
                                </div>
                                <!--end::Table container-->
                                @if(count($tasks_short_list))
                                <div class="view-all"><a href="{{ route('admin.tasks.index') }}" class="btn btn-sm btn-primary fw-bolder">مشاهدة المزيد</a></div>
                                @endif
                            </div>
                            <!--begin::Body-->
                        </div>
                        <!--end::Tables Widget 9-->
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-xl-4">
                        <!--begin::Tables Widget 9-->
                        <div class="card card-xl-stretch mb-5 mb-xl-8">
                            <!--begin::Header-->
                            <div class="card-header border-0 pt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bolder fs-3 mb-1"> المقالات المعلقة</span>
                                    <span class="text-muted mt-1 fw-bold fs-7"> لديك {{ count($allarticles) }} مقال معلق</span>
                                </h3>
                                <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" >
                                    <a href="{{ route('admin.articles.create') }}" class="btn btn-sm btn-light btn-active-primary">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                    <span class="svg-icon-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor" />
                                            <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon--></a>
                                </div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body py-3">
                                <!--begin::Table container-->
                                <div class="table-responsive">
                                    @if(count($article_short_list))
                                    <!--begin::Table-->
                                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                        <!--begin::Table head-->
                                        <thead>
                                            <tr class="fw-bolder text-muted">
                                                <th class="min-w-200px">المقال</th>
                                                <th class="min-w-100px text-end">الاجراءات</th>
                                            </tr>
                                        </thead>
                                        <!--end::Table head-->
                                        <!--begin::Table body-->

                                        <tbody>
                                            @foreach ($article_short_list as $article)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @isset($article->image_featured)
                                                        <img src="{{ asset('uploads/' . $article->image_featured) }}" alt="image" width="50" class="mx-2" style="border-radius: 5px">
                                                        @endisset
                                                        <a href="{{ route('admin.articles.show', $article->id) }}" class="text-dark fw-bolder text-hover-primary fs-6">{{$article->title ?? ''}}</a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-end flex-shrink-0">
                                                        <a href="{{ route('admin.articles.show', $article->id) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                            <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                            <span class="svg-icon svg-icon-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3" d="M20 3H4C2.89543 3 2 3.89543 2 5V16C2 17.1046 2.89543 18 4 18H4.5C5.05228 18 5.5 18.4477 5.5 19V21.5052C5.5 22.1441 6.21212 22.5253 6.74376 22.1708L11.4885 19.0077C12.4741 18.3506 13.6321 18 14.8167 18H20C21.1046 18 22 17.1046 22 16V5C22 3.89543 21.1046 3 20 3Z" fill="currentColor"></path>
                                                                    <rect x="6" y="12" width="7" height="2" rx="1" fill="currentColor"></rect>
                                                                    <rect x="6" y="7" width="12" height="2" rx="1" fill="currentColor"></rect>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </a>
                                                       
                                                    </div>
                                                </td>
                                            </tr>  
                                            
                                            @endforeach
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                    @else
                                    <p>لاي يوجد مقالات</p>
                                    @endif
                                </div>
                                <!--end::Table container-->
                                @if(count($article_short_list))
                                <div class="view-all"><a href="{{ route('admin.articles.index') }}" class="btn btn-sm btn-primary fw-bolder">مشاهدة المزيد</a></div>
                                @endif
                            </div>
                            <!--begin::Body-->
                        </div>
                        <!--end::Tables Widget 9-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
                <!-- tasks Statistics -->
                
                <!-- lawyers Statistics -->
                <!--begin::Row-->
                <div class="row gy-5 g-xl-12">
                    <!--begin::Col-->
                    <div class="col-xl-4">
                        <!--begin::Tables Widget 9-->
                        <div class="card card-xl-stretch mb-5 mb-xl-8">
                            <!--begin::Header-->
                            <div class="card-header border-0 pt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bolder fs-3 mb-1"> الاقرارات المعلقة</span>
                                    <span class="text-muted mt-1 fw-bold fs-7"> لديك {{ count($alltax) }} اقرار معلقة</span>
                                </h3>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body py-3 cs-pb">
                                <!--begin::Table container-->
                                <div class="table-responsive">
                                    @if(count($tax_short_list))
                                    <!--begin::Table-->
                                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                        <!--begin::Table head-->
                                        <thead>
                                            <tr class="fw-bolder text-muted">
                                                <th class="min-w-200px">الاقرارات</th>
                                                <th class="min-w-100px text-end">الاجراءات</th>
                                            </tr>
                                        </thead>
                                        <!--end::Table head-->
                                        <!--begin::Table body-->

                                        <tbody>
                                            @foreach ($tax_short_list as $tax)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <a href="{{ route('admin.taxes.edit', $tax->id) }}" class="text-dark fw-bolder text-hover-primary fs-6">{{$tax->tax_name ?? ''}}</a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-end flex-shrink-0">
                                                        <a href="{{ route('admin.taxes.edit', $tax->id) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                            <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                            <span class="svg-icon svg-icon-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3" d="M20 3H4C2.89543 3 2 3.89543 2 5V16C2 17.1046 2.89543 18 4 18H4.5C5.05228 18 5.5 18.4477 5.5 19V21.5052C5.5 22.1441 6.21212 22.5253 6.74376 22.1708L11.4885 19.0077C12.4741 18.3506 13.6321 18 14.8167 18H20C21.1046 18 22 17.1046 22 16V5C22 3.89543 21.1046 3 20 3Z" fill="currentColor"></path>
                                                                    <rect x="6" y="12" width="7" height="2" rx="1" fill="currentColor"></rect>
                                                                    <rect x="6" y="7" width="12" height="2" rx="1" fill="currentColor"></rect>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </a>
                                                        
                                                    </div>
                                                </td>
                                            </tr>  
                                            
                                            @endforeach
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                    @else
                                    <p>لاي يوجد اقرارات</p>
                                    @endif
                                </div>
                                <!--end::Table container-->
                                @if(count($tax_short_list))
                                <div class="view-all"><a href="{{ route('admin.taxes.index') }}" class="btn btn-sm btn-primary fw-bolder">مشاهدة المزيد</a></div>
                                @endif
                            </div>
                            <!--begin::Body-->
                        </div>
                        <!--end::Tables Widget 9-->
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-xl-8">
                        <!--begin::Tables Widget 9-->
                        <div class="card card-xl-stretch mb-5 mb-xl-8">
                            <!--begin::Header-->
                            <div class="card-header border-0 pt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bolder fs-3 mb-1">إحصائيات المحامين</span>
                                    <span class="text-muted mt-1 fw-bold fs-7"> لديك {{ count($alllawyers) }} محام</span>
                                </h3>
                                
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body py-3 cs-pb">
                                <!--begin::Table container-->
                                <div class="table-responsive">
                                    @if(count($lawyers_short_list))
                                    <!--begin::Table-->
                                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                        <!--begin::Table head-->
                                        <thead>
                                            <tr class="fw-bolder text-muted">
                                                <th class="min-w-200px">المحامي</th>
                                                <th class="min-w-125px">تاريخ الانضمام</th>
                                                <th class="min-w-100px text-end">الاجراءات</th>
                                            </tr>
                                        </thead>
                                        <!--end::Table head-->
                                        <!--begin::Table body-->

                                        <tbody>
                                            @foreach ($lawyers_short_list as $user)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="symbol symbol-45px me-5">
                                                            <div class="symbol-label fs-3 bg-light-danger text-danger">{{ strtoupper(substr($user->first_name ?? '', 0, 1)) }}</div>
                                                        </div>
                                                        <div class="d-flex justify-content-start flex-column">
                                                            <a href="{{ route('admin.lawyers.show', $user->id) }}" class="text-dark fw-bolder text-hover-primary fs-6">{{$user->first_name ?? ''}} {{$user->last_name ?? ''}}</a>
                                                            <span class="text-muted fw-bold text-muted d-block fs-7">{{$user->email ?? ''}}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-muted me-2 fs-7 fw-bold">{{ $user->created_at ?? ''}}</td>
                                                <td class="text-end">
                                                    <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">اجراءات
                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                                    <span class="svg-icon svg-icon-5 m-0">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon--></a>
                                                    <!--begin::Menu-->
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="{{ route('admin.lawyers.show', $user->id) }}" class="menu-link px-3">التفاصيل</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                       
                                                    </div>
                                                    <!--end::Menu-->
                                                </td>
                                            </tr> 
                                            @endforeach
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                    @else
                                    <p>لا يوجد محامين</p>
                                    @endif
                                </div>
                                <!--end::Table container-->
                                @if(count($lawyers_short_list))
                                <div class="view-all"><a href="{{ route('admin.lawyers.index') }}" class="btn btn-sm btn-primary fw-bolder">مشاهدة المزيد</a></div>
                                @endif
                            </div>
                            <!--begin::Body-->
                        </div>
                        <!--end::Tables Widget 9-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
                <!-- lawyers Statistics -->

                <!-- clients Statistics -->
                <!--begin::Row-->
                <div class="row gy-5 g-xl-12">

                    <!--begin::Col-->
                    <div class="col-xl-8">
                        <!--begin::Tables Widget 9-->
                        <div class="card card-xl-stretch mb-5 mb-xl-8">
                            <!--begin::Header-->
                            <div class="card-header border-0 pt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bolder fs-3 mb-1">إحصائيات الموكلين</span>
                                    <span class="text-muted mt-1 fw-bold fs-7"> لديك {{ count($allclients) }} موكل</span>
                                </h3>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body py-3 cs-pb">
                                <!--begin::Table container-->
                                <div class="table-responsive">
                                    @if(count($clients_short_list))
                                    <!--begin::Table-->
                                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                        <!--begin::Table head-->
                                        <thead>
                                            <tr class="fw-bolder text-muted">
                                                <th class="min-w-200px">الموكل</th>
                                                <th class="min-w-125px">تاريخ الانضمام</th>
                                                <th class="min-w-100px text-end">الاجراءات</th>
                                            </tr>
                                        </thead>
                                        <!--end::Table head-->
                                        <!--begin::Table body-->

                                        <tbody>
                                            @foreach ($clients_short_list as $user)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="symbol symbol-45px me-5">
                                                            <div class="symbol-label fs-3 bg-light-danger text-danger">{{ strtoupper(substr($user->first_name ?? '', 0, 1)) }}</div>
                                                        </div>
                                                        <div class="d-flex justify-content-start flex-column">
                                                            <a href="{{ route('admin.clients.show', $user->id) }}" class="text-dark fw-bolder text-hover-primary fs-6">{{$user->first_name ?? ''}} {{$user->last_name ?? ''}}</a>
                                                            <span class="text-muted fw-bold text-muted d-block fs-7">{{$user->email ?? ''}}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-muted me-2 fs-7 fw-bold">{{ $user->created_at ?? ''}}</td>
                                                <td class="text-end">
                                                    <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">اجراءات
                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                                    <span class="svg-icon svg-icon-5 m-0">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon--></a>
                                                    <!--begin::Menu-->
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="{{ route('admin.clients.show', $user->id) }}" class="menu-link px-3">التفاصيل</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                       
                                                    </div>
                                                    <!--end::Menu-->
                                                </td>
                                            </tr> 
                                            @endforeach
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                    @else
                                    <p>لا يوجد موكلين</p>
                                    @endif
                                </div>
                                <!--end::Table container-->
                                @if(count($clients_short_list))
                                <div class="view-all"><a href="{{ route('admin.clients.index') }}" class="btn btn-sm btn-primary fw-bolder">مشاهدة المزيد</a></div>
                                @endif
                            </div>
                            <!--begin::Body-->
                        </div>
                        <!--end::Tables Widget 9-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-xl-4">
                    <!--begin::Tables Widget 9-->
                    <div class="card card-xl-stretch mb-5 mb-xl-8">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1"> الاستشارات المعلقة</span>
                                <span class="text-muted mt-1 fw-bold fs-7"> لديك {{ count($allcons) }} استشارة معلقة</span>
                            </h3>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body py-3 cs-pb">
                            <!--begin::Table container-->
                            <div class="table-responsive">
                                @if(count($cons_short_list))
                                <!--begin::Table-->
                                <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                    <!--begin::Table head-->
                                    <thead>
                                        <tr class="fw-bolder text-muted">
                                            <th class="min-w-200px">الاستشارة</th>
                                            <th class="min-w-100px text-end">الاجراءات</th>
                                        </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->

                                    <tbody>
                                        @foreach ($cons_short_list as $cons)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="{{ route('admin.consultations.edit', $cons->id) }}" class="text-dark fw-bolder text-hover-primary fs-6">{{$cons->type ?? ''}}</a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-end flex-shrink-0">
                                                    <a href="{{ route('admin.consultations.edit', $cons->id) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                        <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                        <span class="svg-icon svg-icon-3">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <path opacity="0.3" d="M20 3H4C2.89543 3 2 3.89543 2 5V16C2 17.1046 2.89543 18 4 18H4.5C5.05228 18 5.5 18.4477 5.5 19V21.5052C5.5 22.1441 6.21212 22.5253 6.74376 22.1708L11.4885 19.0077C12.4741 18.3506 13.6321 18 14.8167 18H20C21.1046 18 22 17.1046 22 16V5C22 3.89543 21.1046 3 20 3Z" fill="currentColor"></path>
                                                                <rect x="6" y="12" width="7" height="2" rx="1" fill="currentColor"></rect>
                                                                <rect x="6" y="7" width="12" height="2" rx="1" fill="currentColor"></rect>
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                    </a>
                                                    
                                                </div>
                                            </td>
                                        </tr>  
                                        
                                        @endforeach
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                                @else
                                <p>لاي يوجد اشتشارات</p>
                                @endif
                            </div>
                            <!--end::Table container-->
                            @if(count($cons_short_list))
                            <div class="view-all"><a href="{{ route('admin.consultations.index') }}" class="btn btn-sm btn-primary fw-bolder">مشاهدة المزيد</a></div>
                            @endif
                        </div>
                        <!--begin::Body-->
                    </div>
                    <!--end::Tables Widget 9-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
                <!-- clients Statistics -->

                <!-- tasks Statistics -->
                <!--begin::Row-->
                {{-- <div class="row gy-5 g-xl-12">
                    <!--begin::Col-->
                    <div class="col-xl-8">
                        <!--begin::Tables Widget 9-->
                        <div class="card card-xl-stretch mb-5 mb-xl-8">
                            <!--begin::Header-->
                            <div class="card-header border-0 pt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bolder fs-3 mb-1">إحصائيات المهام</span>
                                    <span class="text-muted mt-1 fw-bold fs-7"> لديك {{ count($alltasks) }} مهمة</span>
                                </h3>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body py-3 cs-pb">
                                <!--begin::Table container-->
                                <div class="table-responsive">
                                    @if(count($tasks_short_list))
                                    <!--begin::Table-->
                                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                        <!--begin::Table head-->
                                        <thead>
                                            <tr class="fw-bolder text-muted">
                                                <th class="min-w-200px">المهمة</th>
                                                <th class="min-w-125px">تاريخ النشر</th>
                                                <th class="min-w-100px text-end">الاجراءات</th>
                                            </tr>
                                        </thead>
                                        <!--end::Table head-->
                                        <!--begin::Table body-->

                                        <tbody>
                                            @foreach ($tasks_short_list as $task)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="d-flex justify-content-start flex-column">
                                                            <a href="{{ route('admin.tasks.show', $task->id) }}" class="text-dark fw-bolder text-hover-primary fs-6">{{$task->title ?? ''}}</a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-muted me-2 fs-7 fw-bold">{{ $task->created_at ?? ''}}</td>
                                                <td class="text-end">
                                                    <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">اجراءات
                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                                    <span class="svg-icon svg-icon-5 m-0">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon--></a>
                                                    <!--begin::Menu-->
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="{{ route('admin.tasks.show', $task->id) }}" class="menu-link px-3">التفاصيل</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                       
                                                    </div>
                                                    <!--end::Menu-->
                                                </td>
                                            </tr> 
                                            @endforeach
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                    @else
                                    <p>لا يوجد موكلين</p>
                                    @endif
                                </div>
                                <!--end::Table container-->
                                @if(count($tasks_short_list))
                                <div class="view-all"><a href="{{ route('admin.tasks.index') }}" class="btn btn-sm btn-primary fw-bolder">مشاهدة المزيد</a></div>
                                @endif
                            </div>
                            <!--begin::Body-->
                        </div>
                        <!--end::Tables Widget 9-->
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-xl-4">
                        <!--begin::Tables Widget 9-->
                        <div class="card card-xl-stretch mb-5 mb-xl-8">
                            <!--begin::Header-->
                            <div class="card-header border-0 pt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bolder fs-3 mb-1"> الاستشارات المعلقة</span>
                                    <span class="text-muted mt-1 fw-bold fs-7"> لديك {{ count($allcons) }} استشارة معلقة</span>
                                </h3>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body py-3 cs-pb">
                                <!--begin::Table container-->
                                <div class="table-responsive">
                                    @if(count($cons_short_list))
                                    <!--begin::Table-->
                                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                        <!--begin::Table head-->
                                        <thead>
                                            <tr class="fw-bolder text-muted">
                                                <th class="min-w-200px">الاستشارة</th>
                                                <th class="min-w-100px text-end">الاجراءات</th>
                                            </tr>
                                        </thead>
                                        <!--end::Table head-->
                                        <!--begin::Table body-->

                                        <tbody>
                                            @foreach ($cons_short_list as $cons)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <a href="{{ route('admin.consultations.edit', $cons->id) }}" class="text-dark fw-bolder text-hover-primary fs-6">{{$cons->type ?? ''}}</a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-end flex-shrink-0">
                                                        <a href="{{ route('admin.consultations.edit', $cons->id) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                            <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                            <span class="svg-icon svg-icon-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3" d="M20 3H4C2.89543 3 2 3.89543 2 5V16C2 17.1046 2.89543 18 4 18H4.5C5.05228 18 5.5 18.4477 5.5 19V21.5052C5.5 22.1441 6.21212 22.5253 6.74376 22.1708L11.4885 19.0077C12.4741 18.3506 13.6321 18 14.8167 18H20C21.1046 18 22 17.1046 22 16V5C22 3.89543 21.1046 3 20 3Z" fill="currentColor"></path>
                                                                    <rect x="6" y="12" width="7" height="2" rx="1" fill="currentColor"></rect>
                                                                    <rect x="6" y="7" width="12" height="2" rx="1" fill="currentColor"></rect>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </a>
                                                        
                                                    </div>
                                                </td>
                                            </tr>  
                                            
                                            @endforeach
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                    @else
                                    <p>لاي يوجد اشتشارات</p>
                                    @endif
                                </div>
                                <!--end::Table container-->
                                @if(count($cons_short_list))
                                <div class="view-all"><a href="{{ route('admin.consultations.index') }}" class="btn btn-sm btn-primary fw-bolder">مشاهدة المزيد</a></div>
                                @endif
                            </div>
                            <!--begin::Body-->
                        </div>
                        <!--end::Tables Widget 9-->
                    </div>
                    <!--end::Col-->
                </div> --}}
                <!--end::Row-->
                <!-- tasks Statistics -->

                <!-- Podcasts Statistics -->
                <!--begin::Row-->
                {{-- <div class="row gy-5 g-xl-12">
                    <!--begin::Col-->
                    <div class="col-xl-4">
                        <!--begin::Tables Widget 9-->
                        <div class="card card-xl-stretch mb-5 mb-xl-8">
                            <!--begin::Header-->
                            <div class="card-header border-0 pt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bolder fs-3 mb-1">Latest Podcasts Categories</span>
                                    <span class="text-muted mt-1 fw-bold fs-7">Over {{count($st_podcasts_cat)}} Categories</span>
                                </h3>
                                <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" >
                                    <a href="{{ route('admin.podcastscategories.create') }}" class="btn btn-sm btn-light btn-active-primary">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                    <span class="svg-icon-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor" />
                                            <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon--></a>
                                </div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body py-3">
                                <!--begin::Table container-->
                                <div class="table-responsive">
                                    @if(count($st_podcasts_cat))
                                    <!--begin::Table-->
                                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                        <!--begin::Table head-->
                                        <thead>
                                            <tr class="fw-bolder text-muted">
                                                <th class="min-w-200px">Category</th>
                                                <th class="min-w-100px text-end">Actions</th>
                                            </tr>
                                        </thead>
                                        <!--end::Table head-->
                                        <!--begin::Table body-->

                                        <tbody>
                                            @foreach ($st_podcasts_cat as $category)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @isset($category->featured_image)
                                                        <img src="{{ asset('uploads/' . $category->featured_image) }}" alt="image" width="50" class="mx-2" style="border-radius: 5px">
                                                        @endisset
                                                        <a href="{{ route('admin.podcastscategories.edit', $category->id) }}" class="text-dark fw-bolder text-hover-primary fs-6">{{$category->title ?? ''}}</a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-end flex-shrink-0">
                                                        <a href="{{ route('admin.podcastscategories.edit', $category->id) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                            <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                            <span class="svg-icon svg-icon-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                                                                    <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </a>
                                                        
                                                    </div>
                                                </td>
                                            </tr>  
                                            
                                            @endforeach
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                    @else
                                    <p>No categories found</p>
                                    @endif
                                </div>
                                <!--end::Table container-->
                            </div>
                            <!--begin::Body-->
                        </div>
                        <!--end::Tables Widget 9-->
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-xl-8">
                        <!--begin::Tables Widget 9-->
                        <div class="card card-xl-stretch mb-5 mb-xl-8">
                            <!--begin::Header-->
                            <div class="card-header border-0 pt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bolder fs-3 mb-1">Podcasts Statistics</span>
                                    <span class="text-muted mt-1 fw-bold fs-7">Over news</span>
                                </h3>
                                <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" >
                                    <a href="{{ route('admin.news.create') }}" class="btn btn-sm btn-light btn-active-primary">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                    <span class="svg-icon svg-icon-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor" />
                                            <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->New Podcast</a>
                                </div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body py-3">
                                <!--begin::Table container-->
                                <div class="table-responsive">
                                    @if(count($st_podcasts))
                                    <!--begin::Table-->
                                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                        <!--begin::Table head-->
                                        <thead>
                                            <tr class="fw-bolder text-muted">
                                                <th class="min-w-200px">Video</th>
                                                <th class="min-w-125px">Published Date</th>
                                                <th class="min-w-100px text-end">Actions</th>
                                            </tr>
                                        </thead>
                                        <!--end::Table head-->
                                        <!--begin::Table body-->

                                        <tbody>
                                            @foreach ($st_podcasts as $post)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @isset($post->featured_image)
                                                        <img src="{{ asset('uploads/' . $post->featured_image) }}" alt="image" width="50" class="mx-2">
                                                        @endisset
                                                        <a href="{{ route('admin.podcasts.edit', $post->id) }}" class="text-dark fw-bolder text-hover-primary fs-6">{{ implode(' ', array_slice(explode(' ', $post->title), 0, 6)) }}@if ( str_word_count($post->title) > 6 )...@endif</a>
                                                    </div>
                                                </td>
                                                
                                                <td class="text-muted me-2 fs-7 fw-bold">{{ $post->created_at->format('M, d, Y') ?? ''}}</td>
                                                <td class="text-end">
                                                    <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                                    <span class="svg-icon svg-icon-5 m-0">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon--></a>
                                                    <!--begin::Menu-->
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="{{ route('admin.podcasts.edit', $post->id) }}" class="menu-link px-3">Edit</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        
                                                    </div>
                                                    <!--end::Menu-->
                                                </td>
                                            </tr>  
                                            
                                            @endforeach
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                    @else
                                    <tr>No podcasts found</tr>
                                    @endif

                                </div>
                                <!--end::Table container-->
                            </div>
                            <!--begin::Body-->
                        </div>
                        <!--end::Tables Widget 9-->
                    </div>
                    <!--end::Col-->
                </div> --}}
                <!--end::Row-->
                <!-- Podcasts Statistics -->




                <!-- Ads Statistics -->
                <!--begin::Row-->
                {{-- <div class="row gy-5 g-xl-12">
                    <!--begin::Col-->
                    <div class="col-xl-12">
                        <!--begin::Tables Widget 9-->
                        <div class="card card-xl-stretch mb-5 mb-xl-8">
                            <!--begin::Header-->
                            <div class="card-header border-0 pt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bolder fs-3 mb-1">Ads Statistics</span>
                                    <span class="text-muted mt-1 fw-bold fs-7">Over {{$allads}} Ads</span>
                                </h3>
                                <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover">
                                    <a href="{{ route('admin.announcements.create') }}" class="btn btn-sm btn-light btn-active-primary">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                    <span class="svg-icon svg-icon-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor" />
                                            <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->New Ads</a>
                                </div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body py-3">
                                <!--begin::Table container-->
                                <div class="table-responsive">
                                    @if($allads)
                                    <!--begin::Table-->
                                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                        <!--begin::Table head-->
                                        <thead>
                                            <tr class="fw-bolder text-muted">
                                                <th class="min-w-200px">Admin</th>
                                                <th class="min-w-150px">Role</th>
                                                <th class="min-w-125px">Joined Date</th>
                                                <th class="min-w-100px text-end">Actions</th>
                                            </tr>
                                        </thead>
                                        <!--end::Table head-->
                                        <!--begin::Table body-->

                                        <tbody>
                                            @foreach ($admins as $user)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="symbol symbol-45px me-5">
                                                            <div class="symbol-label fs-3 bg-light-danger text-danger">{{ strtoupper(substr($user->name ?? '', 0, 1)) }}</div>
                                                        </div>
                                                        <div class="d-flex justify-content-start flex-column">
                                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="text-dark fw-bolder text-hover-primary fs-6">{{$user->name ?? ''}}</a>
                                                            <span class="text-muted fw-bold text-muted d-block fs-7">{{$user->email ?? ''}}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="badge badge-light-success fs-8 fw-bolder">{{$user->roles[0]->name}}</div>  
                                                </td>
                                                <td class="text-muted me-2 fs-7 fw-bold">{{ $user->created_at->format('M, d, Y') ?? ''}}</td>
                                                <td class="text-end">
                                                    <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                                    <span class="svg-icon svg-icon-5 m-0">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon--></a>
                                                    <!--begin::Menu-->
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="{{ route('admin.admins.edit', $user->id) }}" class="menu-link px-3">Edit</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="" class="menu-link px-3" data-kt-users-table-filter="delete_row" data-bs-toggle="modal" data-bs-target="#delete_item-{{$user->id}}">Delete</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                    </div>
                                                    <!--end::Menu-->
                                                </td>
                                            </tr>  
                                            <!--begin::Modal -  delete item-->
                                            <div class="modal fade" id="delete_item-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="delete_item-{{$user->id}}" aria-hidden="true">
                                                <!--begin::Modal dialog-->
                                                <div class="modal-dialog modal-dialog-centered mw-650px">
                                                    <!--begin::Modal content-->
                                                    <div class="modal-content">
                                                        <!--begin::Close-->
                                                        <div class="btn btn-icon btn-sm btn-active-icon-primary"  class="close" data-bs-dismiss="modal" aria-label="Close" style="margin-left: auto;">
                                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                                            <span class="svg-icon svg-icon-1">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                                                    <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </div>
                                                        <!--end::Close-->
                                                        <!--begin::Modal body-->
                                                        <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                                            <div class="swal2-icon swal2-warning swal2-icon-show my-2" style="display: flex;"><div class="swal2-icon-content">!</div></div>
                                                            <div class="swal2-html-container my-15" id="" style="display: block;">Are you sure you want to delete {{ $admin->email ?? ''}}?</div>
                                                            <div class="swal2-actions" style="display: flex;">
                                                                <div class="swal2-loader"></div>
                                                                {!! Form::model($user, ['route' => ['admin.admins.destroy', $user->id], 'method' => 'delete']) !!}
                                                                <button class="swal2-confirm btn fw-bold btn-danger mx-2" aria-label="" style="display: inline-block;">Yes, delete!</button>
                                                                {!! Form::close() !!}
                                                                <button class=" btn fw-bold btn-active-light-primary mx-2" aria-label="true" style="display: inline-block;" data-bs-dismiss="modal">No, cancel</button>
                                                            </div>
                                                        </div>
                                                        <!--end::Modal body-->
                                                    </div>
                                                    <!--end::Modal content-->
                                                </div>
                                                <!--end::Modal dialog-->
                                            </div>
                                            <!--end::Modal - New Card-->
                                            @endforeach
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                    @else
                                    No Ads found
                                    @endif
                                </div>
                                <!--end::Table container-->
                            </div>
                            <!--begin::Body-->
                        </div>
                        <!--end::Tables Widget 9-->
                    </div>
                    <!--end::Col-->
                </div> --}}
                <!--end::Row-->

            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->


@endsection 
