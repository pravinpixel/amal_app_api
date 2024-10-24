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
        <li class="breadcrumb-item text-muted">
        <a href="{{url('testimonial')}}" class="text-muted text-hover-primary">
            Testimonial</a></li>
      </ul>
    </div>
  </div>
</div>
<div class="card mb-5 mb-xl-8">
  <div class="card-header border-0 pt-5">
    <h3 class="card-title align-items-start flex-column">
      <span class="card-label fw-bold fs-3 mb-1"> View Testimonial</span>
    </h3>
    <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top">
        <a href="{{url('testimonial')}}" class="btn btn-outline btn-outline-dashed btn-outline-success btn-active-light-success">Back</a>
    </div>
  </div>
  <div class="card-body py-3">
          <div class="row mt-5">
                <div class="col-md-4" style="display: flex">
                    <div class="col-md-6 mt-3">
                        <label class="form-label">Upload Video :</label>
                    </div>
                    <div class="col-md-12"> 
                                @php
                                $video_url = $testimonial->video_url ?? '';
                                if ($video_url) {
                                    if (strpos($video_url, 'youtu.be/') !== false) {
                                        $video_id = substr($video_url, strrpos($video_url, '/') + 1);
                                    } elseif (strpos($video_url, 'watch?v=') !== false) {
                                        parse_str(parse_url($video_url, PHP_URL_QUERY), $query);
                                        $video_id = $query['v'] ?? '';
                                    } else {
                                        $video_id = '';
                                    }
                                    $embed_url = $video_id ? "https://www.youtube.com/embed/{$video_id}" : '';
                                }
                            @endphp
                            @if(!empty($embed_url))
                                <div class="embed-responsive embed-responsive-21by9">
                                    <iframe  width="509" height="299" class="embed-responsive-item" src="{{$embed_url}}" 
                                     allowfullscreen></iframe>
                                </div>
                            @else
                                <div class="embed-responsive embed-responsive-21by9">
                                <div class="embed-responsive-item" style="display: flex; justify-content: center; align-items: center; background-color: #f0f0f0; color: #333; flex-direction: column;">
                                    <i class="fas fa-video-slash" style="font-size: 48px; margin-bottom: 10px;"></i>
                                    <p>No video available</p>
                                </div>
                                   </div>
                            @endif
                    </div>
                </div>
           </div>
    <form id="testimonial_form" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="id"  id="id"  value="{{ $testimonial->id ?? '' }}" /> 
          <div class="row mt-5">
            <div class="col-md-4" style="display: flex">
                    <div class="col-md-5 mt-3">
                        <label class="form-label">Customer Name :</label>
                    </div>
                    <div class="col-md-7"> 
                      <input type="text" name="name" placeholder="Customer Name" class="required form-control " value="{{ $testimonial->name ?? '' }}" readonly /> 
                    </div>
            </div>
            <div class="col-md-4" style="display: flex">
                <div class="col-md-4 mt-3">
                    <label class="form-label">Customer Age :</label>
                </div>
                <div class="col-md-6"> 
                  <input type="text" name="age" placeholder="Customer Age" class="required form-control " value="{{ $testimonial->age ?? '' }}" readonly /> 
                </div>
            </div>
              <div class="col-md-4" style="display: flex">
                  <div class="col-md-2 mt-3">
                      <label class="form-label">State :</label>
                  </div>
                      <div class="col-md-8"> 
                      <input type="text" name="state" placeholder="Testimonial State" class="required form-control " value="{{ $testimonial->state ?? '' }}" readonly />
                  </div>
              </div>
          </div>
          <div class="row mt-10">
                <div class="col-md-5" style="display: flex">
                  <div class="col-md-4 mt-3">
                      <label class="form-label">Type of Insurance :</label>
                  </div>
                      <div class="col-md-8"> 
                      <input type="text" name="title" placeholder="Testimonial Title" class="required form-control " value="{{ $testimonial->insurance_type ?? '' }}" readonly />
                  </div>
                </div>
                <div class="col-md-5" style="display: flex">
                  <div class="col-md-5 mt-3">
                      <label class="form-label">Testimonial Category :</label>
                  </div>
                      <div class="col-md-8"> 
                        <input type="text" name="title" placeholder="Testimonial Title" class="required form-control " value="{{ $testimonial->testimonial_category ?? '' }}" readonly />
                  </div>
                </div>
          </div>
          <div class="row mt-10">
              <div class="col-md-5" style="display: flex">
                <div class="col-md-4 mt-3">
                    <label class="form-label">Select Language:</label>
                </div>
                    <div class="col-md-8"> 
                        <input type="text" name="title" placeholder="Testimonial Title" class="required form-control " value="{{ $testimonial->language ?? '' }}" readonly /> 
                </div>
              </div>
              <div class="col-md-4" style="display: flex">
                <div class="col-md-2 mt-3">
                    <label class="form-label">Status:</label>
                </div>
                <div class="col-md-8" style="display: flex">
                  <div class="col-md-5 form-check form-check-custom form-check-success form-check-solid">
                      <input class="form-check-input" type="radio" name="status" value="1" id="flexRadioActive"
                          @if(isset($testimonial)) @checked($testimonial->status == 1) @else checked @endif disabled  />
                      <label class="form-check-label" for="flexRadioActive" style="color: black">
                          Active
                      </label>
                  </div>
                  <div class="col-md-3 g-6 form-check form-check-custom form-check-danger form-check-solid">
                      <input class="form-check-input" type="radio" name="status" value="0" id="flexRadioInactive"
                          @if(isset($testimonial)) @checked($testimonial->status == 0) @endif  disabled />
                      <label class="form-check-label" for="flexRadioInactive" style="color: black">
                          Inactive
                      </label>
                  </div>
              </div>         
          </div>
          <div class="row mt-10">
            <div class="col-md-5" style="display: flex">
                    <div class="col-md-4 mt-3">
                        <label class="form-label">Testimonial Title :</label>
                    </div>
                    <div class="col-md-12"> 
                      <input type="text" name="title" placeholder="Testimonial Title" class="required form-control " value="{{ $testimonial->title ?? '' }}" readonly /> 
                    </div>
            </div>
          </div>
          <div class="row mt-10">
            <div class="col-md-5" style="display: flex">
                    <div class="col-md-4 mt-3">
                        <label class="form-label">Upload Video Url :</label>
                    </div>
                    <div class="col-md-12"> 
                      <input type="text" name="video_url" placeholder="Upload Video Url" class="required form-control " value="{{ $testimonial->video_url ?? '' }}" readonly /> 
                    </div>
            </div>
          </div>
          <div class="row mt-10">
            <div class="col-md-5" style="display: flex">
                    <div class="col-md-4 mt-3">
                        <label class="form-label">Customer Image:</label>
                    </div>
                    <div class="col-md-7">
                      <div class="card-body text-center pt-0">
                         <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true"
                                    @if(isset($testimonial->image) && !empty($testimonial->image))
                                        style="background-image: url('{{ url($testimonial->image) }}');height:100px;width:100px;"
                                    @else
                                        style="background-image: url(../../../assets/media/svg/files/blank-image.svg)"
                                        
                                    @endif>
                                    <div class="image-input-wrapper w-100px h-100px"></div>
                          </div>
                        </div>
                    </div>
            </div>
          </div>
      </div>
    </form>
  </div>
</div>
@endsection
@section('script')
    @parent
@endsection
