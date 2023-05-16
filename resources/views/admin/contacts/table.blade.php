<!--begin::Table-->
<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
    <!--begin::Table head-->
    <thead>
        <!--begin::Table row-->
        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
            <th class="min-w-125px text-center">الأسم</th>
            <th class="min-w-125px text-center"> البريد الإلكتروني</th>
            <th class="min-w-125px text-center">رقم الهاتف</th>
            <th class="min-w-125px text-center">الموضوع</th>
            <th class="min-w-125px text-center"> الرسالة</th>
        </tr>
        <!--end::Table row-->
    </thead>
    <!--end::Table head-->
    <!--begin::Table body-->
    <tbody class="text-gray-600 fw-bold">
        @foreach ($contacts as $contact)
        @if($contact != null)
        <!--begin::Table row-->
        <tr>
            <!--begin::User=-->
            <td class="text-center">
                {{ $contact->name ?? ''}}
            </td>
            <td class="text-center">
                {{ $contact->email ?? ''}}
            </td>
            <!--end::Last login=-->
            <!--begin::Joined-->
            <td class="text-center">{{ $contact->phone ?? ''}}</td>
            <td class="text-center">{{ $contact->subject ?? ''}}</td>
            <td class="text-center">{{ $contact->message ?? ''}}</td>
            
            <!--begin::Joined-->
            
        </tr>
        <!--end::Table row-->
        @endif
        @endforeach
    </tbody>
    <!--end::Table body-->
</table>
<!--end::Table-->

@include('partials._pagination', ['records' => $contacts])

