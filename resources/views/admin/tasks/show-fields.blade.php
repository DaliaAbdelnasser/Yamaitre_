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
					<div class="symbol symbol-100px symbol-circle mb-7">
						<img src="{{ asset('uploads/logo.png') }}" alt="image" />
					</div>
					<!--end::Avatar-->
					<!--begin::Name-->
					<a class="fs-3 text-gray-800 text-hover-primary fw-bolder mb-3">{{ $task->title }}</a>
					<!--end::Name-->
					<!--begin::Position-->
					<div class="mb-9">
						<!--begin::Badge-->
						<div class="badge badge-lg badge-light-primary d-inline">@if($task->status == 'todo') مهمة مطلوبة @elseif ($task->status == 'inprogress') قيد التنفيذ @elseif ($task->status == 'inreview') قيد المراجعة @elseif ($task->status == 'completed') مكنملة@endif</div>
						
						<!--begin::Badge-->
					</div>
					<!--end::Position-->
					{{-- <!--begin::Info-->
					<!--begin::Info heading-->
					<div class="fw-bolder mb-3">Assigned Tickets
					<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="Number of support tickets assigned, closed and pending this week."></i></div>
					<!--end::Info heading-->
					<div class="d-flex flex-wrap flex-center">
						<!--begin::Stats-->
						<div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
							<div class="fs-4 fw-bolder text-gray-700">
								<span class="w-75px">243</span>
								<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
								<span class="svg-icon svg-icon-3 svg-icon-success">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
										<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
									</svg>
								</span>
								<!--end::Svg Icon-->
							</div>
							<div class="fw-bold text-muted">Total</div>
						</div>
						<!--end::Stats-->
						<!--begin::Stats-->
						<div class="border border-gray-300 border-dashed rounded py-3 px-3 mx-4 mb-3">
							<div class="fs-4 fw-bolder text-gray-700">
								<span class="w-50px">56</span>
								<!--begin::Svg Icon | path: icons/duotune/arrows/arr065.svg-->
								<span class="svg-icon svg-icon-3 svg-icon-danger">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<rect opacity="0.5" x="11" y="18" width="13" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
										<path d="M11.4343 15.4343L7.25 11.25C6.83579 10.8358 6.16421 10.8358 5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75L11.2929 18.2929C11.6834 18.6834 12.3166 18.6834 12.7071 18.2929L18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25C17.8358 10.8358 17.1642 10.8358 16.75 11.25L12.5657 15.4343C12.2533 15.7467 11.7467 15.7467 11.4343 15.4343Z" fill="currentColor" />
									</svg>
								</span>
								<!--end::Svg Icon-->
							</div>
							<div class="fw-bold text-muted">Solved</div>
						</div>
						<!--end::Stats-->
						<!--begin::Stats-->
						<div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
							<div class="fs-4 fw-bolder text-gray-700">
								<span class="w-50px">188</span>
								<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
								<span class="svg-icon svg-icon-3 svg-icon-success">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
										<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
									</svg>
								</span>
								<!--end::Svg Icon-->
							</div>
							<div class="fw-bold text-muted">Open</div>
						</div>
						<!--end::Stats-->
					</div>
					<!--end::Info--> --}}
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
					{{-- <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="تعديل">
						<a href="{{ route('admin.tasks.edit', $lawyer->id) }}" class="btn btn-sm btn-light-primary" >تعديل</a>
					</span> --}}
					
				</div>
				<!--end::Details toggle-->
				<div class="separator"></div>
				<!--begin::Details content-->
				<div id="kt_user_view_details" class="collapse show">
					<div class="pb-5 fs-6">
						<!--begin::Details item-->
						<div class="fw-bolder mt-5">تاريخ نشر المهمة</div>
						<div class="text-gray-600">{{ $task->created_at->translatedFormat('j F Y') ?? '' }}</div>
						<!--begin::Details item-->
						<!--begin::Details item-->
						<div class="fw-bolder mt-5">التكلفة</div>
						<div class="text-gray-600">
							<a class="text-gray-600 text-hover-primary">{{ $task->price ?? '' }} جنيه</a>
						</div>
						<!--begin::Details item-->
						<!--begin::Details item-->
						<div class="fw-bolder mt-5">المحكمة المختصة</div>
						<div class="text-gray-600">{{ $task->court ?? '' }}</div>
						<!--begin::Details item-->
						<div class="fw-bolder mt-5">المحكمة التابع لها</div>
						<div class="text-gray-600">{{ $task->governorates ?? '' }}</div>
						<!--begin::Details item-->
						{{-- @if($lawyer->userable->id_photo != null) --}}
						<div class="fw-bolder mt-5">التفاصيل</div>
						<div class="text-gray-600">{{ $task->description ?? '' }}</div>
						{{-- @endif --}}
						<!--begin::Details item-->
						<div class="fw-bolder mt-5">عدد المتقدمين للمهمة</div>
						<div class="text-gray-600">{{ $task->applicantlawyers_count }}</div>
						<!--begin::Details item-->
						<!--begin::Details item-->
						@if($task->task_file)
						<div class="fw-bolder mt-5">ملف المهمة</div>
						<div class="text-gray-600"><a href="{{ asset('uploads/'.$task->task_file ?? '') }}" target="_blank">اضغط هنا لتحميل الملف</a></div>
						@endif
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
					<h3>صاحب المهمة</h3>
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
						<div class="text-gray-600">{{ $task->user->first()->first_name ?? '' }} {{ $task->user->first()->last_name ?? '' }}</div>
						<!--begin::Details item-->
						<!--begin::Details item-->
						<div class="fw-bolder mt-5">البريد الإلكتروني</div>
						<div class="text-gray-600">
							<a class="text-gray-600 text-hover-primary">{{ $task->user->first()->email ?? '' }}</a>
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
					<a href="{{ route('admin.lawyers.show', $task->user->first()->id) }}" class="btn btn-sm btn-primary fw-bolder" >المزيد عن المحامي</a>
				</span>
			</div>
		</div>

		@if (count($task->assignedlawyers))
		<div class="card mt-8">
			<!--begin::Card header-->
			<div class="card-header border-0 py-3">
				<!--begin::Card title-->
				<div class="card-title">
					<h3>القائم بالمهمة</h3>
				</div>
				<!--begin::Card title-->
				<!--begin::Card toolbar-->

				<!--end::Card toolbar-->
			</div>
			<!--end::Card header-->
			<div class="card-body">
				@include('admin.tasks.assigned-table')
			</div>
		</div>
		@endif

		@if (count($task->applicantlawyers))
		<div class="card mt-8">
			<!--begin::Card header-->
			<div class="card-header border-0 py-3">
				<!--begin::Card title-->
				<div class="card-title">
					<h3>المتقدمون للمهمة</h3>
				</div>
				<!--begin::Card title-->
				<!--begin::Card toolbar-->

				<!--end::Card toolbar-->
			</div>
			<!--end::Card header-->
			<div class="card-body">
				@include('admin.tasks.applicants-table')
			</div>
		</div>
		@endif

	</div>
	<!--end::Content-->
