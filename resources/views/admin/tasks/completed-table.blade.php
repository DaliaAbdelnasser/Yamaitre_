<div class="table-responsive">
     <!--begin::Table-->
     <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
        <!--begin::Table head-->
        <thead>
            <!--begin::Table row-->
            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                <th class="min-w-125px">عنوان المهمة</th>
                <th class="min-w-100px">التكلفة</th>
                <th class="min-w-125px">المحكمة المختصة</th>
                <th class="min-w-125px">تاريخ انهاء المهمة 	</th>
                <th class="min-w-100px text-end">الاجراءات</th>
            </tr>
            <!--end::Table row-->
        </thead>
        <!--end::Table head-->
        <!--begin::Table body-->
        <tbody class="text-gray-600 fw-bold">
        @foreach ($completed as $task)
            <!--begin::Table row-->
            <tr>
                <!--begin::User=-->
                
                {{-- <td class="d-flex flex-column align-items-start">
                    <!--begin:: Avatar -->
                    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        <a href="">
                            <div class="symbol-label fs-3 bg-light-danger text-danger">
                                @if ($task->assignedlawyers->first()->userable->profile_image != null)
                                <img src="{{ asset('uploads/' . $task->assignedlawyers->first()->userable->profile_image) }}" alt="{{ $task->assignedlawyers->first()->first_name ?? ''}}" class="w-100">
                                @else
                                {{ strtoupper(substr($task->assignedlawyers->first()->first_name ?? '', 0, 1)) }}
                                @endif
                            </div>
                        </a>
                    </div>
                    <span class="text-gray-800 text-hover-primary mb-1">{{ $task->assignedlawyers->first()->first_name ?? ''}}</span>
                    <div class="row">
                    @php $rating = $task->assignedlawyers->first()->userable->rate; @endphp  
                    @foreach(range(1,5) as $i)
                        <span class="fa-stack" style="width:1em">
                        <i class="far fa-star fa-stack-1x"></i>
                        @if($rating >0)
                            @if($rating >0.5)
                                <i class="fas fa-star fa-stack-1x"></i>
                            @else
                                <i class="fas fa-star-half fa-stack-1x"></i>
                            @endif
                        @endif
                        @php $rating--; @endphp
                        </span>
                    @endforeach
                    </div>
                </td> --}}

                <td>{{ $task->title ?? ''}}</td>
                <td>{{ $task->assignedlawyers->first()->pivot->cost ?? ''}}</td>
                <td>{{ $task->governorates ?? ''}}</td>
                <td>{{ $task->starting_date ?? ''}}</td>
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
                            <a href="{{ route('admin.tasks.show', [$task->id]) }}" class="menu-link px-3">&nbsp;&nbsp; عرض</a>
                        </div>
                    
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
