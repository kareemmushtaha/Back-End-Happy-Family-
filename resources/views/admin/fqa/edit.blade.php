@extends('layouts.main')
@section('title',trans('global.edit') .' '. trans('cruds.fqa.title_singular'))
@section('content')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card card-custom example example-compact">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('global.edit') }} {{ $fqa->question }}</h3>
                    <div class="card-toolbar">
                        <div class="example-tools justify-content-center">
                            <span class="example-toggle" data-toggle="tooltip" title=""
                                  data-original-title="View code"></span>
                        </div>
                    </div>
                </div>
                <!--begin::Form-->
                <form class="form fv-plugins-bootstrap fv-plugins-framework" id="formFqa"
                      novalidate="novalidate"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">

                        <div class="mb-10">
                            <label for="exampleFormControlInput1"
                                   class="required form-label">{{ trans('cruds.fqa.fields.question') }}</label>
                            <input type="text" class="form-control"
                                   placeholder="{{ trans('cruds.fqa.fields.question') }}"
                                   name="question" id="question" value="{{$fqa->question ?? old('question')}}" />
                            <span class="text-danger errors"
                                  id="question_error"> </span>
                        </div>

                        <div class="mb-10">
                            <label for="exampleFormControlInput1"
                                   class="required form-label">{{ trans('cruds.fqa.fields.answer') }}</label>
                            <textarea name="answer" class="form-control" rows="6" id="answer">{{$fqa->answer ?? old('answer')}}</textarea>
                            <span class="text-danger errors"
                                  id="answer_error"> </span>
                        </div>

                        <div>
                            <label for="exampleFormControlInput1"
                                   class="required form-label">{{ trans('cruds.package.fields.status') }}</label>
                            <select class="form-control" name="status" id="status" required>
                                @foreach($fqa_status as $key => $status)
                                    <option value="{{ $key }}" @if($key == $fqa->status) selected @endif>{{ $status }}</option>
                                @endforeach
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
                                    <button class="btn btn-primary mr-2" type="submit"
                                            id="btn_save_fqa"> {{ trans('global.save') }}</button>

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



        $(document).on('click', '#btn_save_fqa', function (e) {
            e.preventDefault();
            $('.errors').text('');

            var formData = new FormData($('#formFqa')[0]); //get all data in form
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{ route("admin.fqas.update", $fqa->id) }}",
                data: formData, // send this data to controller
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    $('#btn_save_fqa').html();

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
                            window.location = '{{route('admin.fqas.index')}}'
                        }, 500);

                    } else {
                        Swal.fire("{{trans('global.sorry_some_error')}}", "{{trans('global.sorry_some_error')}}", "error");
                    }
                }, error: function (reject) {
                    $('#btn_save_fqa').html('save');

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
