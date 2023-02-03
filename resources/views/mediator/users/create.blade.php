@extends('layoutsMediator.main')
@section('title',trans('global.create') .''. trans('cruds.user.title_singular'))

@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container">
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card card-custom example example-compact">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('global.add') }} {{ trans('cruds.user.title_singular') }}</h3>
                    <div class="card-toolbar">
                        <div class="example-tools justify-content-center">
                            <span class="example-toggle" data-toggle="tooltip" title=""
                                  data-original-title="View code"></span>
                        </div>
                    </div>
                </div>

                <!--begin::Form-->
                <form class="form fv-plugins-bootstrap fv-plugins-framework" id="formUpdateUser" novalidate="novalidate"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="col-md-6 fv-row">
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">{{ trans('cruds.user.fields.photo') }}</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                       title="Specify a target name for future usage and reference"></i>
                                </label>
                                <!--end::Label-->
                                <input type="file" class="form-control form-control-solid"
                                       name="photo" id="photo"/>
                                <span class="text-danger errors"
                                      id="photo_error"> </span>
                            </div>
                        </div>
                        <div class="row g-9 mb-8">
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">{{ trans('cruds.user.fields.first_name') }}</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                           title="Specify a target name for future usage and reference"></i>
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" class="form-control form-control-solid"
                                           placeholder="{{ trans('cruds.user.fields.name') }}"
                                           name="first_name" id="first_name"/>
                                    <span class="text-danger errors"
                                          id="first_name_error"> </span>
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">{{ trans('cruds.user.fields.last_name') }}</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                           title="Specify a target name for future usage and reference"></i>
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" class="form-control form-control-solid"
                                           placeholder="{{ trans('cruds.user.fields.name') }}"
                                           name="last_name" id="last_name"/>
                                    <span class="text-danger errors"
                                          id="last_name_error"> </span>
                                </div>
                            </div>

                        </div>

                        <div class="row g-9 mb-8">
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">{{ trans('cruds.user.fields.fake_name') }}</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                           title="Specify a target name for future usage and reference"></i>
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" class="form-control form-control-solid"
                                           placeholder="{{ trans('cruds.user.fields.fake_name') }}"
                                           name="fake_name" id="fake_name"/>
                                    <span class="text-danger errors"
                                          id="fake_name_error"> </span>
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">{{ trans('cruds.user.fields.gender') }}</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                           title="Specify a target name for future usage and reference"></i>
                                    </label>
                                    <!--end::Label-->
                                    <select class="form-control form-control-solid" name="user_gender" id="gender" required>
                                        <option value="">حدد الجنس</option>
                                            <option value="male">ذكر</option>
                                            <option value="female">أنثى</option>
                                    </select>
                                    <span class="text-danger errors"
                                          id="user_gender_error"> </span>
                                </div>
                            </div>

                        </div>

                        <div class="row g-9 mb-8">
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">{{ trans('cruds.user.fields.email') }}</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                           title="Specify a target name for future usage and reference"></i>
                                    </label>
                                    <!--end::Label-->
                                    <input type="email" class="form-control form-control-solid"
                                           placeholder="{{ trans('cruds.user.fields.email') }}"
                                           name="email" id="email"/>
                                    <span class="text-danger errors"
                                          id="email_error"> </span>
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">{{ trans('cruds.user.fields.password') }}</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                           title="Specify a target name for future usage and reference"></i>
                                    </label>
                                    <!--end::Label-->
                                    <input type="password" class="form-control form-control-solid"
                                           placeholder="{{ trans('cruds.user.fields.password') }}"
                                           name="password" id="password"/>
                                    <span class="text-danger errors"
                                          id="password_error"> </span>
                                </div>
                            </div>

                        </div>
                        <div class="row g-9 mb-8">
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">{{ trans('cruds.user.fields.phone') }}</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                           title="Specify a target name for future usage and reference"></i>
                                    </label>
                                    <!--end::Label-->
                                    <input type="number" class="form-control form-control-solid"
                                           placeholder="{{ trans('cruds.user.fields.phone') }}"
                                           name="phone" id="phone"/>
                                    <span class="text-danger errors"
                                          id="phone_error"> </span>
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">{{ trans('cruds.user.fields.birth_date') }}</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                           title="Specify a target name for future usage and reference"></i>
                                    </label>
                                    <!--end::Label-->
                                    <input type="date" class="form-control form-control-solid"
                                           placeholder="{{ trans('cruds.user.fields.birth_date') }}"
                                           name="birth_date" id="birth_date"/>
                                    <span class="text-danger errors"
                                          id="birth_date_error"> </span>
                                </div>
                            </div>

                        </div>
                        <div class="row g-9 mb-8">
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">{{ trans('cruds.user.fields.nationality') }}</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                           title="Specify a target name for future usage and reference"></i>
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" class="form-control form-control-solid"
                                           placeholder="{{ trans('cruds.user.fields.nationality') }}"
                                           name="nationality" id="nationality"/>
                                    <span class="text-danger errors"
                                          id="nationality_error"> </span>
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">{{ trans('cruds.user.fields.country_id') }}</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                           title="Specify a target name for future usage and reference"></i>
                                    </label>
                                    <!--end::Label-->
                                    <select class="form-control form-control-solid" name="country_id" id="country_id" required>
                                        <option value="">اختر الدولة</option>
                                        @isset($countries)
                                            @foreach($countries as $country)
                                                <option value="{{$country->id}}">{{$country->title}}</option>

                                            @endforeach
                                        @endisset
                                    </select>
                                    <span class="text-danger errors"
                                          id="country_id_error"> </span>
                                </div>
                            </div>

                        </div>
                        <div class="row g-9 mb-8">
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">{{ trans('cruds.user.fields.aria_id') }}</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                           title="Specify a target name for future usage and reference"></i>
                                    </label>
                                    <!--end::Label-->
                                    <select class="form-control form-control-solid" name="aria_id" id="aria_id" required>
                                        <option value="">اختر المنطقة</option>
                                    </select>
                                    <span class="text-danger errors"
                                          id="aria_id_error"> </span>
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">{{ trans('cruds.user.fields.city_id') }}</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                           title="Specify a target name for future usage and reference"></i>
                                    </label>
                                    <!--end::Label-->
                                    <select class="form-control form-control-solid" name="city_id" id="city_id" required>
                                        <option value="">اختر المدينة</option>
                                    </select>
                                    <span class="text-danger errors"
                                          id="city_id_error"> </span>
                                </div>
                            </div>

                        </div>
                        <div class="row g-9 mb-8">
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">{{ trans('cruds.user.fields.height') }}</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                           title="Specify a target name for future usage and reference"></i>
                                    </label>
                                    <!--end::Label-->
                                    <input type="number" class="form-control form-control-solid"
                                           placeholder="{{ trans('cruds.user.fields.height') }}"
                                           name="height" id="height"/>
                                    <span class="text-danger errors"
                                          id="height_error"> </span>
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">{{ trans('cruds.user.fields.width') }}</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                           title="Specify a target name for future usage and reference"></i>
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" class="form-control form-control-solid"
                                           placeholder="{{ trans('cruds.user.fields.width') }}"
                                           name="width" id="width"/>
                                    <span class="text-danger errors"
                                          id="width_error"> </span>
                                </div>
                            </div>

                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required"> حالة الظهور</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                           title="Specify a target name for future usage and reference"></i>
                                    </label>
                                    <!--end::Label-->
                                    <select class="form-control form-control-solid" name="show_profile" id="show_profile" required>
                                        <option value="">حدد حالة الظهور</option>
                                        <option value="0" >إخفاء البروفايل</option>
                                        <option value="1" >إظهار البروفايل</option>
                                    </select>
                                    <span class="text-danger errors"
                                          id="show_profile_error"></span>
                                </div>
                            </div>

                        </div>
                        <div class="row g-9 mb-8">
                            <div class="col-md-12 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">{{ trans('cruds.user.fields.questions') }} <span class="text-danger">(الرجاء إجابة جميع الأسئلة)</span></span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                           title="Specify a target name for future usage and reference"></i>
                                    </label>
                                    <!--end::Label-->
                                    @foreach($questions as $question)
                                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                            <span class="required"> {{$question->question_title}}</span>
                                        </label>
                                        <div class="advanced-selects-container">
                                            <div>
                                                <select class="form-control form-control-solid" name="answers[]" id="answers" required>
                                                    <option value="null" selected>اختر الاجابة</option>
                                                    @foreach($question->answers as $answer)
                                                        <option value="{{$answer->id}}" data-question_id="{{$question->id}}">{{$answer->answer_title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endforeach
                                    <span class="text-danger errors"
                                          id="answers_error"> </span>

                                </div>
                            </div>

                        </div>



                        <div class="separator separator-dashed my-10"></div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-9 ml-lg-auto">
                                    <a class="btn btn-light-primary" onclick="history.back();">
                                        {{ trans('global.back') }}
                                    </a>
                                    <button class="btn btn-primary mr-2" type="button"
                                            id="btn_update_user"> {{ trans('global.save') }}</button>

                                </div>
                            </div>
                        </div>
                        <input type="hidden">
                        <div></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection


@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('change', '#country_id', function (e) {
            e.preventDefault();

            let country_id = $(this).val();
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{ route("mediator.filterAreas") }}",
                data: {'country_id': country_id}, // send this data to controller
                dataType: 'json',

                success: function (data) {
                    $('select[name="aria_id"]').empty();
                    $('select[name="aria_id"]').append('<option value="">اختر المنطقة</option>');
                    $.each(data.areas, function (key, value) {

                        $('select[name="aria_id"]').append(`<option value="${value.id}">${value.title}</option>`);
                    });

                }
            });
        });

        $(document).on('change', '#aria_id', function (e) {
            e.preventDefault();

            let area_id = $(this).val();
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{ route("mediator.filterCities") }}",
                data: {'area_id': area_id}, // send this data to controller
                dataType: 'json',

                success: function (data) {
                    $('select[name="city_id"]').empty();
                    $('select[name="city_id"]').append('<option value="">اختر المدينة</option>');
                    $.each(data.cities, function (key, value) {

                        $('select[name="city_id"]').append(`<option value="${value.id}">${value.title}</option>`);
                    });

                }
            });
        });
        $(document).on('click', '#btn_update_user', function (e) {
            e.preventDefault();
            $('.errors').text('');

            var formData = new FormData($('#formUpdateUser')[0]); //get all data in form
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{ route("mediator.users.store") }}",
                data: formData, // send this data to controller
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    $('#btn_update_user').html();

                    if (data.status == true) {
                        Swal.fire({
                            title:  data.msg,
                            text:  data.msg,
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "{{trans('global.confirmation')}}",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }

                        });

                        setTimeout(function () {
                            window.location = '{{route('mediator.users.index')}}'
                        }, 1000);

                    } else {
                        Swal.fire("{{trans('global.sorry_some_error')}}", "{{trans('global.sorry_some_error')}}", "error");
                    }
                }, error: function (reject) {
                    $('#btn_update_user').html('save');

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
