<!--begin::Table-->
<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
    <!--begin::Table head-->
    <thead>
        <!--begin::Table row-->
        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
            <th class="min-w-125px text-center">رقم التحويل</th>
            <th class="min-w-125px text-center"> الحالة</th>
            <th class="min-w-125px text-center">المبلغ المدفوع</th>
            <th class="min-w-125px text-center">المبلغ الاجمالي</th>
            <th class="min-w-125px text-center"> من</th>
            <th class="min-w-125px text-center"> الى</th>
            <th class="min-w-125px text-center"> نوع المهمة</th>
        </tr>
        <!--end::Table row-->
    </thead>
    <!--end::Table head-->
    <!--begin::Table body-->
    <tbody class="text-gray-600 fw-bold">
        @foreach ($admins as $admin)
        @if($admin->users->first() != null)
        <!--begin::Table row-->
        <tr>
            <!--begin::User=-->
            <td class="text-center">
                {{ $admin->transaction_id ?? ''}}
            </td>
            <td class="text-center">
                @if($admin->status == 'paid')
                <div class="badge badge-primary fw-bolder">
                    تم الدفع
                </div>
                @elseif($admin->status == 'pending')
                <div class="badge badge-light fw-bolder">
                    قيد الإنتظار
                </div>
                @elseif($admin->status == 'failed')
                <div class="badge badge-danger fw-bolder">
                    لم يتم الدفع
                </div>
                <!-- refunded -->
                @elseif($admin->status == 'refunded')
                <div class="badge badge-dark fw-bolder">
                    تم إلغاء الدفع
                </div>
                @endif
            </td>
            <td class="text-center">
                {{ $admin->users[0]->pivot->amount ?? ''}}
            </td>
            <!--end::Last login=-->
            <!--begin::Joined-->
            <td class="text-center">{{ $admin->amount }}</td>
            <td class="text-center">{{ $person->find($admin->users[0]->pivot->user_id)->first_name ?? ''}} {{ $person->find($admin->users[0]->pivot->user_id)->last_name ?? ''}}</td>
            <td class="text-center">{{ $person->find($admin->users[0]->pivot->to_user_id)->first_name ?? ''}} {{ $person->find($admin->users[0]->pivot->to_user_id)->last_name ?? ''}}</td>
            <td class="text-center">
                @if($admin->users[0]->pivot->mission_type == 'task')
                <div class="badge badge-light fw-bolder">
                    مهمة عمل
                </div>
                @elseif($admin->users[0]->pivot->mission_type == 'tax')
                <div class="badge badge-light fw-bolder">
                    إقرار ضريبي
                </div>
                @else
                <div class="badge badge-light fw-bolder">
                    إستشارة قانونية
                </div>
                @endif
            </td>
            
            <!--begin::Joined-->
            
        </tr>
        <!--end::Table row-->

        <!--begin::Modal -  delete item-->
        <div class="modal fade" id="delete_item-{{$admin->id}}" tabindex="-1" role="dialog" aria-labelledby="delete_item-{{$admin->id}}" aria-hidden="true">
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
                        <div class="swal2-html-container my-15" id="" style="display: block;">هل أنت متأكد أنك تريد حذف {{ $admin->email ?? ''}}</div>
                        <div class="swal2-actions" style="display: flex;">
                            <div class="swal2-loader"></div>
                            {!! Form::model($admin, ['route' => ['admin.admins.destroy', $admin->id], 'method' => 'delete']) !!}
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
        @endif
        @endforeach
    </tbody>
    <!--end::Table body-->
</table>
<!--end::Table-->

@include('partials._pagination', ['records' => $admins])

