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
                                   name="name" id="name" value="{{ $user->name}}" required/>
                            <span class="text-danger errors"
                                  id="name_error"> </span>
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
                        <div>
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
                            title:  data.msg,
                            text:  data.msg,
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


    </script>
@endsection
