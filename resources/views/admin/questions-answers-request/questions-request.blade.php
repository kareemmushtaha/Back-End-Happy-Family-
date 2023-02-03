@extends('layouts.main')
@section('content')
    @include('admin.question-chat.create')

    <div class="card mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span
                    class="card-label fw-bold fs-3 mb-1">{{ trans('global.view') }} {{ trans('cruds.chat.customQuestionChat') }}</span>
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
                        <th class="min-w-150px"> {{ trans('cruds.chat.question') }}</th>
                        <th class="min-w-140px">    {{ trans('cruds.chat.fields.created_at') }}</th>
                        <th class="min-w-120px"> {{ trans('cruds.chat.fields.status') }}</th>
                        <th class="min-w-100px text-end"> {{ trans('global.actions') }}</th>
                    </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                    @foreach ($questions  as $key => $question)
                        <tr>
                            <td>
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                </div>
                            </td>
                            <td>
                                <a href="#" class="text-dark fw-bold text-hover-primary fs-6">#{{ $key+1 }}</a>
                            </td>
                            <td>
                                <a href="#" class="text-dark fw-bold text-hover-primary fs-6">{{ $question->customUserId->email }}</a>
                            </td>
                            <td>
                                <a href="#"
                                   class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ $question->question_title ?? '' }}</a>
                                <span
                                    class="text-muted fw-semibold text-muted d-block fs-7"></span>
                            </td>

                            <td>
                                <a href="#"
                                   class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ $question->created_at ?? '' }}</a>
                                <span
                                    class="text-muted fw-semibold text-muted d-block fs-7"></span>
                            </td>
                            <td>
                                <a href="#"
                                   class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ $question->getActive() ?? '' }}</a>
                                <span
                                    class="text-muted fw-semibold text-muted d-block fs-7"></span>
                            </td>

                            <td class="text-end">

                                <button data-id="{{$question->id}}"
                                        onclick="Change_Status(this)"  id="active{{$question->id}}"
                                        data-url="{{ route('admin.questions-chat.changeStatusRequestQuestionChat', $question->id) }}"
                                        class="btn btn-icon btn-bg-warning text-white btn-active-color-primary btn-lg StatusRow{{$question->id}}">
                                    @if($question->status==0)
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





