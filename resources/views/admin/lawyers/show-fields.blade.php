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
						<img src="{{ asset('uploads/' . $lawyer->userable->profile_image) }}" alt="image" />
					</div>
					<!--end::Avatar-->
					<!--begin::Name-->
					<a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bolder mb-3">{{ $lawyer->first_name }} {{ $lawyer->last_name }}</a>
					<!--end::Name-->
					<!--begin::Position-->
					<div class="mb-9">
						<!--begin::Badge-->
						<div class="badge badge-lg badge-light-primary d-inline">محامي</div>
						<!--begin::Badge-->
					</div>

					@if ($lawyer->userable->status == false )
						<!--begin::Menu item-->
						<div class="menu-item px-3">
                            {!! Form::open(['route' => ['admin.lawyers.activate', $lawyer->id], 'method' => 'post']) !!}
                            {!! Form::button('تفعيل', ['type' => 'submit', 'class' => 'btn btn-sm btn-primary fw-bolder']) !!}
                            {!! Form::close() !!}
						</div>
						<!--end::Menu item-->
					@endif
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
					{{-- <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="تعديل">
						<a href="{{ route('admin.lawyers.edit', $lawyer->id) }}" class="btn btn-sm btn-light-primary" >تعديل</a>
					</span> --}}
				</div>
				<!--end::Details toggle-->
				<div class="separator"></div>
				<!--begin::Details content-->
				<div id="kt_user_view_details" class="collapse show">
					<div class="pb-5 fs-6">
						<!--begin::Details item-->
						<div class="fw-bolder mt-5">رقم الهاتف</div>
						<div class="text-gray-600">{{ $lawyer->phone ?? '' }}</div>
						<!--begin::Details item-->
						<!--begin::Details item-->
						<div class="fw-bolder mt-5">البريد الإلكتروني</div>
						<div class="text-gray-600">
							<a class="text-gray-600 text-hover-primary">{{ $lawyer->email ?? '' }}</a>
						</div>
						<!--begin::Details item-->
						<!--begin::Details item-->
						<div class="fw-bolder mt-5">المحافظة</div>
						<div class="text-gray-600">{{ $lawyer->userable->governorates ?? '' }}</div>
						<!--begin::Details item-->
						<div class="fw-bolder mt-5">المحكمة التابع لها</div>
						<div class="text-gray-600">{{ $lawyer->userable->court_name ?? '' }}</div>
						<!--begin::Details item-->
						@if($lawyer->userable->id_photo != null)
						<div class="fw-bolder mt-5">صورة الكارنيه</div>
						<div class="text-gray-600"><a href="{{ asset('uploads/'.$lawyer->userable->id_photo ?? '') }}" target="_blank">اضغط هنا لتحميل صورة الكارنيه</a></div>

						@endif
						<!--begin::Details item-->
						<div class="fw-bolder mt-5">عدد المهام التي قام بها</div>
						<div class="text-gray-600">{{ $lawyer->userable->tasks_count ?? '' }}</div>
						<!--begin::Details item-->
						<div class="fw-bolder mt-5">التقييم</div>
						<div class="row">
						@php $rating = $lawyer->userable->rate; @endphp  
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
		<!--end:::Tabs-->
		<div class="card">
			<!--begin::Card header-->
			<div class="card-header border-0 py-3">
				<!--begin::Card title-->
				<div class="card-title">
					<h3>المهام المطلوبة من الغير</h3>
				</div>
				<!--begin::Card title-->
				<!--begin::Card toolbar-->
				
				<!--end::Card toolbar-->
			</div>
			<!--end::Card header-->
		</div>
		<!--begin:::Tabs-->
		<ul class="content nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold">
			<!--begin:::Tab item-->
			<li class="nav-item">
				<a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_tasks_tab">مهام مطلوبة من الغير</a>
			</li>
			<!--end:::Tab item-->
			<!--begin:::Tab item-->
			<li class="nav-item">
				<a class="nav-link text-active-primary pb-4" data-kt-countup-tabs="true" data-bs-toggle="tab" href="#kt_inprogress_tab">قيد التنفيذ</a>
			</li>
			<!--end:::Tab item-->
			<!--begin:::Tab item-->
			<li class="nav-item">
				<a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_inreview_tab">قيد المراجعة</a>
			</li>
			<!--end:::Tab item-->
			<!--begin:::Tab item-->
			<li class="nav-item">
				<a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_completed_tab">مهام مكتملة</a>
			</li>
			<!--end:::Tab item-->
		</ul>
		<!--begin:::Tab content-->
		<div class="tab-content" id="myTabContent">
			<!--begin:::Tab pane-->
			<div class="tab-pane fade active show" id="kt_tasks_tab" role="tabpanel">
				<!--begin::Card-->
				<div class="card card-flush mb-6 mb-xl-9">
					<div class="card-body p-9 pt-4">
					@include('admin.tasks.table')
					</div>
					<!--end::Card body-->
				</div>
				<!--end::Card-->
			</div>
			<!--end:::Tab pane-->
			<!--begin:::Tab pane-->
			<div class="tab-pane fade" id="kt_inprogress_tab" role="tabpanel">
				<!--begin::Card-->
				<div class="card card-flush mb-6 mb-xl-9">
					<div class="card-body p-9 pt-4">
					@include('admin.tasks.inprogress-table')
					</div>
					<!--end::Card body-->
				</div>
				<!--end::Card-->
			</div>
			<!--end:::Tab pane-->
			<!--begin:::Tab pane-->
			<div class="tab-pane fade" id="kt_inreview_tab" role="tabpanel">
				<!--begin::Card-->
				<div class="card card-flush mb-6 mb-xl-9">
					<!--begin::Card body-->
					<div class="card-body p-9 pt-4">
					@include('admin.tasks.inreview-table')
					</div>
					<!--end::Card body-->
				</div>
				<!--end::Card-->
			</div>
			<!--end:::Tab pane-->
			<!--begin:::Tab pane-->
			<div class="tab-pane fade" id="kt_completed_tab" role="tabpanel">
				<!--begin::Card-->
				<div class="card card-flush mb-6 mb-xl-9">
					<!--begin::Card body-->
					<div class="card-body p-9 pt-4">
					@include('admin.tasks.completed-table')
					</div>
					<!--end::Card body-->
				</div>
				<!--end::Card-->
			</div>
			<!--end:::Tab pane-->
		</div>
		<!--end:::Tab content-->
		<div class="card">
			<!--begin::Card header-->
			<div class="card-header border-0 py-3">
				<!--begin::Card title-->
				<div class="card-title">
					<h3>المهام لحساب الغير</h3>
				</div>
				<!--begin::Card title-->
				<!--begin::Card toolbar-->
				
				<!--end::Card toolbar-->
			</div>
			<!--end::Card header-->
		</div>
		<ul class="content nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold">
			<!--begin:::Tab item-->
			<li class="nav-item">
				<a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_others_tasks_tab">مهام لحساب الغير</a>
			</li>
			<!--end:::Tab item-->
			<!--begin:::Tab item-->
			<li class="nav-item">
				<a class="nav-link text-active-primary pb-4" data-kt-countup-tabs="true" data-bs-toggle="tab" href="#kt_others_inprogress_tab">قيد التنفيذ</a>
			</li>
			<!--end:::Tab item-->
			<!--begin:::Tab item-->
			<li class="nav-item">
				<a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_others_inreview_tab">قيد المراجعة</a>
			</li>
			<!--end:::Tab item-->
			<!--begin:::Tab item-->
			<li class="nav-item">
				<a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_others_completed_tab">مهام مكتملة</a>
			</li>
			<!--end:::Tab item-->
		</ul>
		<div class="tab-content" id="myTabContent">
			<!--begin:::Tab pane-->
			<div class="tab-pane fade active show" id="kt_others_tasks_tab" role="tabpanel">
				<!--begin::Card-->
				<div class="card card-flush mb-6 mb-xl-9">
					<div class="card-body p-9 pt-4">
					@include('admin.tasks.others-table')
					</div>
					<!--end::Card body-->
				</div>
				<!--end::Card-->
			</div>
			<!--end:::Tab pane-->
			<!--begin:::Tab pane-->
			<div class="tab-pane fade" id="kt_others_inprogress_tab" role="tabpanel">
				<!--begin::Card-->
				<div class="card card-flush mb-6 mb-xl-9">
					<!--begin::Card body-->
					<div class="card-body p-9 pt-4">
					@include('admin.tasks.others-inprogress-table')
					</div>
					<!--end::Card body-->
				</div>
				<!--end::Card-->
			</div>
			<!--end:::Tab pane-->
			<!--begin:::Tab pane-->
			<div class="tab-pane fade" id="kt_others_inreview_tab" role="tabpanel">
				<!--begin::Card-->
				<div class="card card-flush mb-6 mb-xl-9">
					<!--begin::Card body-->
					<div class="card-body p-9 pt-4">
					@include('admin.tasks.others-inreview-table') 
					</div>
					<!--end::Card body-->
				</div>
				<!--end::Card-->
			</div>
			<!--end:::Tab pane-->
			<!--begin:::Tab pane-->
			<div class="tab-pane fade" id="kt_others_completed_tab" role="tabpanel">
				<!--begin::Card-->
				<div class="card card-flush mb-6 mb-xl-9">
					<!--begin::Card body-->
					<div class="card-body p-9 pt-4">
					@include('admin.tasks.others-completed-table')
					</div>
					<!--end::Card body-->
				</div>
				<!--end::Card-->
			</div>
			<!--end:::Tab pane-->
		</div>
	</div>
	<!--end::Content-->
</div>
<!--end::Layout-->