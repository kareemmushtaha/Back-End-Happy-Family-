@extends('layoutsMediator.main')
@section('title',__('cruds.user.change_password'))
@section('content')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card card-custom example example-compact">
                <div class="card-header">
                    <h3 class="card-title">{{__('cruds.user.change_password')}}</h3>
                    <div class="card-toolbar">
                        <div class="example-tools justify-content-center">
                            <span class="example-toggle" data-toggle="tooltip" title=""
                                  data-original-title="View code"></span>
                        </div>
                    </div>
                </div>

                <!--begin::Form-->
                <form class="form fv-plugins-bootstrap fv-plugins-framework" id="formChangePassword" novalidate="novalidate"
                      method="post"  enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        <div class="row">
                            <div class="col-6 mb-10">
                                <label for="exampleFormControlInput1"
                                       class="required form-label">{{__('cruds.user.new_password')}}</label>
                                <input type="password" class="form-control" placeholder="{{__('cruds.user.new_password')}}"
                                       name="password" id="password" required/>
                                <span class="text-danger errors"
                                      id="password_error"> </span>
                            </div>


                            <div class="col-6 mb-10" id="email">
                                <label for="exampleFormControlInput1"
                                       class="required form-label">{{__('cruds.user.confirm_password')}}</label>
                                <input type="password" class="form-control"
                                       placeholder="{{__('cruds.user.confirm_password')}}" value="" name="password_confirmation"
                                       id="password_confirmation"/>
                                <span class="text-danger errors"
                                      id="password_confirmation_error"> </span>
                            </div>
                        </div>

                        <div class="separator separator-dashed my-10"></div>

                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-9 ml-lg-auto">
                                    <button class="btn btn-primary mr-2" type="button"
                                            id="btn_change_password"> {{ trans('global.save') }}</button>
                                    <a class="btn btn-light-primary" href=" ">
                                        {{ trans('global.back') }}
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


        $(document).on('click', '#btn_change_password', function (e) {
            $('#btn_change_password').html('{{trans('global.save')}} <i class="fa fa-spinner fa-spin"></i>');

            e.preventDefault();
            $('.errors').text('');

            var formData = new FormData($('#formChangePassword')[0]); //get all data in form
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{ route("admin.users.saveChangePassword") }}",
                data: formData, // send this data to controller
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    $('#btn_change_password').html('save');
                    if (data.status == true) {

                        Swal.fire({
                            title: "{{trans('global.create_success')}}",
                            text: data.message,
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "{{trans('global.confirmation')}}",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });

                        document.getElementById("formChangePassword").reset();
                    } else {
                        Swal.fire("{{trans('global.sorry_some_error')}}", "{{trans('global.sorry_some_error')}}", "error");
                    }
                }, error: function (reject) {
                    $('#btn_change_password').html("save");

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