</div>
<!--end::Layout-->


{{-- <div class="row">
    <div class="col-xs-6 col-md-4">
        <div class="d-flex flex-center flex-column">
            <img src="{{ asset('uploads/' . $task->user->first()->userable->profile_image) }}" width="200" height="200"
                        alt="" style="border-radius:50%"/>
            <br>
            <h4><a href="{{ route('admin.lawyers.show', $task->user->first()->id) }}" class="text-gray-800 fw-bold text-hover-primary mb-1">{{ $task->user->first()->name }}</a></h4>
        
        </div>
    </div>
    <div class="col-xs-6 col-md-8" style="font-size:1.2em">
        <br>
        <br>
        <div class="row">
            <div class="col-md-6">
                <label for="starting_date" class="text-dark-600 fw-bold"> تاريخ نشر المهمة :</label>
                <label id="starting_date" class="text-gray-600 ">&nbsp;{{ $task->starting_date }}</label>
            </div>
    
            <div class="col-md-6">
                <label for="court" class="text-dark-600 fw-bold">المحكمة المختصة :</label>
                <label id="court" class="text-gray-600 ">&nbsp;{{ $task->court }}</label>
            </div> 
        </div>
        <br>
        <div class="row"> 
            <div class="col-md-6 sm-5">
                <label for="governorates" class="text-dark-600 fw-bold">المحافظة :</label>
                <label id="governorates" class="text-gray-600 ">&nbsp;{{ $task->governorates }}</label>
            </div>
            <div class="col-md-6">
                <label for="discription" class="text-dark-600 fw-bold">الوصف :</label>
                <label id="discription" class="text-gray-600 ">&nbsp;{{ $task->description }}</label>
            </div>
        </div>
            <br>
        <div class="row">
            <div class="col-md-6">
                <label for="price" class="text-dark-600 fw-bold">السعر :</label>
                <label id="price" class="text-gray-600 ">&nbsp;{{ $task->price }}</label>
            </div>
            <div class="col-md-6">
                <label for="status" class="text-dark-600 fw-bold">الحالة :</label>
                @if ($task->status == 'todo')
                <div class="badge badge-lg badge-primary d-inline">قيد الإنتظار</div>
                @elseif ($task->status == 'inprogress')
                <div class="badge badge-lg badge-secondary d-inline">قيد التنفيذ</div>
                @elseif ($task->status == 'inreview')
                <div class="badge badge-lg badge-danger d-inline">قيد المراجعة</div>
                @else
                <div class="badge badge-lg badge-success d-inline">مكتملة</div>
                @endif
                <label id="status" class="text-gray-600 ">&nbsp;{{ $task->status }}</label>
            </div>
        </div>
        <br>
        <div class="row">
            @if ($task->applicantlawyers_count > 0 && $task->status == 'todo')
            <div class="col-md-6">
                <label for="count" class="text-dark-600 fw-bold">عدد المتقدمين للمهمة :</label>
                <label id="count" class="text-gray-600 ">&nbsp;{{ $task->applicantlawyers_count }}</label>
            </div>
            @elseif ($task->applicantlawyers_count == 0 && $task->status == 'todo')
            <div class="col-md-6">
                <label for="count" class="text-dark-600 fw-bold">عدد المتقدمين للمهمة :</label>
                <label id="count" class="text-gray-600 ">&nbsp;لم يتقدم أحد حتى الآن</label>
            </div>
            @endif
            @if($task->task_file != null)
            <div class="col-md-6">
                <label for="task_file" class="text-dark-600 fw-bold">ملف المهمة :</label>
                <a href="{{ asset('uploads/' . $task->task_file) }}" id="task_file"  class="text-gray-600 ">{{ $task->task_file }}</a>
            </div>
            @endif
        </div>
    </div>
</div> --}}







