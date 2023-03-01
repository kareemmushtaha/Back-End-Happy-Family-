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







                                @if($answer->status == 0)
                                    {{--  "0" ==>  pending accept or reject--}}
                                    <button data-id="{{$answer->id}}"
                                            onclick="Change_Status_Answer(this)" id="active{{$answer->id}}"
                                            data-url="{{ route('admin.answer-chat.acceptRequestAnswerChat', $answer->id) }}"
                                            class="btn btn-icon btn-bg-warning text-white btn-active-color-primary btn-lg StatusRow{{$answer->id}}">
                                        {{trans('global.accept')}}
                                    </button>
                                    <button data-id="{{$answer->id}}"
                                            onclick="Change_Status_Answer(this)" id="active{{$answer->id}}"
                                            data-url="{{ route('admin.answer-chat.rejectRequestAnswerChat', $answer->id) }}"
                                            class="btn btn-icon btn-bg-warning text-white btn-active-color-primary btn-lg StatusRow{{$answer->id}}">
                                        {{trans('global.reject')}}
                                    </button>
                                @endif

                                @if(in_array($answer->status,[1,2]) )
                                    <button
                                        class="btn  btn-bg-info text-white btn-active-color-primary " style="padding: 10px 10px !important;">
                                        @if($answer->status ==1)
                                            {{trans('global.accepted')}}
                                        @elseif($answer->status ==2)
                                            {{trans('global.rejected')}}
                                        @endif
                                    </button>
                                @endif










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

        function Change_Status_Answer(event) {

            var token = '{{csrf_token()}}';
            var url = $(event).data('url');
            var id = $(event).data('id');

            Swal.fire({
                title: "{{trans('global.areYouSure')}}",
                text: "❗❗",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "{{trans('global.yes')}}",
                cancelButtonText: "{{trans('global.no')}} {{trans('global.cancel')}}",
                reverseButtons: true
            }).then(function (result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            '_token': token,
                            '_method': 'get',
                            'id': id

                        },
                        success: function (response) {
                            if (response.status) {
                                Swal.fire(
                                    response.msg,
                                    "--",
                                    "success"
                                )
                                location.reload();

                            } else {
                                Swal.fire(response.msg, "...", "error");
                            }
                        }
                    });
                } else {
                    Swal.fire(
                        response.msg,
                        "{{trans('global.undone')}}",
                        "error"
                    )
                }
            });
        }
    </script>


@endsection


