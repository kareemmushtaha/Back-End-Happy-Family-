<!DOCTYPE html>
<html>
@include('SitePartials.header-links')

<body>
<!-- signup steps  -->


<!-- login  -->
<div id="login" class="dark-background " STYLE="background-color: #810495">
    <div class="login-container">
        @include('SitePartials.login-modal')
    </div>
</div>
<!-- mobile menu  -->
@include('SitePartials.LandingPartials.mobile-header')
<!-- start landing page  -->

<script src="{{asset('assets/site/js/script.js')}}"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>


<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $(document).on('click', '#btn_login_user', function (e) {
        $('#btn_login_user').html('انتظر <i class="fa fa-spinner fa-spin"></i>').addClass('link-disabled');
        e.preventDefault();
        $('.errors').text('');
        var formData = new FormData($('#formLoginUser')[0]); //get all data in form
        $.ajax({
            type: 'post',
            enctype: 'multipart/form-data',
            url: "{{ route("login") }}",
            data: formData, // send this data to controller
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                $('#btn_login_user').html('save').removeClass('link-disabled');
                if (data.status == true) {
                    document.getElementById("formLoginUser").reset();
                    setTimeout(function () {
                        //the url I want to redirect to
                        $(location).attr('href', data.redirect_url);
                    }, 0);
                } else {
                    Swal.fire("{{trans('global.sorry_some_error')}}", "{{trans('global.sorry_the_password_is_incorrect_or_the_email_address_is_incorrect')}}", "error");
                }
            }, error: function (reject) {
                $('#btn_login_user').html('تسجيل الدخول').removeClass('link-disabled');
                var response = $.parseJSON(reject.responseText);
                messages = "";
                $.each(response.errors, function (key, val) {
                    // for loop to all validation and show all validate
                    messages = val[0] + " " + messages;
                });
                Swal.fire("{{trans('global.sorry_some_error')}}", messages, "error");

            }
        });
    });

</script>
</body>
</html>
