$('#kt_forgot_in_submit').click(function () {
  let form_data = $("#forgot-form").serialize();
  $.ajax({
      url: submit_url,
      type: "POST",
      data: form_data,
      success: function (response) {
          console.log(response.message);
          $('.field-error').text(" ");
          window.location.href = url;
          toastr.success(response.message);
      },
      error: function (response) {
          console.log(response);
          $("#forgot-form").attr("disabled", false);
          $.each(response.responseJSON.errors, function (field_name, error) {
              $('#' + field_name + '-error').text(error[0]);
          });
          toastr.error(response.responseJSON.message);
      }
  });
});

$(".toggle-password").click(function() {
  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
      input.attr("type", "text");
  } else {
      input.attr("type", "password");
  }
});
