@extends('layouts.main')
@section('title',trans('global.edit') .''. trans('cruds.package.title_singular'))
@section('content')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card card-custom example example-compact">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('global.edit') }} {{ trans('cruds.package.title_singular') }}</h3>
                    <div class="card-toolbar">
                        <div class="example-tools justify-content-center">
                            <span class="example-toggle" data-toggle="tooltip" title=""
                                  data-original-title="View code"></span>
                        </div>
                    </div>
                </div>
                <!--begin::Form-->
                <form class="form fv-plugins-bootstrap fv-plugins-framework" action="{{route("admin.packages.update", $package->id)}}" id="formUpdatePackage" novalidate="novalidate"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">

                        <div class="mb-10">
                            <label for="exampleFormControlInput1"
                                   class="required form-label">{{ trans('cruds.package.fields.title') }}</label>
                            <input type="text" class="form-control" placeholder="{{ trans('cruds.package.fields.title') }}"
                                   name="title" id="title" value="{{$package->title}}" required/>
                            <span class="text-danger errors"
                                  id="title_error"> </span>
                        </div>

                        <div class="mb-10" id="price">
                            <label for="exampleFormControlInput1"
                                   class="required form-label">{{ trans('cruds.package.fields.price') }}</label>
                            <input type="number" class="form-control" style="direction: rtl"
                                   placeholder="{{ trans('cruds.package.fields.price') }}" name="price"
                                   id="price" value="{{ $package->price}}"/>
                            <span class="text-danger errors"
                                  id="price_error"> </span>
                        </div>

                        <div class="mb-10" id="description_div">
                            <label for="exampleFormControlInput1"
                                   class="required form-label">{{ trans('cruds.package.fields.description') }}</label>
                            <textarea name="description" id="description">{!! $package->description !!}</textarea>
                            <span class="text-danger errors"
                                  id="description_error"> </span>
                        </div>

                        <div class="mb-10" id="subscription_features_div">
                            <label for="exampleFormControlInput1"
                                   class="required form-label">{{ trans('cruds.package.fields.subscription_features') }}</label>
                            <textarea name="subscription_features" id="subscription_features">{!! $package->subscription_features !!}</textarea>
                            <span class="text-danger errors"
                                  id="subscription_features_error"> </span>
                        </div>

                        <div>
                            <label for="exampleFormControlInput1"
                                   class="required form-label">{{ trans('cruds.package.fields.status') }}</label>
                            <select class="form-control" name="status" id="status" required>
                                @foreach($package_status as $key => $status)
                                    <option
                                        value="{{ $key }}" @if($key == $package->status) selected @endif>{{ $status }}</option>
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
                                            id="btn_update_package"> {{ trans('global.edit') }}</button>

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
        ClassicEditor
            .create( document.querySelector( '#description' ), {
                language: {
                    // The UI will be English.
                    ui: 'en',

                    // But the content will be edited in Arabic.
                    content: 'ar'
                }
            } )
            .then( editor => {
                window.editor = editor;
            } )
            .catch( err => {
                console.error( err );
            } );

        ClassicEditor
            .create( document.querySelector( '#subscription_features' ), {
                language: {
                    // The UI will be English.
                    ui: 'en',

                    // But the content will be edited in Arabic.
                    content: 'ar'
                }
            } )
            .then( editor => {
                //  window.editor = editor;
            } )
            .catch( err => {
                console.error( err.stack );
            } );

    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });



        {{--$(document).on('click', '#btn_update_package', function (e) {--}}
        {{--     e.preventDefault();--}}
        {{--    $('.errors').text('');--}}

        {{--    var formData = new FormData($('#formUpdatePackage')[0]); //get all data in form--}}
        {{--    $.ajax({--}}
        {{--        type: 'post',--}}
        {{--        enctype: 'multipart/form-data',--}}
        {{--        url: "{{ route("admin.packages.update", $package->id) }}",--}}
        {{--        data: formData, // send this data to controller--}}
        {{--        processData: false,--}}
        {{--        contentType: false,--}}
        {{--        cache: false,--}}
        {{--        success: function (data) {--}}
        {{--             $('#btn_update_package').html();--}}

        {{--            if (data.status == true) {--}}
        {{--                Swal.fire({--}}
        {{--                    title:  data.msg,--}}
        {{--                    text:  data.msg,--}}
        {{--                    icon: "success",--}}
        {{--                    buttonsStyling: false,--}}
        {{--                    confirmButtonText: "{{trans('global.confirmation')}}",--}}
        {{--                    customClass: {--}}
        {{--                        confirmButton: "btn btn-primary"--}}
        {{--                    }--}}
        {{--                });--}}

        {{--            } else {--}}
        {{--                Swal.fire("{{trans('global.sorry_some_error')}}", "{{trans('global.sorry_some_error')}}", "error");--}}
        {{--            }--}}
        {{--        }, error: function (reject) {--}}
        {{--            $('#btn_update_package').html('save');--}}

        {{--            var response = $.parseJSON(reject.responseText);--}}
        {{--            $.each(response.errors, function (key, val) {--}}
        {{--                // for loop to all validation and show all validate--}}
        {{--                $("#" + key + "_error").text(val[0]);--}}
        {{--            });--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}


    </script>


@endsection
