@extends('layouts.main')
@section('title', trans('global.view'). ' '.  trans('cruds.success_stories.title'))
@section('content')

    <div class="card mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span
                    class="card-label fw-bold fs-3 mb-1">{{ trans('global.view') }} {{ trans('cruds.success_stories.title') }}</span>
            </h3>
            <div class="card-toolbar">
{{--                @can('user_create')--}}
                    <a href="{{route('admin.success-stories.create')}}" class="btn btn-sm btn-light-primary">
                        <span class="svg-icon svg-icon-2 bi-bag-plus"></span>
                        {{ trans('global.add') }} {{ trans('cruds.success_stories.title_singular') }}</a>
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
                        <th class="">{{ trans('cruds.success_stories.fields.id') }}</th>
                        <th class="">{{ trans('cruds.success_stories.fields.photo') }}</th>
                        <th class="">{{ trans('cruds.success_stories.fields.name') }}</th>
                        <th class="">{{ trans('cruds.success_stories.fields.title') }}</th>
                        <th class="">{{ trans('cruds.success_stories.fields.status') }}</th>
                        <th class="">{{ trans('global.actions') }}</th>
                    </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                    @isset($success_stories)
                        @foreach ($success_stories  as $key => $story)
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
                                       class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">
                                        <img src="{{$story->photo}}" width="100" height="100" style="border-radius: 50%" alt="successStory">
                                    </a>
                                    <span
                                        class="text-muted fw-semibold text-muted d-block fs-7"></span>
                                </td>

                                <td>
                                    <a href="#"
                                       class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ $story->name ?? '' }}</a>
                                    <span
                                        class="text-muted fw-semibold text-muted d-block fs-7"></span>
                                </td>
                                <td>
                                    <a href="#"
                                       class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ $story->title ?? '' }}</a>
                                    <span
                                        class="text-muted fw-semibold text-muted d-block fs-7"></span>
                                </td>

                                <td>
                                    <a href="#"
                                       class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ \App\Models\SuccessStory::STATUS[$story->status] ?? '' }}</a>
                                    <span
                                        class="text-muted fw-semibold text-muted d-block fs-7"></span>
                                </td>

                                <td class="">
{{--                                    @can('user_show')--}}
                                        <a href="{{ route('admin.success-stories.show', $story->id) }}"
                                           class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                                            @include('partials.icons.show')
                                        </a>
{{--                                    @endcan--}}

{{--                                    @can('user_edit')--}}
                                        <a href="{{ route('admin.success-stories.edit', $story->id) }}"
                                           class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                            @include('partials.icons.edit')
                                        </a>
{{--                                    @endcan--}}

{{--                                    @can('user_delete')--}}
                                        <button category_id_attr="{{$story->id}}"
                                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm"
                                                onclick="Confirm_Delete(this)"
                                                data-url="{{ route('admin.success-stories.destroy', $story->id) }}">
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


