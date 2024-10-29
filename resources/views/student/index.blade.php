@extends('layouts.index')
@section('title', 'Student')
@section('style')
@parent
<style>
    .page-loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: none;
        z-index: 9999;
    }

    .loader {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        border: 4px solid #f3f3f3;
        border-top: 4px solid #3498db;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        animation: spin 2s linear infinite;
    }


    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>
@endsection
@section('content')
<div id="pageLoader" class="page-loader">
    <div class="loader"></div>
</div>
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="app-main flex-column flex-row-fluid-xxl" id="kt_app_main">
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        Student</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{url('dashboard')}}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Student</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <div class="m-0">
                    </div>
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container">
                <div class="card">
                    <div class="card-header border-0 pt-6">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1">
                                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                            transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                        <path
                                            d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                                <input type="text" id="searchInput"
                                    class="form-control form-control-solid w-350px ps-15"
                                    placeholder="Search Student" />
                            </div>
                        </div>
                        <div class="card-toolbar" style="gap: 25px">
                            <div>
                                <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="tooltip"
                                    id="filter_panel">
                                    <i class="fa-solid fa-filter"><span class="path1"></span><span
                                            class="path2"></span></i>
                                    Filter
                                </button>
                            </div>
                            <!-- <div>
                                <a type="button" class="btn btn-primary" href="{{url('student/create')}}">Create
                                    New</a>
                            </div> -->
                        </div>
                    </div>
                    @include('student.filter')                    <div class="card-body pt-0">
                        <div style="overflow-x:auto;">
                            <table style="width:100%;" class="table align-middle table-row-dashed fs-6 gy-5"
                                id="kt_students_table">
                                <thead style="color: #3498db">
                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0"
                                        style="color:#3498db !important">
                                        <th class="min-w-125px">Student Name</th>
                                        <th class="min-w-125px">Father Name</th>
                                        <th class="min-w-125px">Mother Name</th>
                                        <th class="min-w-125px">Gender</th>
                                        <th class="min-w-125px">DOB</th>
                                        <th class="min-w-125px">TC SL No</th>
                                        <th class="min-w-125px">Reg No</th>
                                        <th class="min-w-125px">Admission No</th>
                                        <th class="min-w-125px">Year</th>
                                        <th class="min-w-125px">Email</th>
                                        <th class="min-w-125px">Phone Number</th>
                                        <th class="min-w-115px">Status</th>
                                        <th class="min-w-175px" style="text-align: center">View /Delete</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                    @if($students->isEmpty())
                                        <tr>
                                            <td colspan="9" class="text-center">No results found.</td>
                                        </tr>
                                    @else
                                        @foreach($students as $student)
                                            <tr>
                                                <td>{{$student->name}}</td>
                                                <td>{{$student->fatherName}}</td>
                                                <td>{{$student->motherName}}</td>
                                                <td>{{$student->gender}}</td>
                                                <td>{{$student->dob}}</td>
                                                <td>{{$student->tcslno}}</td>
                                                <td>{{$student->regNo}}</td>
                                                <td>{{$student->adminNo}}</td>
                                                <td>{{$student->year}}</td>
                                                <td>{{$student->email}}</td>
                                                <td>{{$student->phoneNumber}}</td>
                                                <td>@if($student->status == 1)
                                                    <div class="badge badge-light-success">Active</div>
                                                @else
                                                    <div class="badge badge-light-danger"> In Active</div>
                                                @endif
                                                </td>
                                                <td class="td" style="text-align: center">
                                                    <a href="{{route('student.view', $student->id)}}"
                                                        class="btn btn-icon btn-active-primary btn-light-primary mx-1 w-30px h-30px ">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <!-- <a href="{{route('student.edit', $student->id)}}"
                                                                                class="btn btn-icon btn-active-primary btn-light-primary mx-1 w-30px h-30px ">
                                                                                <i class="fa fa-edit"></i>
                                                                            </a> -->
                                                    <button type="button"
                                                        class="btn btn-icon btn-active-danger btn-light-danger mx-1 w-30px h-30px deletestudentBtn"
                                                        data-student-id="{{ $student->id }}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="show-pg">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-0 col-sm-0">
                            </div>
                            <div id="paginationLinks" class="col-lg-4 col-md-6 col-sm-12">
                                {{ $students->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="routename" id="routename" value="{{route(Route::currentRouteName()) }}">
@endsection
@section('script')
@parent
<script>
    $(document).ready(function () {
        var routename = $('#routename').val();
        $('#searchInput').keyup(function () {
            updateTableData();
        });
        $(document).on('change', '[name="insurance_type"]', function (e) {
            updateTableData();
        });
        $(document).on('change', '[name="state"]', function (e) {
            updateTableData();
        });
        $(document).on('change', '[name="language"]', function (e) {
            updateTableData();
        });
        $(document).on('change', '[name="testimonial_category"]', function (e) {
            updateTableData();
        });
        $(document).on('click', '#paginationLinks a', function (e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            updateTableData(page);
        });
        $(document).on('click', '#filter_panel', function (e) {
            $("#filter_sub").toggle();
        });
        $(window).on('beforeunload', function () {
            $('#searchInput').val('');
            $('[name="testimonial_category"]').val('');
            $('[name="state"]').val('');
            $('[name="language"]').val('');
            $('[name="insurance_type"]').val('');
        });
        function updateTableData(page = '') {
            var searchTerm = $('#searchInput').val();
            var insurance_type = $('[name="insurance_type"]').val();
            var state = $('[name="state"]').val();
            var language = $('[name="language"]').val();
            var testimonial_category = $('[name="testimonial_category"]').val();
            loadTableData(searchTerm, insurance_type, state, testimonial_category, language, page);
        }
        updateTableData();
        function loadTableData(searchTerm, insurance_type, state, testimonial_category, language, page = '') {
            $.ajax({
                url: routename + "?search=" + searchTerm + "&insurance_type=" + insurance_type + "&language=" + language + "&testimonial_category=" + testimonial_category + "&page=" + page + "&state=" + state,
                type: "GET",
                data: {
                    search: searchTerm,
                    insurance_type: insurance_type,
                    state: state,
                    language: language,
                    testimonial_category: testimonial_category,
                    page: page
                },
                dataType: 'html',
                success: function (response) {
                    $('#kt_students_table tbody').html($(response).find('#kt_students_table tbody').html());
                    $('#paginationLinks').html($(response).find('#paginationLinks').html());
                },
                error: function () {
                    console.error('Error loading table data.');
                }
            });
        }
        function refreshTableContent() {
            $.ajax({
                url: routename,
                type: "GET",
                dataType: 'html',
                success: function (response) {
                    $('#kt_students_table tbody').html($(response).find('#kt_students_table tbody').html());
                    updateTableData();
                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error:', error);
                }
            });
        }
        $(document).on('click', '.deletestudentBtn', function () {
            var studentId = $(this).data('student-id');
            Swal.fire({
                text: "Are you sure you would like to delete?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, return",
                customClass: {
                    confirmButton: "btn btn-danger",
                    cancelButton: "btn btn-active-light"
                }
            }).then(function (result) {
                if (result.isConfirmed) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: 'delete/' + studentId,
                        type: 'DELETE',
                        success: function (res) {
                            Swal.fire({
                                title: "Deleted!",
                                text: res.message,
                                icon: "success",
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-success"
                                },
                                timer: 3000,
                            });
                            refreshTableContent();
                        }
                    });
                }
            });
        });
    });
</script>
@endsection
