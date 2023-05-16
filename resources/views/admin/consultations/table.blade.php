

<!--begin::Table-->
<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
	<!--begin::Table head-->
	<thead>
		<!--begin::Table row-->
		<tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
			<th class="min-w-125px">نوع الإستشارة</th>
            <th class="min-w-125px">الوصف</th>
            <th class="min-w-125px">حالة الدفع</th>
            <th class="min-w-125px">الناشر</th>
            <th class="min-w-125px">رقم الهاتف</th>
            <th class="min-w-125px">البريد الإلكتروني</th>
            <th class="min-w-100px text-end">الاجراءات</th>
		</tr>
		<!--end::Table row-->
	</thead>
	<!--end::Table head-->
    <!--begin::Table body-->
    <tbody class="text-gray-600 fw-bold">
	@foreach ($consultations as $cons)
        <!--begin::Table row-->
        <tr>
            <td >
                <!--begin:: Avatar -->
                <a href="{{ route('admin.consultations.edit', [$cons->id]) }}" class="text-gray-800 text-hover-primary mb-1">{{ $cons->type }}</a>
                    <span>{{ $cons->created_at }}</span>
            </td>
            <td> {{ $cons->description  ?? ''}}</td>
            <td> {{ ($cons->payment_status == true)  ?  'تم الدفع' : 'لم يتم الدفع بعد'}}</td>
            <td> <a href="" class="text-gray-800 text-hover-primary mb-1">{{ $cons->clients->first()->user->first_name ?? ''}}</a></td>
            <td> {{ $cons->clients->first()->user->phone ?? ''}}</td>
            <td> {{ $cons->clients->first()->user->email ?? ''}}</td>
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
                        @if($cons->feedback == null)
                        <a href="{{ route('admin.consultations.edit', [$cons->id]) }}" class="menu-link px-3">تقديم الاستشارة</a>
                        @endif
                    </div>
                    <!--end::Menu item-->
                     <!--begin::Menu item-->
                     <div class="menu-item px-3">
                        <a href="" class="menu-link px-3" data-kt-users-table-filter="delete_row" data-bs-toggle="modal" data-bs-target="#delete_item-{{$cons->id}}">حذف</a>
                    </div>
                    <!--end::Menu item-->
                </div>
                <!--end::Menu-->
            </td>
            <!--end::Action=-->
        </tr>
        <!--end::Table row-->

        <!--begin::Modal -  delete item-->
        <div class="modal fade" id="delete_item-{{$cons->id}}" tabindex="-1" role="dialog" aria-labelledby="delete_item-{{$cons->id}}" aria-hidden="true">
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
                        <div class="swal2-html-container my-15" id="" style="display: block;">هل أنت متأكد أنك تريد حذف طلب الاستشارة</div>
                        <div class="swal2-actions" style="display: flex;">
                            <div class="swal2-loader"></div>
                            {!! Form::model($cons, ['route' => ['admin.consultations.destroy', $cons->id], 'method' => 'delete']) !!}
                            <button class="swal2-confirm btn fw-bold btn-danger mx-2" aria-label="" style="display: inline-block;">نعم ، احذف!</button>
                            {!! Form::close() !!}
                            <button class=" btn fw-bold btn-light-primary mx-2" aria-label="true" style="display: inline-block;" data-bs-dismiss="modal">لا ، إلغاء</button>
                        </div>
                    </div>
                    <!--end::Modal body-->
                </div>
                <!--end::Modal content-->
            </div>
            <!--end::Modal dialog-->
        </div>
        <!--end::Modal - delete item-->


        @endforeach
    </tbody>
    <!--end::Table body-->
</table>
<!--end::Table-->

@include('partials._pagination', ['records' => $consultations])
