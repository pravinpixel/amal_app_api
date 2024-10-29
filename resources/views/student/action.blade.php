@extends('layouts.index')
@section('title', 'Student')
@section('style')
@parent
<style>
    .new-date {
        background-color: red !important;
    }
</style>
@endsection
@section('content')
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Student</h1>
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
    </div>
</div>
<div class="card mb-5 mb-xl-8">
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold fs-3 mb-1">Basic Details</span>
        </h3>
        <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover"
            title="Click to add a user">
        </div>
    </div>
    <div class="card-body py-3">
        <form id="student_form" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" id="id" value="{{ $student->id ?? '' }}" />
            <div class="row mt-5">
                <div class="col-md-4" style="display: flex">
                    <div class="col-md-4 mt-3">
                        <label class="form-label">Student Name :</label>
                    </div>
                    <div class="col-md-7">
                        <input type="text" name="name" placeholder="Student Name" class="required form-control "
                            value="{{ $student->name ?? '' }}" autocomplete="off" />
                        <span class="field-error" style="color:red" id="name-error"></span>
                    </div>
                </div>
                <div class="col-md-4" style="display: flex">
                    <div class="col-md-4 mt-3">
                        <label class="form-label">Email :</label>
                    </div>
                    <div class="col-md-7">
                        <input type="text" name="email" placeholder="Email" class="required form-control"
                            value="{{ $student->email ?? '' }}" autocomplete="off" id="emailInput" />
                        <span class="field-error" style="color:red" id="email-error"></span>
                    </div>
                </div>
                <div class="col-md-4" style="display: flex">
                    <div class="col-md-5 mt-3">
                        <label class="form-label">Phone Number :</label>
                    </div>
                    <div class="col-md-7">
                        <input type="text" name="phoneNumber" placeholder="Phone Number" class="required form-control "
                            value="{{ $student->phoneNumber ?? '' }}" autocomplete="off" />
                        <span class="field-error" style="color:red" id="phoneNumber-error"></span>
                    </div>
                </div>
            </div>

            <div class="row mt-10">
                <div class="col-md-4" style="display: flex">
                    <div class="col-md-4 mt-3">
                        <label class="form-label">Date Of Birth :</label>
                    </div>


                    <div class="col-md-7">
                        <input type="date" name="dob" class="form-control " value="{{ $student->dob ?? '' }}"
                            autocomplete="off" />
                        <span class="field-error" style="color:red" id="dob-error"></span>
                    </div>
                </div>
                <div class="col-md-4" style="display: flex">
                    <div class="col-md-4 mt-3">
                        <label class="form-label">Gender:</label>
                    </div>
                    <div class="col-md-7">
                        <select class="form-select" data-allow-clear="true" data-control="select2"
                            data-placeholder="Select Gender" name="gender">
                            <option value="">Select Gender</option>
                            <option value="Male" {{ isset($student) && $student->gender == 'Male' ? 'selected' : '' }}>
                                Male
                            </option>
                            <option value="Male" {{ isset($student) && $student->gender == 'Female' ? 'selected' : '' }}>
                                Female
                            </option>
                            <option value="Male" {{ isset($student) && $student->gender == 'Other' ? 'selected' : '' }}>
                                Other
                            </option>
                        </select>
                        <span class="field-error" style="color:red" id="gender-error"></span>
                    </div>
                </div>
                <div class="col-md-4" style="display: flex">
                    <div class="col-md-5 mt-3">
                        <label class="form-label">Tc Sl No :</label>
                    </div>
                    <div class="col-md-7">
                        <input type="text" name="tcslno" placeholder="Tc Sl No" class="required form-control "
                            value="{{ $student->tcslno ?? '' }}" autocomplete="off" />
                        <span class="field-error" style="color:red" id="tcslno-error"></span>
                    </div>
                </div>
            </div>
            <div class="row mt-10">
                <div class="col-md-4" style="display: flex">
                    <div class="col-md-4 mt-3">
                        <label class="form-label">Father Name :</label>
                    </div>
                    <div class="col-md-7">
                        <input type="text" name="fatherName" placeholder="Father Name" class="required form-control "
                            value="{{ $student->fatherName ?? '' }}" autocomplete="off" />
                        <span class="field-error" style="color:red" id="fatherName-error"></span>
                    </div>
                </div>
                <div class="col-md-4" style="display: flex">
                    <div class="col-md-4 mt-3">
                        <label class="form-label">Mother Name :</label>
                    </div>
                    <div class="col-md-7">
                        <input type="text" name="motherName" placeholder="Mother Name" class="required form-control "
                            value="{{ $student->motherName ?? '' }}" autocomplete="off" />
                        <span class="field-error" style="color:red" id="motherName-error"></span>
                    </div>
                </div>
                <div class="col-md-4" style="display: flex">
                    <div class="col-md-5 mt-3">
                        <label class="form-label">Year:</label>
                    </div>
                    <div class="col-md-7">
                        <select class="form-select" data-allow-clear="true" data-control="select2"
                            data-placeholder="Select Year" name="year">
                            <option value="">Select Year</option>
                            <option value="2013-2014" {{ isset($student) && $student->year == "2013-2014" ? 'selected' : '' }}>
                                2013-2014
                            </option>
                            <option value="2014-2015" {{ isset($student) && $student->year == "2014-2015" ? 'selected' : '' }}>
                                2014-2015
                            </option>

                        </select>
                        <span class="field-error" style="color:red" id="year-error"></span>
                    </div>
                </div>



            </div>
            <div class="row mt-10">
                <div class="col-md-4" style="display: flex">
                    <div class="col-md-4 mt-3">
                        <label class="form-label">Admission Number :</label>
                    </div>
                    <div class="col-md-7">
                        <input type="text" name="adminNo" placeholder="Admission Number" class="required form-control "
                            value="{{ $student->adminNo ?? '' }}" autocomplete="off" />
                        <span class="field-error" style="color:red" id="adminNo-error"></span>
                    </div>
                </div>
                <div class="col-md-4" style="display: flex">
                    <div class="col-md-4 mt-3">
                        <label class="form-label">Register Number :</label>
                    </div>
                    <div class="col-md-7">
                        <input type="text" name="regNo" placeholder="Register Number" class="required form-control "
                            value="{{ $student->regNo ?? '' }}" autocomplete="off" />
                        <span class="field-error" style="color:red" id="regNo-error"></span>
                    </div>
                </div>
                <div class="col-md-4" style="display: flex">
                    <div class="col-md-5 mt-3">
                        <label class="form-label">Leave Of Class :</label>
                    </div>
                    <div class="col-md-7">
                        <input type="text" name="leaveOfClass" placeholder="Leave Of Class"
                            class="required form-control " value="{{ $student->leaveOfClass ?? '' }}"
                            autocomplete="off" />
                        <span class="field-error" style="color:red" id="leaveOfClass-error"></span>
                    </div>
                </div>

            </div>
            <div class="row mt-10">
                <div class="col-md-6" style="display: flex">
                    <div class="col-md-5 mt-3">
                        <label class="form-label">Status :</label>
                    </div>
                    <div class="col-md-7" style="display: flex">
                        <div class="col-md-5 form-check  form-check-success form-check-solid">
                            <input class="form-check-input" type="radio" name="status" value="1" id="flexRadioActive"
                                @if(isset($student)) @checked($student->status == 1) @else checked @endif />
                            <label class="form-check-label" for="flexRadioActive">
                                Active
                            </label>
                        </div>
                        <div class="col-md-3 g-6 form-check  form-check-danger form-check-solid">
                            <input class="form-check-input" type="radio" name="status" value="0" id="flexRadioInactive"
                                @if(isset($student)) @checked($student->status == 0) @endif />
                            <label class="form-check-label" for="flexRadioInactive">
                                Inactive
                            </label>
                        </div>
                        <span class="field-error" style="color:red" id="status-error"></span>
                    </div>

                </div>
                <div class="col-md-6" style="display: flex">
                    <div class="col-md-4 mt-3">
                        <label class="form-label">Student Image:<span
                                class="text-danger">(Resolution(50*50))</span></label>
                    </div>
                    <div class="col-md-7">
                        <div class="card-body text-center pt-0">
                            <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3"
                                data-kt-image-input="true" @if(isset($student->image) && !empty($student->image))
                                    style="background-image: url('{{ url('storage/' . $student->image) }}')" @else style=""
                                @endif>
                                <div class="image-input-wrapper w-150px h-150px"></div>
                                <label
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change Image">
                                    <i class="bi bi-pencil-fill fs-7"></i>
                                    <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" name="avatar_remove" />
                                    <input type="hidden" name="update_image" value="{{$student->image ?? ''}}" />
                                </label>
                                <span
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel Image">
                                    <i class="bi bi-x fs-2"></i>
                                </span>
                                <span
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove Image">
                                    <i class="bi bi-x fs-2"></i></span>
                            </div>
                        </div>
                        <span class="field-error" style="color:red" id="image-error"></span>
                    </div>
                </div>
            </div>
            <div class="row mt-10 mb-10">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">Academic Details</span>
                </h3>
                @foreach ($student->academic as $academic)
                    <div class="row mt-5">
                        <div class="col-md-6" style="display: flex">
                            <div class="col-md-5 mt-3">
                                <label class="form-label">Pursuing Studies :</label>
                            </div>
                            <div class="col-md-5" style="display: flex">

                                <div class="col-md-5 form-check  form-check-success form-check-solid">
                                    <input class="form-check-input" type="radio" name="pursuing" value="1"
                                        id="flexRadioActive" @if(isset($student) && isset($academic))
                                        @checked($academic->pursuing == 1) @else checked @endif />
                                    <label class="form-check-label" for="flexRadioActive">
                                        Yes
                                    </label>
                                </div>
                                <div class="col-md-3 g-6 form-check  form-check-danger form-check-solid">
                                    <input class="form-check-input" type="radio" name="pursuing" value="0"
                                        id="flexRadioInactive" @if(isset($student)) @checked($academic->pursuing == 0)
                                        @endif />
                                    <label class="form-check-label" for="flexRadioInactive">
                                        No
                                    </label>
                                </div>
                                <span class="field-error" style="color:red" id="pursuing-error"></span>
                            </div>

                        </div>
                        <div class="col-md-6" style="display: flex">
                            <div class="col-md-5 mt-3">
                                <label class="form-label">Level of Education :</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" name="level" placeholder="Level of Education"
                                    class="required form-control" value="{{ $academic->level ?? '' }}" autocomplete="off"
                                    id="levelInput" />
                                <span class="field-error" style="color:red" id="level-error"></span>
                            </div>
                        </div>

                    </div>

                    <div class="row mt-10 mb-20">
                        <div class="col-md-6" style="display: flex">
                            <div class="col-md-5 mt-3">
                                <label class="form-label">Institution Name :</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" name="institutionName" placeholder="Institution Name"
                                    class="required form-control " value="{{ $academic->institutionName ?? '' }}"
                                    autocomplete="off" />
                                <span class="field-error" style="color:red" id="institutionName-error"></span>
                            </div>
                        </div>
                        <div class="col-md-6" style="display: flex">
                            <div class="col-md-5 mt-3">
                                <label class="form-label">Course :</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" name="course" placeholder="Course" class="required form-control "
                                    value="{{ $academic->course ?? '' }}" autocomplete="off" />
                                <span class="field-error" style="color:red" id="course-error"></span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row mt-10 mb-10">
                <h3 class="card-title align-items-start flex-column ">
                    <span class="card-label fw-bold fs-3 mb-1">Professional Details</span>
                </h3>
                @foreach ($student->professional as $professional)
                    <div class="row mt-10">
                        <div class="col-md-6" style="display: flex">
                            <div class="col-md-5 mt-3">
                                <label class="form-label">Type:</label>
                            </div>
                            <div class="col-md-7">
                                <select class="form-select" data-allow-clear="true" data-control="select2"
                                    data-placeholder="Select Type" name="type">
                                    <option value="">Select Type</option>
                                    @foreach($professions as $profession)
                                        <option value="{{ $profession->id }}" {{ isset($student) && $professional->type == $profession->id ? 'selected' : '' }}>
                                            {{ $profession->profession }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="field-error" style="color:red" id="type-error"></span>
                            </div>
                        </div>
                        <div class="col-md-6" style="display: flex">
                            <div class="col-md-5 mt-3">
                                <label class="form-label">Organisation :</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" name="organisation" placeholder="Organisation"
                                    class="required form-control" value="{{ $professional->organisation ?? '' }}"
                                    autocomplete="off" id="organisationInput" />
                                <span class="field-error" style="color:red" id="organisation-error"></span>
                            </div>
                        </div>

                    </div>

                    <div class="row mt-10">
                        <div class="col-md-6" style="display: flex">
                            <div class="col-md-5 mt-3">
                                <label class="form-label">Designation :</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" name="designation" placeholder="Designation"
                                    class="required form-control " value="{{ $professional->designation ?? '' }}"
                                    autocomplete="off" />
                                <span class="field-error" style="color:red" id="designation-error"></span>
                            </div>
                        </div>
                        <div class="col-md-6" style="display: flex">
                            <div class="col-md-5 mt-3">
                                <label class="form-label">Experience :</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" name="experience" placeholder="Experience" class="required form-control "
                                    value="{{ $professional->experience ?? '' }}" autocomplete="off" />
                                <span class="field-error" style="color:red" id="experience-error"></span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row mt-10 mb-10">
                <h3 class="card-title align-items-start flex-column ">
                    <span class="card-label fw-bold fs-3 mb-1">Demographic Details</span>
                </h3>
                <div class="row mt-10">
                    <div class="col-md-6" style="display: flex">
                        <div class="col-md-5 mt-3">
                            <label class="form-label">Are you residing in india: :</label>
                        </div>
                        <div class="col-md-5" style="display: flex">
                            <div class="col-md-5 form-check  form-check-success form-check-solid">
                                <input class="form-check-input" type="radio" name="residingInIndia" value="1"
                                    id="flexRadioActive" @if(isset($student))
                                    @checked($student->demographic->residingInIndia == 1) @else checked @endif />
                                <label class="form-check-label" for="flexRadioActive">
                                    Yes
                                </label>
                            </div>
                            <div class="col-md-3 g-6 form-check  form-check-danger form-check-solid">
                                <input class="form-check-input" type="radio" name="residingInIndia" value="0"
                                    id="flexRadioInactive" @if(isset($student))
                                    @checked($student->demographic->residingInIndia == 0) @endif />
                                <label class="form-check-label" for="flexRadioInactive">
                                    No
                                </label>
                            </div>
                            <span class="field-error" style="color:red" id="residingInIndia-error"></span>
                        </div>

                    </div>
                    <div class="col-md-6" style="display: flex">
                        <div class="col-md-5 mt-3">
                            <label class="form-label">Address Line1 :</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" name="addressLine1" placeholder="Address Line1"
                                class="required form-control" value="{{ $student->demographic->addressLine1 ?? '' }}"
                                autocomplete="off" id="addressLine1Input" />
                            <span class="field-error" style="color:red" id="addressLine1-error"></span>
                        </div>
                    </div>

                </div>

                <div class="row mt-10">
                    <div class="col-md-6" style="display: flex">
                        <div class="col-md-5 mt-3">
                            <label class="form-label">Address Line2 :</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" name="addressLine2" placeholder="Address Line2"
                                class="required form-control " value="{{ $student->demographic->addressLine2 ?? '' }}"
                                autocomplete="off" />
                            <span class="field-error" style="color:red" id="addressLine2-error"></span>
                        </div>
                    </div>
                    <div class="col-md-6" style="display: flex">
                        <div class="col-md-5 mt-3">
                            <label class="form-label">Country:</label>
                        </div>
                        <div class="col-md-7">
                            <select class="form-select" data-allow-clear="true" data-control="select2"
                                data-placeholder="Select Country" name="countryId">
                                <option value="">Select Country</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}" {{ isset($student) && $student->demographic->countryId == $country->id ? 'selected' : '' }}>
                                        {{ $country->name }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="field-error" style="color:red" id="country-error"></span>
                        </div>
                    </div>
                </div>
                <div class="row mt-10">
                    <div class="col-md-6" style="display: flex">
                        <div class="col-md-5 mt-3">
                            <label class="form-label">Postal Code :</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" name="postalcode" placeholder="Postal Code"
                                class="required form-control " value="{{ $student->demographic->postalcode ?? '' }}"
                                autocomplete="off" />
                            <span class="field-error" style="color:red" id="postalcode-error"></span>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row mt-10 mb-5">
                <div class="col-md-12 justify-content-end d-flex gap-10">
                    <a href="{{url('student')}}" type="button" class="btn btn-danger">Cancel</a>
                    <button id="student_submit" type="button" class="btn btn-primary" style="width: 87px">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
@section('script')
@parent
<script>
    function validateNumberInput(input) {
        input.value = input.value.replace(/[^0-9]/g, '');
        if (input.value.length > 2) {
            input.value = input.value.slice(0, 2);
        }
    }
    var id = $('#id').val();
    if (id) {
        var submit_url = "{{ route('student.update') }}";
    } else {
        var submit_url = "{{ route('student.save') }}";
    }
    console.log(id);
    $('#student_submit').click(function (event) {
        event.preventDefault();
        $('#pageLoader').fadeIn();
        let form = document.getElementById('student_form');
        let formData = new FormData(form);
        formData.append('id', id);
        $.ajax({
            url: submit_url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $('.field-error').text('');
                toastr.success(response.message);
                $('#pageLoader').fadeOut();
                window.location = "{{ route('list') }}";
            },
            error: function (response) {
                $("#student_form").attr("disabled", false);
                $('#student_form').find(".field-error").text('');
                $('#pageLoader').fadeOut();
                $.each(response.responseJSON.error, function (field_name, error) {
                    $('#' + field_name + '-error').text(error[0]);
                });
            }
        });
    });

</script>
@endsection
