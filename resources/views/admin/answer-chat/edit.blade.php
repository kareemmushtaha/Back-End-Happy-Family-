@extends('layouts.main')
@section('title',trans('global.edit') .' '. trans('cruds.chat.answer'))

@section('content')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card card-custom example example-compact">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('global.edit') }} {{ trans('cruds.chat.answer') }}</h3>
                    <div class="card-toolbar">
                        <div class="example-tools justify-content-center">
                            <span class="example-toggle" data-toggle="tooltip" title=""
                                  data-original-title="View code"></span>
                        </div>
                    </div>
                </div>

                <!--begin::Form-->
                <form class="form fv-plugins-bootstrap fv-plugins-framework" id="formUpdateAnswerChat" novalidate="novalidate"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">

                        <div class="mb-10">
                            <label for="exampleFormControlInput1"
                                   class="required form-label">{{ trans('cruds.chat.fields.title') }}</label>
                            <input type="text" class="form-control"
                                   placeholder="{{ trans('cruds.chat.fields.answer_title') }}"
                                   name="answer_title_ar" id="answer_title_ar" value="{{ $answerChat->answer_title}}" required/>
                            <span class="text-danger errors"
                                  id="answer_title_ar_error"> </span>
                        </div>


                        <div>
                            <label for="exampleFormControlInput1"
                                   class="required form-label">{{ trans('cruds.chat.fields.status') }}</label>
                            <select class="form-control" name="status" id="status" multiple required>

                                <option value="1"
                                        @if($answerChat->status ==1) selected @endif>{{trans('global.active')}}</option>
                                <option value="0"
                                        @if($answerChat->status ==0) selected @endif>{{trans('global.un_active')}}</option>
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
                                            id="btn_update_answer_chat"> {{ trans('global.edit') }}</button>

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
        $(document).on('click', '#btn_update_answer_chat', function (e) {
            e.preventDefault();
            $('.errors').text('');

            var formData = new FormData($('#formUpdateAnswerChat')[0]); //get all data in form
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{ route("admin.answers-chat.update", $answerChat->id) }}",
                data: formData, // send this data to controller
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    $('#btn_update_answer_chat').html();

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
                    $('#btn_update_answer_chat').html('save');

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
