<!--begin::Card body-->
<div class="card-body py-4">
    <!--begin::Table-->
    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
        <!--begin::Table head-->
        <thead>
            <!--begin::Table row-->
            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                <th class="min-w-125px">محل الإعلان</th>
                <th class="min-w-125px">المسموح له بالإطلاع</th>
                <th class="min-w-125px">صاحب الإعلان</th>
                <th class="min-w-125px">رقم الهاتف</th>
                <th class="min-w-125px">البريد الإلكتروني</th>
                <th class="min-w-125px">حالة الإعلان</th>
                <th class="min-w-100px text-end">الإجراءات</th>
            </tr>
            <!--end::Table row-->
        </thead>
        <!--end::Table head-->
        <!--begin::Table body-->
        <tbody class="text-gray-600 fw-bold">
        @foreach ($announcements as $announ)
            <!--begin::Table row-->
            <tr>
                <!--begin::User=-->
                <td class="align-items-center">
                    <!--begin::User details-->
                    <div class="d-flex flex-column">
                        <a href="{{ route('admin.announcements.show', $announ->id) }}" class="text-gray-800 text-hover-primary mb-1">{{ $places[$announ->place] ?? ''}}</a>
                    </div>
                    <!--begin::User details-->
                </td>
                <!--end::User=-->
                <!--begin::Role=-->
                <td>@if($announ->usertype == 'lawyer') اظهار للمحامين @elseif($announ->usertype == 'client') اظهار للموكلين @elseif($announ->usertype == 'all') اظهار للكل @else لم يتحدد بعد @endif</td>

                <td>{{ $announ->users->first()->first_name ?? '' }}</td>
                <!--end::Role=-->
                <!--begin::Last login=-->
                <td>{{ $announ->users->first()->phone ?? ''}}</td>
                <!--end::Last login=-->
                <!--begin::Joined-->
                <td>{{ $announ->users->first()->email ?? '' }}</td>
                <td><div class="badge badge-light fw-bolder"> @if($announ->status == 0) معلق @elseif($announ->status == 1) تم نشر الاعلان @else منتهي @endif</div></td>
                
                <!--begin::Joined-->
            

                <td class="text-end">
                    <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">الاجراءات
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
                            <a href="{{ route('admin.announcements.show', [$announ->id]) }}" class="menu-link px-3"> عرض</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                        <a href="{{ route('admin.announcements.edit', [$announ->id]) }}" class="menu-link px-3"> تعديل</a>
                        </div>
                    <!--end::Menu item-->
                    </div>
                    <!--end::Menu-->
                </td>
            </tr>
            <!--end::Table row-->
        @endforeach
        </tbody>
        <!--end::Table body-->
    </table>
    <!--end::Table-->
</div>
<!--end::Card body-->

@include('partials._pagination', ['records' => $announcements])