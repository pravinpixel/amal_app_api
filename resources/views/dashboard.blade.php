@extends('layouts.index')

@section('title', 'Dashboard')

@section('style')
@parent
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    th {
        font-size: 16px
    }

    td,
    th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    .box {
        transition: transform .6s;

    }

    .box:hover {
        -ms-transform: scale(1);
        -webkit-transform: scale(1);
        transform: scale(1.2);
    }

    .list:hover {
        color: black !important;
    }
</style>
@endsection

@section('content')
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                Dashboard</h1>
        </div>
        <!--end::Page title-->
    </div>
    <!--end::Toolbar container-->
</div>
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container">
        <div class="card">
            <div class="card-header border-3 pt-6">
                <div class="card-body pt-0">
                    <div class="row mt-12 mb-12" style="display: flex;justify-content:space-between;">
                        <div class="col-md-6">
                            <table>
                                <tr>
                                    <th>As on date</th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <td>Total Enrollment</td>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <td>Total Submission Completed</td>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <td>Total Incomplete</td>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <td>Total Basic null</td>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <td>Total Basic</td>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <td>Total No Uploads</td>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <td>Total Partial Uploads</td>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <td>Total Summary</td>
                                    <td>2</td>
                                </tr>

                                <tr>
                                    <td>Total Shortlisted</td>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <td>Total Finalist</td>
                                    <td>2</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table>
                                <tr>
                                    <th>{{ date('M d Y') }}</th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <td>Total Enrollment</td>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <td>Total Submission Completed</td>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <td>Total Incomplete</td>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <td>Total Basic null</td>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <td>Total Basic</td>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <td>Total No Uploads</td>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <td>Total Partial Uploads</td>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <td>Total Summary</td>
                                    <td>2</td>
                                </tr>

                                <tr>
                                    <td>Total Shortlisted</td>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <td>Total Finalist</td>
                                    <td>2</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@parent

@endsection
