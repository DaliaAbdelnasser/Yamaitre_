<!--begin::Layout-->
<div class="d-flex flex-column flex-lg-row">
	<!--begin::Sidebar-->
	<div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-10">
		<!--begin::Card-->
		<div class="card mb-5 mb-xl-8">
			<!--begin::Card body-->
			<div class="card-body">
				<!--begin::Summary-->
				<!--begin::User Info-->
				<div class="d-flex flex-center flex-column py-5">
					<!--begin::Avatar-->
                    @if ($announcement->image)
                    <div>
                        <img src="{{ asset('uploads/' . $announcement->image ?? '') }}" width="300" height="100" alt="announcement" />                    
                    </div>
                    @endif
					<!--end::Avatar-->
					<!--begin::Name-->
					<a class="fs-3 text-gray-800 text-hover-primary fw-bolder mb-3">{{$places[$announcement->place] ?? ''}}</a>
					<!--end::Name-->
					<!--begin::Position-->
					<div class="mb-9">
						<!--begin::Badge-->
						<div class="badge badge-lg badge-light-primary d-inline">@if($announcement->status == 0) لم يتم نشر الاعلان @elseif($announcement->status == 1)  تم نشر الاعلان  @else الاعلان منتهي @endif</div>
						
						<!--begin::Badge-->
					</div>
					<!--end::Position-->
				</div>
				<!--end::User Info-->
				<!--end::Summary-->
				<!--begin::Details toggle-->
				<div class="d-flex flex-stack fs-4 py-3">
					<div class="fw-bolder rotate collapsible" data-bs-toggle="collapse" href="#kt_user_view_details" role="button" aria-expanded="false" aria-controls="kt_user_view_details">التفاصيل
					<span class="ms-2 rotate-180">
						<!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
						<span class="svg-icon svg-icon-3">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
							</svg>
						</span>
						<!--end::Svg Icon-->
					</span></div>
					<span data-bs-toggle="tooltip" data-bs-trigger="hover" title="تعديل">
						<a href="{{ route('admin.announcements.edit', $announcement->id ?? '') }}" class="btn btn-sm btn-light-primary" >تعديل</a>
					</span>
					
				</div>
				<!--end::Details toggle-->
				<div class="separator"></div>
				<!--begin::Details content-->
				<div id="kt_user_view_details" class="collapse show">
					<div class="pb-5 fs-6">
						<!--begin::Details item-->
						<div class="fw-bolder mt-5">مكان الاعلان</div>
						<div class="text-gray-600">
							<a class="text-gray-600 text-hover-primary">{{$places[$announcement->place] ?? ''}}</a>
						</div>
						<!--begin::Details item-->
						<div class="fw-bolder mt-5"> من يمكنه الإطلاع</div>
						<div class="text-gray-600">@if($announcement->usertype == 'lawyer') اظهار للمحامين @elseif($announcement->usertype == 'client') اظهار للموكلين @elseif($announcement->usertype == 'all') اظهار للكل @else لم يتحدد بعد @endif</div>
						<div class="fw-bolder mt-5"> مدة الاعلان</div>
						<div class="text-gray-600">{{ $announcement->period ?? '' }} يوم</div>
						<!--begin::Details item-->
						<div class="fw-bolder mt-5">تكلفة الاعلان</div>
						<div class="text-gray-600">{{ $announcement->price ?? '' }} جنيه</div>
                        <!--begin::Details item-->
						<div class="fw-bolder mt-5">تاريخ طلب الاعلان</div>
						<div class="text-gray-600">{{ $announcement->created_at->translatedFormat('j F Y') ?? '' }}</div>
						<!--begin::Details item-->
						<div class="fw-bolder mt-5">تاريخ نشر الاعلان</div>
						<div class="text-gray-600">{{ $announcement->updated_at->translatedFormat('j F Y') ?? '' }}</div>
						<!--begin::Details item-->
						<div class="fw-bolder mt-5"></div>
					</div>
				</div>
				<!--end::Details content-->
			</div>
			<!--end::Card body-->
		</div>
		<!--end::Card-->
	</div>
	<!--end::Sidebar-->
	<!--begin::Content-->
	<div class="flex-lg-row-fluid ms-lg-15">
		@include('flash::message')
		<div class="card">
			<!--begin::Card header-->
			<div class="card-header border-0 py-3">
				<!--begin::Card title-->
				<div class="card-title">
					<h3>صاحب الاعلان</h3>
				</div>
				<!--begin::Card title-->
				<!--begin::Card toolbar-->

				<!--end::Card toolbar-->
			</div>
			<!--end::Card header-->
			<div class="card-body">
				<div id="" class="">
					<div class="pb-5 fs-6">
						<!--begin::Details item-->
						<div class="fw-bolder mt-5">الاسم</div>
						<div class="text-gray-600">{{ $announcement->users->first()->first_name ?? '' }} {{ $announcement->users->first()->first_name ?? '' }}</div>
						<!--begin::Details item-->
						<!--begin::Details item-->
						<div class="fw-bolder mt-5">البريد الإلكتروني</div>
						<div class="text-gray-600">
							<a class="text-gray-600 text-hover-primary">{{ $announcement->users->first()->email ?? '' }}</a>
						</div>
						<!--begin::Details item-->
						<!--begin::Details item-->
						{{-- <div class="fw-bolder mt-5">المحافظة</div>
						<div class="text-gray-600">{{ $task->user->first()->userable->governorates ?? '' }}</div> --}}
						<!--begin::Details item-->
						{{-- <div class="fw-bolder mt-5">المحكمة التابع لها</div>
						<div class="text-gray-600">{{ $task->user->first()->userable->court_name ?? '' }}</div>					 --}}
					</div>
				</div>
				<span data-bs-toggle="tooltip" data-bs-trigger="hover">
					<a href="{{ route('admin.lawyers.show', $announcement->users->first()->id) }}" class="btn btn-sm btn-primary fw-bolder" >المزيد عن المحامي</a>
				</span>
			</div>
		</div>

	</div>
	<!--end::Content-->
</div>
<!--end::Layout-->










{{-- <div class="row">
    <div class="col-xs-6 col-md-4">
    <img src="{{ asset('uploads/' . $announcement->image) }}" width="300" height="100"
                    alt="" />
    </div>
    <div class="col-xs-6 col-md-8" style="font-size:1.2em">
        <label for="place">محل الإعلان :</label>
        <label id="place">{{ $announcement->place }}</label>
        <hr>
        <label for="period">المدة :</label>
        <label id="period">{{ $announcement->period }}</label>
        <hr>
        <label for="created_at">تاريخ النشر :</label>
        <label id="created_at">{{ $announcement->created_at }}</label>
        <hr>
        <label for="price">التكلفة :</label>
        <label id="price">{{ $announcement->price }}</label>
        <hr>
    </div>
</div> --}}







