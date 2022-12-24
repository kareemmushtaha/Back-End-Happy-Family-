<!DOCTYPE html>
<html>
@include('SitePartials.header-links')

<body  style="background-color: #810495">
<!-- signup steps  -->


@include('SitePartials.register-modal')

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
                $('select[name="aria_id"]').empty();
                $('select[name="aria_id"]').append('<option value="">المنطقه</option>');
                $.each(data.areas, function (key, value) {

                    $('select[name="aria_id"]').append(`<option value="${value.id}">${value.title}</option>`);
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
                $('select[name="city_id"]').empty();
                $('select[name="city_id"]').append('<option value="">المدينة</option>');
                $.each(data.cities, function (key, value) {

                    $('select[name="city_id"]').append(`<option value="${value.id}">${value.title}</option>`);
                });

            }
        });
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
</script>
</body>
</html>
