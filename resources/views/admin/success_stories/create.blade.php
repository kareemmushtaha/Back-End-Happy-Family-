@extends('layouts.main')
@section('title',trans('global.add') .' '. trans('cruds.success_stories.title_singular'))
@section('content')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card card-custom example example-compact">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('global.add') }} {{ trans('cruds.success_stories.title_singular') }}</h3>
                    <div class="card-toolbar">
                        <div class="example-tools justify-content-center">
                            <span class="example-toggle" data-toggle="tooltip" title=""
                                  data-original-title="View code"></span>
                        </div>
                    </div>
                </div>
                <!--begin::Form-->
                <form class="form fv-plugins-bootstrap fv-plugins-framework" id="formSuccessStory"
                      novalidate="novalidate"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        <div class="mb-10">
                            <div>
                                <label class=" mb-2">{{__('cruds.success_stories.fields.photo')}}</label>
                            </div>
                            <div class="image-input image-input-outline user_edit_image" data-kt-image-input="true"
                                 style="background-image: url({{asset('metronic/dist/assets/media/avatars/blank.png')}})">
                                <!--begin::Preview existing avatar-->
                                <div class="image-input-wrapper user_edit_image w-125px h-125px"
                                     style="background-image: url({{asset('metronic/dist/assets/media/avatars/blank.png')}});"></div>
                                <!--end::Preview existing avatar-->
                                <!--begin::Label-->
                                <label
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow d-block"
                                    data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                    title="{{__('global.change_photo')}}">
                                    <i class="bi bi-pencil-fill fs-7"></i>
                                    <!--begin::Inputs-->
                                    <input type="file" name="photo"/>
                                    <input type="hidden" name="avatar_remove"/>
                                </label>
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                    <i class="bi bi-x fs-2"></i>
                                </span>
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                    <i class="bi bi-x fs-2"></i>
                                </span>
                            </div>
                            <!--end::Image input-->
                            <!--begin::Hint-->
                            <div class="form-text">
                                <span id="photo_error" class="text-danger errors"></span>
                            </div>
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1"
                                   class="required form-label">{{ trans('cruds.success_stories.fields.name') }}</label>
                            <input type="text" class="form-control"
                                   placeholder="{{ trans('cruds.success_stories.fields.name') }}"
                                   name="name" id="name" value="{{old('name')}}" />
                            <span class="text-danger errors"
                                  id="name_error"> </span>
                        </div>

                        <div class="mb-10">
                            <label for="exampleFormControlInput1"
                                   class="required form-label">{{ trans('cruds.success_stories.fields.title') }}</label>
                            <input type="text" class="form-control"
                                   placeholder="{{ trans('cruds.success_stories.fields.title') }}"
                                   name="title" id="title" value="{{old('title')}}" />
                            <span class="text-danger errors"
                                  id="title_error"> </span>
                        </div>


                        <div class="mb-10">
                            <label for="exampleFormControlInput1"
                                   class="required form-label">{{ trans('cruds.success_stories.fields.description') }}</label>
                            <textarea name="description" class="form-control" rows="6" id="description">{{old('description')}}</textarea>
                            <span class="text-danger errors"
                                  id="description_error"> </span>
                        </div>


                        <div>
                            <label for="exampleFormControlInput1"
                                   class="required form-label">{{ trans('cruds.package.fields.status') }}</label>
                            <select class="form-control" name="status" id="status" required>
                                @foreach($success_stories_status as $key => $status)
                                    <option
                                        value="{{ $key }}">{{ $status }}</option>
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
                                            id="btn_save_success_story"> {{ trans('global.save') }}</button>

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



        $(document).on('click', '#btn_save_success_story', function (e) {
             e.preventDefault();
            $('.errors').text('');

            var formData = new FormData($('#formSuccessStory')[0]); //get all data in form
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{ route("admin.success-stories.store") }}",
                data: formData, // send this data to controller
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                     $('#btn_save_success_story').html();

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
                            window.location = '{{route('admin.success-stories.index')}}'
                        }, 500);
                    } else {
                        Swal.fire("{{trans('global.sorry_some_error')}}", "{{trans('global.sorry_some_error')}}", "error");
                    }
                }, error: function (reject) {
                    $('#btn_save_success_story').html('save');

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
