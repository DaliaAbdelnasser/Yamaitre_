<!doctype html>
<html lang="ar" dir="rtl">

	<!--begin::Head-->
	<head><base href="../../../">
		<title>Ya maitre - Admin Panel</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
		<link rel="shortcut icon" href="{{ asset('uploads/logo.png') }}" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<link href="{{ asset('css/admin-app.css') }}" rel="stylesheet" type="text/css">
		<!--begin::Page Vendor Stylesheets(used by this page)-->
		{{-- <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" /> --}}
		<!--end::Page Vendor Stylesheets-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('frontend-assets/css/font-awesome.css') }}" rel="stylesheet">
		<link href="{{ asset('frontend-assets/css/flaticon.css') }}" rel="stylesheet">
		<!--end::Global Stylesheets Bundle-->

	</head>
	<!--end::Head-->

    <!--begin::Body-->
    <body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled  @if (Request::is('admin/login')) login-bg @else aside-fixed @endif " style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">

        <!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="page d-flex flex-row flex-column-fluid">
                @if (Auth::user('admin'))
				<!--begin::Aside-->
                    @include('partials._admin-sidebar')
				<!--end::Aside-->
                @endif
				<!--begin::Wrapper-->
				<div class="wrapper d-flex flex-column flex-row-fluid @if (Request::is('admin/login')) justify-content-center @endif" id="kt_wrapper">
                @if (Auth::user('admin'))
                    <!--begin::Header-->
                    <header>
                        @include('partials._admin-header')
                    </header>
                    <!--end::Header-->
                    @endif
                    <div id="kt_content" class="content d-flex flex-column flex-column-fluid">
                        @yield('content')
                    </div>
                    @if (Auth::user('admin'))
                    <!--begin::Footer-->
                    <footer>
                        @include('partials._admin-footer')
                    </footer>
					<!--end::Footer-->
                    @endif
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
        <!--end::Root-->

		<!--begin::Scrolltop-->
		<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
			<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
			<span class="svg-icon">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
					<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
					<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
				</svg>
			</span>
			<!--end::Svg Icon-->
		</div>
		<!--end::Scrolltop-->
		<!--begin::Javascript-->
		<script>var hostUrl = "assets/";</script>
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="assets/plugins/global/plugins.bundle.js"></script>
		<script src="assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Vendors Javascript(used by this page)-->
		{{-- <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script> --}}
		<!--end::Page Vendors Javascript-->
		<!--begin::Page Custom Javascript(used by this page)-->
		{{-- <script src="assets/js/custom/apps/user-management/users/list/table.js"></script> --}}
		{{-- <script src="assets/js/custom/apps/user-management/users/list/export-users.js"></script> --}}
		{{-- <script src="assets/js/custom/apps/user-management/users/list/add.js"></script> --}}
		<script src="assets/js/widgets.bundle.js"></script>
		<script src="assets/js/custom/widgets.js"></script>

		{{-- @if (!Request::is('admin/articles*')) --}}
		<script src="//cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
		<script>
			CKEDITOR.replace('description', {
				filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
				filebrowserUploadMethod: 'form'
			});
		</script>
		{{-- @endif --}}

		<!--end::Page Custom Javascript-->
		<!--end::Javascript-->

    </body>
    <!--end::Body-->
</html>
