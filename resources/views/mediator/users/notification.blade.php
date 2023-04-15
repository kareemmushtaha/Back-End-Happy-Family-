@extends('layoutsMediator.main')
@section('content')

    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container">
            <div class="card mb-5 mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                <span
                    class="card-label fw-bold fs-3 mb-1">{{ trans('global.view') }} {{ trans('cruds.user.notification') }}</span>
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
                                <th class="min-w-140px">    {{ trans('cruds.user.notification') }}</th>
                                <th class="min-w-140px">    {{ trans('cruds.user.fields.created_at') }}</th>
                            </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                            @foreach ($questionsNotAnswer as $key => $notification)
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        </div>
                                    </td>
                                    <td>
                                        @php
                                            $persona = \App\Models\Chat::query()->find($notification['chat_id'])->sender_id == $user->id ? \App\Models\Chat::query()->find($notification['chat_id'])->received_id : \App\Models\Chat::query()->find($notification['chat_id'])->sender_id;
                                        @endphp
                                        <a href="{{route('mediator.chat.createAndOpenChat',[$user->id,$persona])}}"
                                           class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">لديك رسالة
                                            جديدة</a>
                                        <span
                                            class="text-muted fw-semibold text-muted d-block fs-7">انتقل للدردشة</span>
                                    </td>
                                    <td>
                                        <a
                                            class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{\Illuminate\Support\Carbon::parse($notification->created_at)->diffForHumans()}}</a>

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
        </div>
    </div>
    <!--end::Tables Widget 13-->

@endsection



@section('script')
@endsection


