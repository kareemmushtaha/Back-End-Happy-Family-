@extends('layouts.main')
@section('title',trans('global.create') .''. trans('cruds.role.title_singular'))
@section('content')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card card-custom example example-compact">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('global.create') }} {{ trans('cruds.role.title_singular') }}</h3>
                    <div class="card-toolbar">
                        <div class="example-tools justify-content-center">
                            <span class="example-toggle" data-toggle="tooltip" title=""
                                  data-original-title="View code"></span>
                        </div>
                    </div>
                </div>
                <!--begin::Form-->
                <form class="form fv-plugins-bootstrap fv-plugins-framework" id="formSaveRole" novalidate="novalidate"
                      method="post"  enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        <div class="mb-10" id="title">
                            <label for="exampleFormControlInput1"
                                   class="required form-label">{{ trans('cruds.role.fields.title') }}</label>
                            <input type="text" class="form-control"
                                   placeholder="{{ trans('cruds.role.fields.title') }}" name="title" id="title"/>
                            <span class="text-danger errors"
                                  id="title_error"> </span>
                        </div>
                        <div>
                            <label for="exampleFormControlInput1"
                                   class="required form-label">{{ trans('cruds.role.fields.permissions') }}</label>
                            <select class="form-control"  name="permissions[]" id="permissions" multiple required>
                                @foreach($permissions as $id => $permission)
                                     <option value="{{ $id }}">{{ $permission }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger errors"
                                  id="permissions_error"> </span>
                        </div>

                        <div class="separator separator-dashed my-10"></div>

                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-9 ml-lg-auto">
                                    <button class="btn btn-primary mr-2" type="button"
                                            id="btn_save_role"> {{ trans('global.save') }}</button>
                                    <a class="btn btn-light-primary" href="">
                                        رجوع
                                    </a>
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


        $(document).on('click', '#btn_save_role', function (e) {
            $('#btn_save_role').html('{{trans('global.save')}} <i class="fa fa-spinner fa-spin"></i>');

            e.preventDefault();
            $('.errors').text('');

            var formData = new FormData($('#formSaveRole')[0]); //get all data in form
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{ route("admin.roles.store") }}",
                data: formData, // send this data to controller
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    $('#btn_save_role').html('save');
                    if (data.status == true) {

                        Swal.fire({
                            title: "{{trans('global.create_success')}}",
                            text: "{{trans('global.create_success')}}",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "{{trans('global.confirmation')}}",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });

                        document.getElementById("formSaveRole").reset();
                    } else {
                        Swal.fire("{{trans('global.sorry_some_error')}}", "{{trans('global.sorry_some_error')}}", "error");
                    }
                }, error: function (reject) {
                    $('#btn_save_role').html("save");

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
