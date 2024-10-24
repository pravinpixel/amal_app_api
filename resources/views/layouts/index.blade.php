<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@yield('title',  config('app.name') )</title>
    <meta charset="utf-8"/>
    <meta name="description" content="Star Health Admin"/>
    <meta name="keywords" content="admin"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="Star Health"/>
    <meta property="og:site_name" content="Star Health | Admin"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('images/Group.png') }}"/>
    @section('style')
        <link rel="stylesheet" href="{{ asset('plugins/global/plugins.bundle.css') }}"/>
        <link rel="stylesheet" href="{{ asset('css/style.bundle.css') }}"/>
         <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
    @show
</head>
<body id="kt_app_body" data-kt-app-layout="light-sidebar" data-kt-app-sidebar-enabled="true"
      data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true"
      data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true"
      class="app-default">
<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
    <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
        @include('layouts.header')
        <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
            @include('layouts.sidebar')
            <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <div id="kt_app_content" class="app-content flex-column-fluid">
                        <div id="kt_app_content_container" class="app-container container-fluid">
                            @yield('content')
                    </div>
                </div>
                @include('layouts.footer')
            </div>
        </div>
    </div>
</div>
@section('script')
    <script src="{{ asset('plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('js/common.js') }}"></script>
    <script src="{{ asset('plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
    <script src="{{ asset('plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>
    <script src="{{ asset('js/utils.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>
@if($message = Session::get('success'))
<script type="text/javascript">
toastr.success("{{ $message }}");
</script>
@endif
@show
</body>
</html>
