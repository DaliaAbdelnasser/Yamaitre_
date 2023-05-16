jQuery(document).ready(function($){

  var logForm = '#signin_form';

  // $(logForm).on('submit', function(event){
  //   event.preventDefault();

  //   // $('input+span>strong').text('');
  //   // $('input').parent().parent().removeClass('has-error');

  //   // $.ajaxSetup({
  //   //     headers: {
  //   //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //   //     }
  //   // });

  //   $.ajax({
  //       url: '/login',
  //       method: 'POST',
  //       data: new FormData(this),
  //       dataType: 'JSON',
  //       contentType: false,
  //       cache: false,
  //       processData: false,
  //   })
  //   .done(function (data) {
  //       $(".alert-success").prop("hidden", false);
  //   })
  //   .fail(function (data) {
  //       $.each(data.responseJSON, function (key, value) {
  //           var input = '#register-form input[name=' + key + ']';
  //           $(input + '+span>strong').text(value);
  //           $(input).parent().parent().addClass('has-error');
  //       });
  //   });

  //   // $.ajax({
  //   //     url: '/signup',
  //   //     method: 'POST',
  //   //     data: new FormData(this),
  //   //     dataType: 'JSON',
  //   //     contentType: false,
  //   //     cache: false,
  //   //     processData: false,
  //   //     success:function(response)
  //   //     {
  //   //         $(form).trigger("reset");
  //   //         alert(response.success)
  //   //     },
  //   //     error: function(data) {
  //   //         var errors = data.responseJSON;
  //   //         var errorsArr = [];
  //   //         for (error in errors) {
  //   //             errorsArr.push(errors[error][0]);
  //   //         }
  //   //         alert(errorsArr);
  //   //         console.log(errors);
  //   //     }
  //   // });
  // });

});