@extends('layouts.index')
@section('title', 'Student')
@section('style')
@parent
@endsection
@section('content')
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">View Student
            </h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="{{url('dashboard')}}" class="text-muted text-hover-primary">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    <a href="{{url('student/register-list')}}" class="text-muted text-hover-primary">
                        View Student</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="card mb-5 mb-xl-8">
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold fs-3 mb-1"> Basic Details</span>
        </h3>
        <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top">
            <a href="{{url('student/register-list')}}"
                class="btn btn-outline btn-outline-dashed btn-outline-success btn-active-light-success">Back</a>
        </div>
    </div>
    <div class="card-body py-3">
        <form id="student_form" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" id="id" value="{{ $student->id ?? '' }}" />
            <div class="row">
                <div class="row mt-5">
                    <div class="col-md-4" style="display: flex">
                        <div class="col-md-4 mt-3">
                            <label class="form-label">Student Name :</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" name="name" placeholder="Student Name" class="required form-control "
                                value="{{ $student->name ?? '' }}" autocomplete="off" readonly />
                            <span class="field-error" style="color:red" id="name-error"></span>
                        </div>
                    </div>
                    <div class="col-md-4" style="display: flex">
                        <div class="col-md-4 mt-3">
                            <label class="form-label">Email :</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" name="email" placeholder="Email" class="required form-control"
                                value="{{ $student->email ?? '' }}" autocomplete="off" id="emailInput" readonly />
                            <span class="field-error" style="color:red" id="email-error"></span>
                        </div>
                    </div>
                    <div class="col-md-4" style="display: flex">
                        <div class="col-md-5 mt-3">
                            <label class="form-label">Phone Number :</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" name="phoneNumber" placeholder="Phone Number"
                                class="required form-control " value="{{ $student->phoneNumber ?? '' }}"
                                autocomplete="off" readonly />
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
                                autocomplete="off" readonly />
                            <span class="field-error" style="color:red" id="dob-error"></span>
                        </div>
                    </div>
                    <div class="col-md-4" style="display: flex">
                        <div class="col-md-4 mt-3">
                            <label class="form-label">Gender:</label>
                        </div>
                        <div class="col-md-7">
                            <select class="form-select" data-allow-clear="true" data-control="select2"
                                data-placeholder="Select Gender" name="gender" disabled>
                                <option value="">Select Gender</option>
                                <option value="Male" {{ isset($student) && $student->gender == 'Male' ? 'selected' : '' }}>
                                    Male
                                </option>
                                <option value="Female" {{ isset($student) && $student->gender == 'Female' ? 'selected' : '' }}>
                                    Female
                                </option>
                                <option value="Other" {{ isset($student) && $student->gender == 'Other' ? 'selected' : '' }}>
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
                                value="{{ $student->tcslno ?? '' }}" autocomplete="off" readonly />
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
                            <input type="text" name="fatherName" placeholder="Father Name"
                                class="required form-control " value="{{ $student->fatherName ?? '' }}"
                                autocomplete="off" readonly />
                            <span class="field-error" style="color:red" id="fatherName-error"></span>
                        </div>
                    </div>
                    <div class="col-md-4" style="display: flex">
                        <div class="col-md-4 mt-3">
                            <label class="form-label">Mother Name :</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" name="motherName" placeholder="Mother Name"
                                class="required form-control " value="{{ $student->motherName ?? '' }}"
                                autocomplete="off" readonly />
                            <span class="field-error" style="color:red" id="motherName-error"></span>
                        </div>
                    </div>
                    <div class="col-md-4" style="display: flex">
                        <div class="col-md-5 mt-3">
                            <label class="form-label">Year:</label>
                        </div>
                        <div class="col-md-7">
                            <select class="form-select" data-allow-clear="true" data-control="select2"
                                data-placeholder="Select Year" name="year" disabled>
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
                            <input type="text" name="adminNo" placeholder="Admission Number"
                                class="required form-control " value="{{ $student->adminNo ?? '' }}" autocomplete="off"
                                readonly />
                            <span class="field-error" style="color:red" id="adminNo-error"></span>
                        </div>
                    </div>
                    <div class="col-md-4" style="display: flex">
                        <div class="col-md-4 mt-3">
                            <label class="form-label">Register Number :</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" name="regNo" placeholder="Register Number" class="required form-control "
                                value="{{ $student->regNo ?? '' }}" autocomplete="off" readonly />
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
                                autocomplete="off" readonly />
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
                                <input class="form-check-input" type="radio" name="status" value="1"
                                    id="flexRadioActive" disabled @if(isset($student)) @checked($student->status == 1)
                                    @else checked @endif />
                                <label class="form-check-label" for="flexRadioActive">
                                    Active
                                </label>
                            </div>
                            <div class="col-md-3 g-6 form-check  form-check-danger form-check-solid">
                                <input class="form-check-input" type="radio" name="status" value="0"
                                    id="flexRadioInactive" disabled @if(isset($student)) @checked($student->status == 0)
                                    @endif />
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
                                    style="background-image: url('{{ url($student->image) }}')" @else style="" @endif>
                                    <div class="image-input-wrapper w-150px h-150px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-10 mb-10">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">Academic Details</span>
                </h3>
                @foreach ($student->academic as $key => $academic)
                    <div class="row mt-5">
                        <div class="col-md-6" style="display: flex">
                            <div class="col-md-5 mt-3">
                                <label class="form-label">Pursuing Studies :</label>
                            </div>
                            <div class="col-md-5" style="display: flex">
                                <div class="col-md-5 form-check form-check-success form-check-solid">
                                    <input class="form-check-input" type="radio" name="academic[{{ $key }}][pursuing]"
                                        disabled value="1" id="flexRadioActive" @if(isset($student) && isset($academic))
                                        @checked($academic->pursuing == 1) @else checked @endif />
                                    <label class="form-check-label" for="flexRadioActive">
                                        Yes
                                    </label>
                                </div>
                                <div class="col-md-3 g-6 form-check form-check-danger form-check-solid">
                                    <input class="form-check-input" type="radio" name="academic[{{ $key }}][pursuing]"
                                        disabled value="0" id="flexRadioInactive" @if(isset($student))
                                        @checked($academic->pursuing == 0) @endif />
                                    <label class="form-check-label" for="flexRadioInactive">
                                        No
                                    </label>
                                </div>
                                <span class="field-error" style="color:red" id="pursuing-error"></span>
                            </div>
                        </div>
                        <div class="col-md-6" style="display: flex">
                            <div class="col-md-5 mt-3">
                                <label class="form-label">Level Of Education:</label>
                            </div>
                            <div class="col-md-7">
                                <select class="form-select" data-allow-clear="true" data-control="select2"
                                    data-placeholder="Select Level Of Education" name="academic[{{ $key }}][level]"
                                    disabled>
                                    <option value="">Select Level Of Education</option>
                                    @foreach($levels as $level)
                                        <option value="{{ $level->id }}" {{ isset($student) && $academic->level == $level->id ? 'selected' : '' }}>
                                            {{ $level->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="field-error" style="color:red" id="type-error"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-10 mb-20">
                        <div class="col-md-6" style="display: flex">
                            <div class="col-md-5 mt-3">
                                <label class="form-label">Institution Name :</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" name="academic[{{ $key }}][institutionName]"
                                    placeholder="Institution Name" class="required form-control"
                                    value="{{ $academic->institutionName ?? '' }}" autocomplete="off" readonly />
                                <span class="field-error" style="color:red" id="institutionName-error"></span>
                            </div>
                        </div>
                        <div class="col-md-6" style="display: flex">
                            <div class="col-md-5 mt-3">
                                <label class="form-label">Course :</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" name="academic[{{ $key }}][course]" placeholder="Course"
                                    class="required form-control" value="{{ $academic->course ?? '' }}" autocomplete="off"
                                    readonly />
                                <span class="field-error" style="color:red" id="course-error"></span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row mt-10 mb-20">
                <h3 class="card-title align-items-start flex-column ">
                    <span class="card-label fw-bold fs-3 mb-1">Professional Details</span>
                </h3>
                @foreach ($student->professional as $key => $professional)
                    <div class="row mt-10">
                        <div class="col-md-6" style="display: flex">
                            <div class="col-md-5 mt-3">
                                <label class="form-label">Type:</label>
                            </div>
                            <div class="col-md-7">
                                <select class="form-select" data-allow-clear="true" data-control="select2"
                                    data-placeholder="Select Type" name="professional[{{ $key }}][type]" disabled>
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
                                <input type="text" name="professional[{{ $key }}][organisation]" placeholder="Organisation"
                                    class="required form-control" value="{{ $professional->organisation ?? '' }}"
                                    autocomplete="off" id="organisationInput" readonly />
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
                                <input type="text" name="professional[{{ $key }}][designation]" placeholder="Designation"
                                    class="required form-control" value="{{ $professional->designation ?? '' }}"
                                    autocomplete="off" readonly />
                                <span class="field-error" style="color:red" id="designation-error"></span>
                            </div>
                        </div>
                        <div class="col-md-6" style="display: flex">
                            <div class="col-md-5 mt-3">
                                <label class="form-label">Experience :</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" name="professional[{{ $key }}][experience]" placeholder="Experience"
                                    class="required form-control" value="{{ $professional->experience ?? '' }}"
                                    autocomplete="off" readonly />
                                <span class="field-error" style="color:red" id="experience-error"></span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row mt-10 mb-20">
                <h3 class="card-title align-items-start flex-column ">
                    <span class="card-label fw-bold fs-3 mb-1">Demographic Details</span>
                </h3>
                <div class="row mt-10">
                    <div class="col-md-6" style="display: flex">
                        <div class="col-md-5 mt-3">
                            <label class="form-label">Are you residing in india: :</label>
                        </div>
                        <div class="col-md-7" style="display: flex">
                            <div class="col-md-5 form-check  form-check-success form-check-solid">
                                <input class="form-check-input" type="radio" name="residingInIndia" value="1"
                                    id="flexRadioActive" disabled @if(isset($student))
                                    @checked($student->demographic->residingInIndia == 1) @else checked @endif />
                                <label class="form-check-label" for="flexRadioActive">
                                    Yes
                                </label>
                            </div>
                            <div class="col-md-3 g-6 form-check  form-check-danger form-check-solid">
                                <input class="form-check-input" type="radio" name="residingInIndia" value="0"
                                    id="flexRadioInactive" disabled @if(isset($student))
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
                                autocomplete="off" id="addressLine1Input" readonly />
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
                                autocomplete="off" readonly />
                            <span class="field-error" style="color:red" id="addressLine2-error"></span>
                        </div>
                    </div>
                    <div class="col-md-6" style="display: flex">
                        <div class="col-md-5 mt-3">
                            <label class="form-label">Country:</label>
                        </div>
                        <div class="col-md-7">
                            <select class="form-select" data-allow-clear="true" data-control="select2"
                                data-placeholder="Select Country" name="countryId" disabled>
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
                                autocomplete="off" readonly />
                            <span class="field-error" style="color:red" id="postalcode-error"></span>
                        </div>
                    </div>

                </div>


            </div>
            <div class="row mt-10 mb-20">
                <h3 class="card-title align-items-start flex-column ">
                    <span class="card-label fw-bold fs-3 mb-1">Documents</span>
                </h3>
                <div class="row mt-10">
                    @foreach ($student->documents as $key => $document)
                        <div class="col-md-2 mb-5"
                            style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                            <a href="{{url($document->document)}}" target="_blank">
                                <img src="{{asset('/images/file.svg')}}" width="35" height="35"
                                    alt="{{ basename($document->document) }}" />
                            </a>
                            <span style="font-size: 12px;">{{ basename($document->document) }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

    </div>
    </form>
</div>
</form>
</div>
</div>
@endsection
@section('script')
@parent
@endsection
