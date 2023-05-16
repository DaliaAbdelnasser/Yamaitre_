<div class="table-responsive">
    <!--begin::Table-->
    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
        <!--begin::Table head-->
        <thead>
            <!--begin::Table row-->
            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                <th class="min-w-125px">المتقدم للمهمة</th>
                <th class="min-w-100px">البريد الإلكتروني</th>
                <th class="min-w-125px"> رقم الهاتف</th>
                <th class="min-w-125px">التكلفة المعروضة</th>
                <th class="min-w-100px text-end">الاجراءات</th>
            </tr>
            <!--end::Table row-->
        </thead>
        <!--end::Table head-->
        <!--begin::Table body-->
        <tbody class="text-gray-600 fw-bold">
        @foreach ($task->applicantlawyers as $key => $lawyer)
            <!--begin::Table row-->
            <tr>
                <!--begin::User=-->
                <td class="">
                    <span class="text-gray-800 text-hover-primary mb-1">{{ $lawyer->first_name ?? ''}}</span>
                </td>
                <td>{{ $lawyer->email ?? ''}}</td>
                <td>{{ $lawyer->phone ?? ''}}</td>
                <td>{{ $task->applicantlawyers[$key]->pivot->cost ?? ''}}</td>
                <!--begin::Action=-->
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
                            <a href="{{ route('admin.lawyers.show', [$lawyer->id]) }}" class="menu-link px-3">&nbsp;&nbsp; عرض</a>
                        </div>
                        @if (!count($task->assignedlawyers))
                            <div class="menu-item px-3">
                                <a href="{{ route('admin.assign.user', [ $task->id, $lawyer->id, $task->user[0]->id  ]) }}" onclick="event.preventDefault();
                                    document.getElementById('assign-form').submit();" class="menu-link px-3">&nbsp;&nbsp; اسناد المهمة</a>
                            </div>
                            <form id="assign-form" action="{{ route('admin.assign.user', [ $task->id, $lawyer->id, $task->user[0]->id ]) }}" method="POST" class="d-none">
                                @csrf
                                <input name="cost" type="hidden" value="{{  $task->applicantlawyers[$key]->pivot->cost }}">
                            </form>
                        @endif
                       
                    </div>
                    <!--end::Menu-->
                </td>
                <!--end::Action=-->
            </tr>
            <!--end::Table row-->
        @endforeach
        </tbody>
        <!--end::Table body-->
    </table>
    <!--end::Table-->
</div>

