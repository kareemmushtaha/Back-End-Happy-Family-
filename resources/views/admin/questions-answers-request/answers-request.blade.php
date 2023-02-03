@extends('layouts.main')
@section('title',trans('global.view') .' '. trans('cruds.chat.answers'))

@section('content')
    @include('admin.answer-chat.create')

    <div class="card mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span
                    class="card-label fw-bold fs-3 mb-1">{{ trans('global.view') }} {{ trans('cruds.chat.customAnswerChat') }}</span>
            </h3>

        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body py-3">
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                    <!--begin::Table head-->
                    <thead>
                    <tr class="fw-bold text-muted">
                        <th class="w-25px">
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                            </div>
                        </th>
                        <th class="min-w-150px"> {{ trans('cruds.chat.fields.id') }}</th>
                        <th class="min-w-150px"> {{ trans('cruds.user.title') }}</th>
                        <th class="min-w-150px"> {{ trans('cruds.chat.answer') }}</th>
                        <th class="min-w-140px">    {{ trans('cruds.chat.fields.created_at') }}</th>
                        <th class="min-w-120px"> {{ trans('cruds.chat.fields.status') }}</th>
                        <th class="min-w-100px text-end"> {{ trans('global.actions') }}</th>
                    </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                    @foreach ($answers  as $key => $answer)
                        <tr>
                            <td>
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                </div>
                            </td>
                            <td>
                                <a href="#" class="text-dark fw-bold text-hover-primary fs-6">#{{ $key+1 }}</a>
                            </td>

                            <td>
                                <a href="#" class="text-dark fw-bold text-hover-primary fs-6">{{ $answer->customUserId->email }}</a>
                            </td>
                            <td>
                                <a href="#"
                                   class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ $answer->answer_title ?? '' }}</a>
                                <span
                                    class="text-muted fw-semibold text-muted d-block fs-7"></span>
                            </td>

                            <td>
                                <a href="#"
                                   class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ $answer->created_at ?? '' }}</a>
                                <span
                                    class="text-muted fw-semibold text-muted d-block fs-7"></span>
                            </td>
                            <td>
                                <a href="#"
                                   class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ $answer->getActive() ?? '' }}</a>
                                <span
                                    class="text-muted fw-semibold text-muted d-block fs-7"></span>
                            </td>

                            <td class="text-end">
                                <button data-id="{{$answer->id}}" id="active{{$answer->id}}"
                                        onclick="Change_Status(this)"
                                        data-url="{{ route('admin.answers-chat.changeStatusRequestAnswerChat', $answer->id) }}"
                                        class="btn btn-icon btn-bg-warning text-white btn-active-color-primary btn-lg StatusRow{{$answer->id}}">
                                    @if($answer->status==0)
                                        {{trans('global.accept')}}
                                    @else
                                        {{trans('global.reject')}}
                                    @endif
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>
            <!--end::Table container-->
        </div>
        <!--begin::Body-->
    </div>
    <!--end::Tables Widget 13-->

@endsection



@section('script')

    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $(document).on('click', '#btn_save_answer', function (e) {
            $('#btn_save_answer').html('{{trans('global.create')}} <i class="fa fa-spinner fa-spin"></i>');
            e.preventDefault();
            $('.errors').text('');
            var formData = new FormData($('#formSaveAnswer')[0]); //get all data in form
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{ route("admin.answers-chat.store") }}",
                data: formData, // send this data to controller
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    $('#btn_save_answer').html('{{trans('global.create')}} ');
                    if (data.status == true) {

                        document.getElementById("formSaveAnswer").reset();
                        setTimeout(function () {
                            var url = "{{ route('admin.answers-chat.index') }}"; //the url I want to redirect to
                            $(location).attr('href', url);
                        }, 0);

                    } else {
                        Swal.fire("{{trans('global.sorry_some_error')}}", "{{trans('global.sorry_some_error')}}", "error");
                    }
                }, error: function (reject) {
                    $('#btn_save_answer').html('{{trans('global.create')}}');

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


