@extends('layouts.main')
@section('title',trans('global.edit') .''. trans('cruds.user.title_singular'))

@section('content')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card card-custom example example-compact">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('global.edit') }} {{ trans('cruds.user.title_singular') }}</h3>
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
                    @method('PUT')
                    <div class="card-body">

                        <div class="mb-10">
                            <label for="exampleFormControlInput1"
                                   class="required form-label">{{ trans('cruds.user.fields.name') }}</label>
                            <input type="text" class="form-control" placeholder="{{ trans('cruds.user.fields.name') }}"
                                   name="first_name" id="first_name" value="{{ $user->first_name}}" required/>
                            <span class="text-danger errors"
                                  id="first_name_error"> </span>
                        </div>

                        <div class="mb-10" id="email">
                            <label for="exampleFormControlInput1"
                                   class="required form-label">{{ trans('cruds.user.fields.email') }}</label>
                            <input type="email" class="form-control"
                                   placeholder="{{ trans('cruds.user.fields.email') }}" name="email"
                                   id="email" value="{{ $user->email}}"/>
                            <span class="text-danger errors"
                                  id="email_error"> </span>
                        </div>

                        <div class="mb-10" id="password">
                            <label for="exampleFormControlInput1"
                                   class="required form-label">{{ trans('cruds.user.fields.password') }}</label>
                            <input type="password" class="form-control"
                                   placeholder="{{ trans('cruds.user.fields.password') }}" name="password"
                                   id="password"/>
                            <span class="text-danger errors"
                                  id="password_error"> </span>
                        </div>
                        <div style="display: none">
                            <label for="exampleFormControlInput1"
                                   class="required form-label">{{ trans('cruds.user.fields.roles') }}</label>
                            <select class="form-control" name="roles[]" id="roles" multiple required>
                                @foreach($roles as $id => $role)
                                    <option
                                        value="{{ $id }}" {{ (in_array($id, old('roles', [])) || $user->roles->contains($id)) ? 'selected' : '' }}>{{ $role }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger errors"
                                  id="roles_error"> </span>
                        </div>


                        <div class="separator separator-dashed my-10"></div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-9 ml-lg-auto">
                                    <a class="btn btn-light-primary" onclick="history.back();">
                                        {{ trans('global.back') }}
                                    </a>
                                    <button class="btn btn-primary mr-2" type="button"
                                            id="btn_update_user"> {{ trans('global.edit') }}</button>

                                </div>
                            </div>
                        </div>
                        <input type="hidden">
                        <div></div>
                    </div>
                </form>
            </div>
            <br>

            @if(in_array($user->getType(),['mediator','user']))
                @if(checkUserHaveSubscription($user->id))
                    <div class="card card-custom example example-compact ">
                        <div class="card-header">
                            <h3 class="card-title">{{ trans('global.upgrade') }} {{ trans('cruds.subscriptions.the_title') }}</h3>
                            <div class="card-toolbar">
                                <div class="example-tools justify-content-center">
                            <span class="example-toggle" data-toggle="tooltip" title=""
                                  data-original-title="View code"></span>
                                </div>
                            </div>
                        </div>

                        <!--begin::Form-->
                        <form class="form fv-plugins-bootstrap fv-plugins-framework" id="formUpgradeSubscription"
                              novalidate="novalidate"
                              method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div class="card-body">

                                <div class="mb-10">
                                    <label for="exampleFormControlInput1"
                                           class="required form-label"> {{ trans('cruds.subscriptions.fields.price') }}</label>
                                    <input type="number" class="form-control"
                                           placeholder="{{ trans('cruds.subscriptions.fields.price') }}"
                                           name="price" id="price" value="" required/>
                                    <span class="text-danger errors"
                                          id="price_error"> </span>
                                </div>

                                <div class="mb-10">
                                    <label for="exampleFormControlInput1"
                                           class="required form-label"> {{ trans('cruds.subscriptions.fields.start_date') }}</label>
                                    <input type="date" class="form-control"
                                           placeholder="{{ trans('cruds.subscriptions.fields.start_date') }}"
                                           name="start_date" id="start_date" value="" required/>
                                    <span class="text-danger errors"
                                          id="start_date_error"> </span>
                                </div>

                                <div class="mb-10">
                                    <label for="exampleFormControlInput1"
                                           class="required form-label"> {{ trans('cruds.subscriptions.fields.end_subscription_date') }}</label>
                                    <input type="date" class="form-control"
                                           placeholder="{{ trans('cruds.subscriptions.fields.end_subscription_date') }}"
                                           name="end_subscription_date" id="end_subscription_date" required/>
                                    <span class="text-danger errors"
                                          id="end_subscription_date_error"> </span>
                                </div>

                                <div class="separator separator-dashed my-10"></div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-lg-9 ml-lg-auto">
                                            <a class="btn btn-light-primary" onclick="history.back();">
                                                {{ trans('global.back') }}
                                            </a>
                                            <button class="btn btn-primary mr-2" type="button"
                                                    id="btn_upgradeSubscription"> {{ trans('global.edit') }}</button>

                                        </div>
                                    </div>
                                </div>
                                <input type="hidden">
                                <div></div>
                            </div>
                        </form>
                    </div>
                @else
                    <div class="card-body card-rounded bg-light-primary">
                        <div class="form-group form-group-last">
                            <div class="alert alert-custom alert-default" role="alert">
                                <div class="alert-icon"><span class="svg-icon svg-icon-primary svg-icon-xl"><!--begin::Svg Icon | path:/metronic/theme/html/demo4/dist/assets/media/svg/icons/Tools/Compass.svg--><svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path
            d="M7.07744993,12.3040451 C7.72444571,13.0716094 8.54044565,13.6920474 9.46808594,14.1079953 L5,23 L4.5,18 L7.07744993,12.3040451 Z M14.5865511,14.2597864 C15.5319561,13.9019016 16.375416,13.3366121 17.0614026,12.6194459 L19.5,18 L19,23 L14.5865511,14.2597864 Z M12,3.55271368e-14 C12.8284271,3.53749572e-14 13.5,0.671572875 13.5,1.5 L13.5,4 L10.5,4 L10.5,1.5 C10.5,0.671572875 11.1715729,3.56793164e-14 12,3.55271368e-14 Z"
            fill="#000000" opacity="0.3"/>
        <path
            d="M12,10 C13.1045695,10 14,9.1045695 14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 C10,9.1045695 10.8954305,10 12,10 Z M12,13 C9.23857625,13 7,10.7614237 7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 C17,10.7614237 14.7614237,13 12,13 Z"
            fill="#000000" fill-rule="nonzero"/>
    </g>
</svg><!--end::Svg Icon--></span></div>
                                <div class="alert-text">
                                    {{trans('global.sorry_you_have_package_activated_cant_upgrade')}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                @endif
            @endif
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
        $(document).on('click', '#btn_update_user', function (e) {
            e.preventDefault();
            $('.errors').text('');

            var formData = new FormData($('#formUpdateUser')[0]); //get all data in form
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{ route("admin.users.update", $user->id) }}",
                data: formData, // send this data to controller
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    $('#btn_update_user').html();

                    if (data.status == true) {
                        Swal.fire({
                            title: data.msg,
                            text: data.msg,
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "{{trans('global.confirmation')}}",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });

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

        $(document).on('click', '#btn_upgradeSubscription', function (e) {
            e.preventDefault();
            $('.errors').text('');
            var formData = new FormData($('#formUpgradeSubscription')[0]); //get all data in form
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{ route("admin.users.upgradeSubscription", $user->id) }}",
                data: formData, // send this data to controller
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    $('#btn_upgradeSubscription').html();

                    if (data.status == true) {
                        Swal.fire({
                            title: data.msg,
                            text: data.msg,
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "{{trans('global.confirmation')}}",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });

                    } else {
                        Swal.fire("{{trans('global.sorry_some_error')}}", data.msg, "error");
                    }
                }, error: function (reject) {
                    $('#btn_upgradeSubscription').html('save');

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
