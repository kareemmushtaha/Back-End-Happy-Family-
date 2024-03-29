@extends('layouts.main')
@section('title',trans('global.edit') .' '. trans('cruds.chat.question'))

@section('content')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card card-custom example example-compact">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('global.edit') }} {{ trans('cruds.chat.question') }}</h3>
                    <div class="card-toolbar">
                        <div class="example-tools justify-content-center">
                            <span class="example-toggle" data-toggle="tooltip" title=""
                                  data-original-title="View code"></span>
                        </div>
                    </div>
                </div>

                <!--begin::Form-->
                <form class="form fv-plugins-bootstrap fv-plugins-framework" id="formUpdateQuestionChat" novalidate="novalidate"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">

                        <div class="mb-10">
                            <label for="exampleFormControlInput1"
                                   class="required form-label">{{ trans('cruds.user.fields.name') }}</label>
                            <input type="text" class="form-control"
                                   placeholder="{{ trans('cruds.chat.fields.question_title') }}"
                                   name="question_title_ar" id="question_title_ar" value="{{ $questionChat->question_title}}" required/>
                            <span class="text-danger errors"
                                  id="question_title_ar_error"> </span>
                        </div>


                        <div>
                            <label for="exampleFormControlInput1"
                                   class="required form-label">{{ trans('cruds.chat.fields.status') }}</label>
                            <select class="form-control" name="status" id="status" multiple required>

                                <option value="1"
                                        @if($questionChat->status ==1) selected @endif>{{trans('global.active')}}</option>
                                <option value="0"
                                        @if($questionChat->status ==0) selected @endif>{{trans('global.un_active')}}</option>

                            </select>
                            <span class="text-danger errors"
                                  id="status_error"> </span>
                        </div>


                        <div class="separator separator-dashed my-10"></div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-9 ml-lg-auto">
                                    <a class="btn btn-light-primary" onclick="history.back();">
                                        {{ trans('global.back') }}
                                    </a>
                                    <button class="btn btn-primary mr-2" type="button"
                                            id="btn_update_question_chat"> {{ trans('global.edit') }}</button>

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
        $(document).on('click', '#btn_update_question_chat', function (e) {
            e.preventDefault();
            $('.errors').text('');

            var formData = new FormData($('#formUpdateQuestionChat')[0]); //get all data in form
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{ route("admin.questions-chat.update", $questionChat->id) }}",
                data: formData, // send this data to controller
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    $('#btn_update_question_chat').html();

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
                    $('#btn_update_question_chat').html('save');

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
