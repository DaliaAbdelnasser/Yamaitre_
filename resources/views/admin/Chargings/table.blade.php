<!--begin::Table-->
<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
    <!--begin::Table head-->
    <thead>
        <!--begin::Table row-->
        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
            <th class="min-w-125px text-center">كود الشحن</th>
            <th class="min-w-125px text-center">صاحب العملية</th>
            <th class="min-w-125px text-center">الايميل</th>
            <th class="min-w-125px text-center"> رقم الهاتف</th>
            <th class="min-w-125px text-center"> قيمة الشحن</th>
        </tr>
        <!--end::Table row-->
    </thead>
    <!--end::Table head-->
    <!--begin::Table body-->
    <tbody class="text-gray-600 fw-bold">
        @foreach ($charging as $charge)
        <!--begin::Table row-->
        <tr>
            <!--begin::User=-->
            <td class="text-center">
                {{ $charge->ref_code ?? ''}}
            </td>
            <td class="text-center">
                {{ $charge->first_name ?? ''}} {{ $charge->last_name ?? ''}}
            </td>
            <!--end::Last login=-->
            <!--begin::Joined-->
            <td class="text-center">{{ $charge->email }}</td>
            <td class="text-center">{{ $charge->phone }}</td>
           
            <td class="text-center">{{ $charge->amount }}</td>
           
            
            <!--begin::Joined-->
            
        </tr>
        <!--end::Table row-->

   
        @endforeach
    </tbody>
    <!--end::Table body-->
</table>
<!--end::Table-->

@include('partials._pagination', ['records' => $charging])

