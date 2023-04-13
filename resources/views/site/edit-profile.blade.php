@extends('SitePartials.main')
@section('content')

    <form id="formUpdateUser" method="POST">
        @method('post')
        @csrf
        <div class="settings-container">
            <div class="img-border mx-auto position-relative">
                <input id="file-img" type="file" name="photo" onchange="changeImg(event)"/>
                <div class="change-img">تغيير الصورة</div>
                <img id="profile-img" src="{{$user->photo}}" alt=""/>
            </div>
            <div class="settings-inputs-container">
                <input hidden value="{{$user->id}}" name="id"/>
                <input value="{{$user->first_name}}" name="first_name" placeholder="الاسم الاول"/>
                <input value="{{$user->last_name}}" name="last_name" placeholder="العائله"/>
                <input value="{{$user->fake_name}}" name="fake_name" placeholder="الاسم الرمزي"/>
                <input value="{{$user->height}}" name="height" placeholder="الطول"/>
                <input value="{{$user->width}}" name="width" placeholder="الوزن"/>
                <input value="{{$user->phone}}" name="phone" placeholder="رقم الجوال"/>
                <input  value="{{$user->email}}" name="email" placeholder="البريد الإلكتروني"/>
                <span id="email_error"></span>
            </div>
            <div class="settings-selects-container">
                <select name="nationality">
                    <option disabled value="" >إختر الجنسية</option>
                @foreach(\App\Models\Country::all() as $country)
                        <option value="{{$country->title}}"
                                @if($user->nationality == $country->title) selected @endif>{{$country->title}}</option>
                    @endforeach
                </select>

                <select name="country_id" id="country">
                    <option disabled value="" > إختر دولة الإقامة</option>
                    @foreach(\App\Models\Country::all() as $Country)
                        <option value="{{$Country->id}}"
                                @if($Country->id == $user->country_id) selected @endif>{{$Country->title}}</option>
                    @endforeach
                </select>

                <select name="aria_id" id="area">
                    <option value="" disabled>إختر المنطقه</option>
                    @foreach(\App\Models\Aria::where('country_id', $user->country_id)->get() as $Aria)
                        <option value="{{$Aria->id}}"
                                @if($Aria->id == $user->aria_id) selected @endif>{{$Aria->title}}</option>
                    @endforeach
                </select>


                <select name="city_id">
                    <option value="" hidden>المدينه</option>
                    @foreach(\App\Models\City::where('aria_id', $user->aria_id)->get() as $City)
                        <option value="{{$City->id}}"
                                @if($City->id == $user->city_id) selected @endif>{{$City->title}}</option>
                    @endforeach
                </select>

                <h2 class=""> تاريخ الميلاد : </h2>
                <input type="date" value="{{$user->birth_date}}" name="birth_date"/>
            </div>
            <button type="button" id="btn_profile_form">حفظ التعديلات</button>
        </div>
    </form>

@endsection


@section('script')
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

        $(document).on('click', '#btn_profile_form', function (e) {
            $('#btn_profile_form').html('{{trans('global.check')}} <i class="fa fa-spinner fa-spin"></i>').addClass('link-disabled');
            e.preventDefault();
            $('.errors').text('');

            var formData = new FormData($('#formUpdateUser')[0]); //get all data in form
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{ route("update_profile") }}",
                data: formData, // send this data to controller
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    window.location = "{{route('edit_profile')}}";
                }, error: function (reject) {
                    $('#btn_profile_form').html('save').removeClass('link-disabled');
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function (key, val) {
                        // for loop to all validation and show all validate
                        $("#" + key + "_error").text(val[0]);
                    });
                }
            });
        });
    </script>

@endsection
