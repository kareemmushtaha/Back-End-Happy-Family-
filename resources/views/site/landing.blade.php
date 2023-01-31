<!DOCTYPE html>
<html>
@include('SitePartials.header-links')

<body>
<!-- signup steps  -->

@include('SitePartials.register-modal')

<!-- login  -->
<div id="login" class="dark-background hidden">
    <div class="login-container">
        @include('SitePartials.login-modal')
    </div>
</div>
<!-- mobile menu  -->
@include('SitePartials.LandingPartials.mobile-header')
<!-- start landing page  -->
<div class="landing-dark">
    <img class="cubble" src="{{asset('assets/site/images/cubble.png')}}" alt=""/>
    <img class="like" src="{{asset('assets/site/images/like.png')}}" alt=""/>
    <img class="love" src="{{asset('assets/site/images/love.png')}}" alt=""/>
    <div class="landing-main">

        @include('SitePartials.LandingPartials.landing-header')
        @include('SitePartials.LandingPartials.first-section')

    </div>
</div>

@include('SitePartials.LandingPartials.second-section')
@include('SitePartials.LandingPartials.third-section')
@include('SitePartials.LandingPartials.fourth-section')
@include('SitePartials.LandingPartials.fifth-section')
@include('SitePartials.LandingPartials.subscription-section')
@include('SitePartials.LandingPartials.how-chose-section')
@include('SitePartials.LandingPartials.question-answer-section')
@include('SitePartials.LandingPartials.contact-section')


@include('SitePartials.footer')
<script src="{{asset('assets/site/js/script.js')}}"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>


<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $(document).on('click', '#btn_register_user', function (e) {
        $('#btn_register_user').html('انتظر <i class="fa fa-spinner fa-spin"></i>').addClass('link-disabled');
        e.preventDefault();
        $('.errors').text('');
        var formData = new FormData($('#formRegisterUser')[0]); //get all data in form
        $.ajax({
            type: 'post',
            enctype: 'multipart/form-data',
            url: "{{ route("user.register") }}",
            data: formData, // send this data to controller
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                $('#btn_register_user').html('save').removeClass('link-disabled');

                if (data.status == true) {

                    document.getElementById("formRegisterUser").reset();
                    setTimeout(function () {
                        var url = "{{ route('home') }}"; //the url I want to redirect to
                        $(location).attr('href', url);
                    }, 0);

                } else {
                    Swal.fire("{{trans('global.sorry_some_error')}}", "{{trans('global.sorry_some_error')}}", "error");
                }
            }, error: function (reject) {
                $('#btn_register_user').html('أقسم بالله').removeClass('link-disabled');
                var response = $.parseJSON(reject.responseText);
                $.each(response.errors, function (key, val) {
                    // for loop to all validation and show all validate
                    $("#" + key + "_error").text(val[0] + "  **  ") ;
                });
            }
        });

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
                        $(location).attr('href', data.redirect_url);
                    }, 0);
                } else if (data.status == 422) {
                    Swal.fire("{{trans('global.sorry_some_error')}}", "{{trans('global.You_should_verify_your_account_first')}}", "error");

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

    $(document).on('click', '#btn_contact_us', function (e) {
        $('#btn_contact_us').html('جاري الارسال <i class="fa fa-spinner fa-spin"></i>').addClass('link-disabled');
        e.preventDefault();
        $('.errors').text('');
        var formData = new FormData($('#formcontact')[0]); //get all data in form
        $.ajax({
            type: 'post',
            enctype: 'multipart/form-data',
            url: "{{ route("sendContactUsLanding") }}",
            data: formData, // send this data to controller
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                $('#btn_contact_us').html('ارسال').removeClass('link-disabled');

                document.getElementById("formcontact").reset();
                setTimeout(function () {
                    //the url I want to redirect to
                    $(location).attr('href', data.redirect_url);
                }, 0);

            }, error: function (reject) {
                $('#btn_contact_us').html('ارسال').removeClass('link-disabled');
                var response = $.parseJSON(reject.responseText);
                $.each(response.errors, function (key, val) {
                    // for loop to all validation and show all validate
                    $("#" + key + "_error").text(val[0]);
                });
            }
        });
    });

    $(document).on('change', '#country', function (e) {
        e.preventDefault();

        let country_id = $(this).val();
        $.ajax({
            type: 'post',
            enctype: 'multipart/form-data',
            url: "{{ route("filterAreas") }}",
            data: {'country_id': country_id}, // send this data to controller
            dataType: 'json',

            success: function (data) {
                $('select[name="area"]').empty();
                $('select[name="area"]').append('<option value="">المنطقه</option>');
                $.each(data.areas, function (key, value) {

                    $('select[name="area"]').append(`<option value="${value.id}">${value.title}</option>`);
                });

            }
        });
    });

    $(document).on('change', '#area', function (e) {
        e.preventDefault();

        let area_id = $(this).val();
        $.ajax({
            type: 'post',
            enctype: 'multipart/form-data',
            url: "{{ route("filterCities") }}",
            data: {'area_id': area_id}, // send this data to controller
            dataType: 'json',

            success: function (data) {
                $('select[name="city"]').empty();
                $('select[name="city"]').append('<option value="">المدينة</option>');
                $.each(data.cities, function (key, value) {

                    $('select[name="city"]').append(`<option value="${value.id}">${value.title}</option>`);
                });

            }
        });
    });
</script>


</body>
</html>
