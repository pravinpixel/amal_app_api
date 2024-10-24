<div class="card-header border-0 pt-6" id="filter_sub" style="display: none;margin-left: 25px;">
    <div class="card-title">
        <div class="row ">
            <div class="w-200px me-3">
                <select class="form-select" data-allow-clear="true" data-control="select2"
                    data-placeholder="Select Insurance Type" name="insurance_type">
                    <option value="">Select Insurance Type</option>
                    <!-- @foreach($insurances as $insurance)
                        <option value="{{ $insurance->name }}">{{ $insurance->name }}</option>
                    @endforeach -->
                </select>

            </div>
            <div class="w-200px me-3">
                <select class="form-select select2Box" data-allow-clear="true" data-control="select2"
                    data-placeholder="Select Testimonial category" name="testimonial_category">
                    <option value="">Select Testimonial category</option>
                    <!-- @foreach($testimonialCategoryes as $testimonialCategory)
                        <option value="{{ $testimonialCategory->name }}">{{  $testimonialCategory->name }}</option>
                    @endforeach -->
                </select>
            </div>
            <div class="w-200px me-3">
                <select class="form-select" data-allow-clear="true" data-control="select2"
                    data-placeholder="Select State" name="state">
                    <option value="">Select State</option>
                    <!-- @foreach($states as $state)
                        <option value="{{ $state->name }}">{{ $state->name}}</option>
                    @endforeach -->
                </select>

            </div>
            <div class="w-200px me-3">
                <select class="form-select" data-allow-clear="true" data-control="select2"
                    data-placeholder="Select Language" name="language">
                    <option value="">Select Language</option>
                    <!-- @foreach($languages as $language)
                        <option value="{{ $language->name }}">{{ $language->name}}</option>
                    @endforeach -->
                </select>

            </div>
        </div>
    </div>
</div>
