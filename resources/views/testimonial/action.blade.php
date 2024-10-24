@extends('layouts.index')
@section('title', 'Testimonial')
@section('style')
@parent
@endsection
@section('content')
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
   <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
      <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Testimonial</h1>
      <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
          <a href="{{url('dashboard')}}" class="text-muted text-hover-primary">Home</a>
        </li>
        <li class="breadcrumb-item">
          <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Testimonial</li>
      </ul>
    </div>
  </div>
</div>
<div class="card mb-5 mb-xl-8">
  <div class="card-header border-0 pt-5">
    <h3 class="card-title align-items-start flex-column">
      <span class="card-label fw-bold fs-3 mb-1">Testimonial</span>
    </h3>
    <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="Click to add a user">
    </div>
  </div>
  <div class="card-body py-3">
    <form id="testimonial_form" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="id"  id="id"  value="{{ $testimonial->id ?? '' }}" /> 
          <div class="row mt-5">
            <div class="col-md-4" style="display: flex">
                    <div class="col-md-5 mt-3">
                        <label class="form-label">Customer Name :</label>
                    </div>
                    <div class="col-md-7"> 
                      <input type="text" name="name" placeholder="Customer Name" class="required form-control " value="{{ $testimonial->name ?? '' }}" autocomplete="off" /> 
                        <span class="field-error" style="color:red" id="name-error"></span>
                    </div>
            </div>
            <div class="col-md-4" style="display: flex">
                <div class="col-md-4 mt-3">
                    <label class="form-label">Customer Age :</label>
                </div>
                <div class="col-md-6">
                  <input type="text" name="age" placeholder="Customer Age" class="required form-control" value="{{ $testimonial->age ?? '' }}" autocomplete="off" id="ageInput" oninput="validateNumberInput(this)" />
                  <span class="field-error" style="color:red" id="age-error"></span>
              </div>
            </div>
              <div class="col-md-4" style="display: flex">
                  <div class="col-md-2 mt-3">
                      <label class="form-label">State :</label>
                  </div>
                      <div class="col-md-8"> 
                        <select class="form-select" data-allow-clear="true" data-control="select2" data-placeholder="Select State" name="state" value ="{{ $testimonials->state ?? '' }}">
                          <option value="">Select State</option>
                          @foreach($states as $state)
                          <option value="{{ $state->name }}" {{ isset($testimonial) && $testimonial->state == $state->name ? 'selected' : '' }}>
                              {{ $state->name }}
                          </option>
                      @endforeach
                      </select>
                      <span class="field-error" style="color:red" id="state-error"></span>
                  </div>
              </div>
          </div>
          <div class="row mt-10">
                <div class="col-md-5" style="display: flex">
                  <div class="col-md-4 mt-3">
                      <label class="form-label">Type of Insurance :</label>
                  </div>
                      <div class="col-md-8"> 
                        <select class="form-select" data-allow-clear="true" data-control="select2" data-placeholder="Select Type of Insurance" name="insurance_type">
                          <option value="">Select Type of Insurance</option>
                          @foreach($insurances as $insurance)
                          <option value="{{ $insurance->name }}" {{ isset($testimonial) && $testimonial->insurance_type == $insurance->name ? 'selected' : '' }}>
                            {{ $insurance->name }}
                        </option>
                          @endforeach
                      </select>
                      <span class="field-error" style="color:red" id="insurance_type-error"></span>
                  </div>
                </div>
                <div class="col-md-5" style="display: flex">
                  <div class="col-md-5 mt-3">
                      <label class="form-label">Testimonial Category :</label>
                  </div>
                      <div class="col-md-8"> 
                        <select class="form-select" data-allow-clear="true" data-control="select2" data-placeholder="Select Testimonial Category" name="testimonial_category">
                          <option value="">Select Testimonial Category</option>
                          @foreach($testimonialCategoryes as $testimonialCategory)
                          <option value="{{ $testimonialCategory->name }}" {{ isset($testimonial) && $testimonial->testimonial_category == $testimonialCategory->name ? 'selected' : '' }}>
                            {{ $testimonialCategory->name }}
                           </option>
                          @endforeach
                      </select>
                      <span class="field-error" style="color:red" id="testimonial_category-error"></span>
                  </div>
                </div>
          </div>
          <div class="row mt-10">
              <div class="col-md-5" style="display: flex">
                <div class="col-md-4 mt-3">
                    <label class="form-label">Select Language:</label>
                </div>
                    <div class="col-md-8"> 
                      <select class="form-select" data-allow-clear="true" data-control="select2" data-placeholder="Select Language" name="language">
                        <option value="">Select Language</option>
                        @foreach($languages as $language)
                        <option value="{{ $language->name }}" {{ isset($testimonial) && $testimonial->language == $language->name ? 'selected' : '' }}>
                          {{ $language->name }}
                      </option>
                        @endforeach
                    </select>
                    <span class="field-error" style="color:red" id="language-error"></span>
                </div>
              </div>
              <div class="col-md-4" style="display: flex">
                <div class="col-md-2 mt-3">
                    <label class="form-label">Status:</label>
                </div>
                <div class="col-md-8" style="display: flex">
                  <div class="col-md-5 form-check form-check-custom form-check-success form-check-solid">
                      <input class="form-check-input" type="radio" name="status" value="1" id="flexRadioActive"
                          @if(isset($testimonial)) @checked($testimonial->status == 1) @else checked @endif />
                      <label class="form-check-label" for="flexRadioActive">
                          Active
                      </label>
                  </div>
                  <div class="col-md-3 g-6 form-check form-check-custom form-check-danger form-check-solid">
                      <input class="form-check-input" type="radio" name="status" value="0" id="flexRadioInactive"
                          @if(isset($testimonial)) @checked($testimonial->status == 0) @endif />
                      <label class="form-check-label" for="flexRadioInactive">
                          Inactive
                      </label>
                  </div>
                  <span class="field-error" style="color:red" id="status-error"></span>
              </div>
                         
          </div>
          <div class="row mt-10">
            <div class="col-md-4" style="display: flex">
                    <div class="col-md-5 mt-3">
                        <label class="form-label">Testimonial Title :</label>
                    </div>
                    <div class="col-md-12"> 
                      <input type="text" name="title" placeholder="Testimonial Title" class="required form-control " value="{{ $testimonial->title ?? '' }}" autocomplete="off" /> 
                        <span class="field-error" style="color:red" id="title-error"></span>
                    </div>
            </div>
          </div>
          <div class="row mt-10">
            <div class="col-md-4" style="display: flex">
                    <div class="col-md-5 mt-3">
                        <label class="form-label">Upload Video Url :</label>
                    </div>
                    <div class="col-md-12"> 
                      <input type="text" name="video_url" placeholder="Upload Video Url" class="required form-control " value="{{ $testimonial->video_url ?? '' }}" autocomplete="off" /> 
                        <span class="field-error" style="color:red" id="video_url-error"></span>
                    </div>
            </div>
          </div>
          <div class="row mt-10">
            <div class="col-md-5" style="display: flex">
                    <div class="col-md-4 mt-3">
                        <label class="form-label">Customer Image:<span  class="text-danger">(Resolution(50*50))</span></label>
                    </div>
                    <div class="col-md-7">
                      <div class="card-body text-center pt-0">
                        <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true"
                                    @if(isset($testimonial->image) && !empty($testimonial->image))
                                        style="background-image: url('{{ url($testimonial->image) }}')"
                                    @else
                                        style=""
                                    @endif>
                                    <div class="image-input-wrapper w-150px h-150px"></div>
                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change Image">
                          <i class="bi bi-pencil-fill fs-7"></i>
                          <input type="file" name="image" accept=".png, .jpg, .jpeg"  />
                          <input type="hidden" name="avatar_remove" />
                          <input type="hidden" name="update_image" value="{{$testimonial->image ?? ''}}" />
                        </label>
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel Image">
                        <i class="bi bi-x fs-2"></i>
                          </span>
                          <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                          data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove Image">
                          <i class="bi bi-x fs-2"></i></span></div>
                            </div>
                          <span class="field-error" style="color:red" id="image-error"></span>
                    </div>
            </div>
          </div>
      </div>
      <div class="row mt-5 mb-5">
              <div class="col-md-12 justify-content-end d-flex gap-10">
                <a href="{{url('testimonial')}}" type="button" class="btn btn-danger">Cancel</a>
                <button id="testimonial_submit" type="button" class="btn btn-primary" style="width: 87px">Save</button>
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
        if(id){
          var submit_url="{{ route('testimonial.update') }}";
        }else{
          var submit_url="{{ route('testimonial.save') }}";
        }
        console.log(id);
$('#testimonial_submit').click(function (event) {
    event.preventDefault();
    $('#pageLoader').fadeIn();
    let form = document.getElementById('testimonial_form');
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
            window.location = "{{ route('testimonial.list') }}";
        },
        error: function (response) {
            $("#testimonial_form").attr("disabled", false);
            $('#testimonial_form').find(".field-error").text('');
            $('#pageLoader').fadeOut();
            $.each(response.responseJSON.error, function (field_name, error) {
                $('#' + field_name + '-error').text(error[0]);
            });
        }
    });
});

</script>
@endsection
