@extends('layouts.main')
@section('title', trans('global.view'). ' '.  trans('cruds.fqa.title'))
@section('content')

    <div class="card mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span
                    class="card-label fw-bold fs-3 mb-1">{{ trans('global.view') }} {{ trans('cruds.fqa.title') }}</span>
            </h3>
            <div class="card-toolbar">
{{--                @can('user_create')--}}
                    <a href="{{route('admin.fqas.create')}}" class="btn btn-sm btn-light-primary">
                        <span class="svg-icon svg-icon-2 bi-bag-plus"></span>
                        {{ trans('global.add') }} {{ trans('cruds.fqa.title_singular') }}</a>
{{--                @endcan--}}
            </div>
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
                        <th class="">{{ trans('cruds.fqa.fields.id') }}</th>
                        <th class="">{{ trans('cruds.fqa.fields.question') }}</th>
                        <th class="">{{ trans('cruds.fqa.fields.answer') }}</th>
                        <th class="">{{ trans('cruds.fqa.fields.status') }}</th>
                        <th class="">{{ trans('global.actions') }}</th>
                    </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                    @isset($fqas)
                        @foreach ($fqas  as $key => $fqa)
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    </div>
                                </td>
                                <td>
                                    <a href="#" class="text-dark fw-bold text-hover-primary fs-6">#{{ $key+1 }}</a>
                                </td>

                                <td>
                                    <a href="#"
                                       class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ $fqa->question ?? '' }}</a>
                                    <span
                                        class="text-muted fw-semibold text-muted d-block fs-7"></span>
                                </td>
                                <td>
                                    <a href="#"
                                       class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ $fqa->answer ?? '' }}</a>
                                    <span
                                        class="text-muted fw-semibold text-muted d-block fs-7"></span>
                                </td>

                                <td>
                                    <a href="#"
                                       class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ \App\Models\Fqa::STATUS[$fqa->status] ?? '' }}</a>
                                    <span
                                        class="text-muted fw-semibold text-muted d-block fs-7"></span>
                                </td>

                                <td class="">
{{--                                    @can('user_show')--}}
                                        <a href="{{ route('admin.fqas.show', $fqa->id) }}"
                                           class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                                            @include('partials.icons.show')
                                        </a>
{{--                                    @endcan--}}

{{--                                    @can('user_edit')--}}
                                        <a href="{{ route('admin.fqas.edit', $fqa->id) }}"
                                           class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                            @include('partials.icons.edit')
                                        </a>
{{--                                    @endcan--}}

{{--                                    @can('user_delete')--}}
                                        <button category_id_attr="{{$fqa->id}}"
                                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm"
                                                onclick="Confirm_Delete(this)"
                                                data-url="{{ route('admin.fqas.destroy', $fqa->id) }}">
                                            @include('partials.icons.delete')
                                        </button>
{{--                                    @endcan--}}
                                </td>
                            </tr>
                        @endforeach
                    @endisset

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

@endsection


