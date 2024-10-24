"use strict";
var Description = function () {
    var cancelButton;
    const initQuillProduct = () => {
        var pro_eleme2 = '#kt_ecommerce_long_description';
        var quill_full_biography = document.querySelector('#kt_ecommerce_long_description');
        // quill_full_biography = new Quill(pro_eleme2, {
        //     modules: {
        //         toolbar: [
        //             [{
        //                 header: [1, 2, 3, 4, 5, 6, false]
        //             }],
        //             ['bold', 'italic', 'underline'],
        //             ['image', 'code-block'],
        //             [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        //             ['clean']
        //         ]
        //     },
        //     placeholder: 'Type your text here...',
        //     theme: 'snow' // or 'bubble'
        // });
        // quill_full_biography.on('text-change', function(delta, oldDelta, source) {
        //     $('#long_description').val(quill_full_biography.container.firstChild.innerHTML);
        // });
        var pro_eleme3 = '#kt_ecommerce_short_description';
        var quill_short_biography = document.querySelector('#kt_ecommerce_short_description');
        // prodcut desctionpt
        // quill_short_biography = new Quill(pro_eleme3, {
        //     modules: {
        //         toolbar: [
        //             [{
        //                 header: [1, 2, 3, 4, 5, 6, false]
        //             }],
        //             ['bold', 'italic', 'underline'],
        //             ['image', 'code-block'],
        //             [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        //             ['clean']
        //         ]
        //     },
        //     placeholder: 'Type your text here...',
        //     theme: 'snow' // or 'bubble'
        // });
        // quill_short_biography.on('text-change', function(delta, oldDelta, source) {
        //     $('#short_description').val(quill_short_biography.container.firstChild.innerHTML);
        // });
    }
    const initFormRepeater = () => {
        $('#kt_ecommerce_add_image').repeater({
            initEmpty: false,
            defaultValues: {
                'id': '12'
            },
            show: function () {
                $(this).slideDown();
                $(this).find(".image-input").addClass("removeimage1");
                KTImageInput.createInstances('[data-kt-image-input="true"]');
            },
            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            },
            ready: function () {
                KTImageInput.createInstances('[data-kt-image-input="true"]');
            }

        });
    }
    return {
        init: function () {
            initQuillProduct();
            initFormRepeater();
        }
    };
}();
KTUtil.onDOMContentLoaded(function () {
    Description.init();
});

$('.form').submit(function (e) {
    e.preventDefault();
    let formData = new FormData(this);
    console.log(formData, "formdata")
    let button = $(this).find('button[type=submit]:focus');
    button.attr('disabled', true);
    button.attr('data-kt-indicator', 'on');
    var route = $('#name').val();
    $.ajax({
        url: base_url + '/prepage/' + route + '/' + $('#update_id').val(),
        type: 'POST',
        contentType: false,
        processData: false,
        data: formData,
        success: function (response) {

            toastr.success(response.message);
        },
        error: function (response) {
            if (typeof response.responseJSON.error === 'string') {
                toastr.error(response.responseJSON.error);
                return;
            }
            $.each(response.responseJSON.error, function (key, value) {
                if (key == 'kt_ecommerce_add_image') {
                    $('#' + key + '-error').text('Title section is required');
                } else {
                    $('#' + key + '-error').text(value[0]);
                }
            });
        },
        complete: function (response) {
            button.removeAttr('data-kt-indicator');
            $('.form').find('button[type=submit]').attr('disabled', false);
        }
    });
});
