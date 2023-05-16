jQuery(document).ready(function($){
    var lawyerBtn = $('#lawyer_form');
    var clientBtn = $('#client_form');
    var submitBtn = $('.submit-btn');
    $('.client-title').hide();
    var userType = $('input[name="user_type"]');
    userType.val('lawyer');
    // $('.lawyer-input select, .lawyer-input input').prop('required',true);
    lawyerBtn.click(function(){
        // $(this).parent.addClass('active');
        // $('.lawyer-input select, .lawyer-input input').prop('required',true);
        $('.lawyer-input').show();
        $('.lawyer-title').show();
        $('.client-title').hide();
        userType.val('lawyer');
    });

    clientBtn.click(function(){
        // $(this).parent.addClass('active');
        // $('.lawyer-input select, .lawyer-input input').prop('required',false);
        $('.lawyer-input').hide();
        $('.lawyer-title').hide();
        $('.client-title').show();
        userType.val('client');
    });
    // submitBtn.click(function(e){
    //     e.preventDefault();
    //    if(userType.val() == 'lawyer'){
    //     if ($('.filey').get(0).files.length === 0) {
    //        $('.lawyer_id').append('<div class="error"> من فضلك ادخل صورة الكارنيه</div>');
    //     }
    //     if ($('.court_input select').val() == '') {
    //         $('.court_input').append('<div class="error"> من فضلك اختر المحكمة التابع لها </div>');
    //      }
    //    }
    //     else{
    //         $('form').submit();
    //     }
    // });

    var regForm = '#register-form';

    var articleData = new FormData($('#register-form')[0]);

    // $(regForm).on('submit', function(event){
    //     event.preventDefault();

    //     $('input+span>strong').text('');
    //     $('input').parent().parent().removeClass('has-error');

    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });

    //     $.ajax({
    //         method: "POST",
    //         url: "/signup",
    //         dataType: 'JSON',
    //         processData: false,
    //         contentType: false,
    //         cache: false,
    //         data: articleData
    //     })
    //     .done(function (darticleDataata) {
    //         $(".alert-success").prop("hidden", false);
    //     })
    //     .fail(function (data) {
    //         $.each(data.responseJSON, function (key, value) {
    //             var input = '#register-form input[name=' + key + ']';
    //             $(input + '+span>strong').text(value);
    //             $(input).parent().parent().addClass('has-error');
    //         });
    //     });

    //     $.ajax({
    //         url: '/signup',
    //         method: 'POST',
    //         data: new FormData(this),
    //         dataType: 'JSON',
    //         contentType: false,
    //         cache: false,
    //         processData: false,
    //         success:function(response)
    //         {
    //             $(form).trigger("reset");
    //             alert(response.success)
    //         },
    //         error: function(data) {
    //             var errors = data.responseJSON;
    //             var errorsArr = [];
    //             for (error in errors) {
    //                 errorsArr.push(errors[error][0]);
    //             }
    //             alert(errorsArr);
    //             console.log(errors);
    //         }
    //     });
    // });


});
