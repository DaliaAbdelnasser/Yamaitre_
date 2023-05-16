<!--begin::Table-->
<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
    <!--begin::Table head-->
    <thead>
        <!--begin::Table row-->
        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
            <th class="min-w-125px">الاسم</th>
            <th class="min-w-100px">الاجراءات</th>
        </tr>
        <!--end::Table row-->
    </thead>
    <!--end::Table head-->
    <!--begin::Table body-->
    <tbody class="text-gray-600 fw-bold">
        @foreach ($roles as $role)
        <!--begin::Table row-->
        <tr>
            <!--begin::User=-->
            <td class="d-flex align-items-center">
                <!--begin:: Avatar -->
                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                    <a href="{{ route('admin.roles.edit', $role->id) }}">
                        <div class="symbol-label fs-3 bg-light-danger text-danger">{{ strtoupper(substr($role->name ?? '', 0, 1)) }}</div>
                    </a>
                </div>
                <!--end::Avatar-->
                <!--begin::User details-->
                <div class="d-flex flex-column">
                    <a href="{{ route('admin.roles.edit', $role->id) }}" class="text-gray-800 text-hover-primary mb-1">{{ $role->name ?? ''}}</a>
                </div>
                <!--begin::User details-->
            </td>
            <!--end::User=-->
            @if ($role->id != 1)
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
                        {{-- @can('roles edit') --}}
                        <a href="{{ route('admin.roles.edit', $role->id) }}" class="menu-link px-3">تعديل</a>
                        {{-- @endcan --}}
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        {!! Form::open(['route' => ['admin.roles.destroy', $role->id], 'method' => 'delete']) !!}
                        {{-- @can('roles delete') --}}
                        {!! Form::button('حذف', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "هل انت متأكد من ذلك"]) !!}
                        {{-- @endcan --}}
                        {!! Form::close() !!}
                    </div>
                    <!--end::Menu item-->
                </div>
                <!--end::Menu-->
            </td>
            <!--end::Action=-->
            @endif
        </tr>
        <!--end::Table row-->
        @endforeach
    </tbody>
    <!--end::Table body-->
</table>
<!--end::Table-->

{{-- <div class="table-responsive-sm">
    <table class="table table-striped" id="roles-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->name }}</td>
                    <td>
                        {!! Form::open(['route' => ['admin.roles.destroy', $role->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('admin.roles.show', [$role->id]) }}" class='btn btn-ghost-success'><i
                                    class="fa fa-eye"></i></a>

                            @if ($role->id != 1)

                                @can('roles edit')
                                    <a href="{{ route('admin.roles.edit', [$role->id]) }}" class='btn btn-ghost-info'><i
                                            class="fa fa-edit"></i></a>
                                @endcan

                                @can('roles delete')
                                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                @endcan

                            @endif
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div> --}}
