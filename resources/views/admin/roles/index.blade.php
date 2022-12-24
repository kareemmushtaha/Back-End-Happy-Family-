@extends('layouts.main')
@section('title',trans('global.create') .''. trans('cruds.role.title_singular'))
@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container">
            <!--begin::Tables Widget 11-->
            <div class="card mb-5 mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span
                            class="card-label fw-bolder fs-3 mb-1">{{ trans('cruds.role.title_singular') }} {{ trans('global.list') }}</span>
                    </h3>
                    <div class="card-toolbar">
                        @can('role_create')
                            <a href="{{ route('admin.roles.create') }}" class="btn btn-sm btn-light-primary">
                                <span class="svg-icon svg-icon-2 bi-bag-plus"></span>
                                {{ trans('global.add') }} {{ trans('cruds.role.title_singular') }}</a>
                        @endcan

                    </div>
                </div>
                <!--end::Header-->
                <div class="card-body py-3">
                    <!--begin::Table container-->
                    <div class="datatable datatable-default datatable-bordered datatable-loaded">
                        <table class="table align-middle gs-0 gy-4" id="kt_datatable_example_1">
                            <!--begin::Table head-->
                            <thead class="datatable-head">
                            <tr class="fw-bolder text-muted bg-light">

                                <th class="ps-4 min-w-255px rounded-start" style="margin: 40px">
                                </th>
                                <th class="min-w-4px">
                                    {{ trans('cruds.role.fields.id') }}
                                </th>
                                <th class="min-w-4px">

                                    {{ trans('cruds.role.fields.title') }}
                                </th>
                                <th class="min-w-4px">
                                    {{ trans('cruds.role.fields.permissions') }}
                                    &nbsp;
                                </th>
                                <td>
                                    {{ trans('global.operation') }}
                                </td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $key => $role)
                                <tr data-entry-id="{{ $role->id }}">
                                    <td>

                                    </td>

                                    <td>
                                        <a class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6">   {{ $role->id ?? '' }}</a>
                                    </td>

                                    <td>
                                        <a class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6">   {{ $role->title ?? '' }}</a>
                                    </td>

                                    <td style="max-width: 550px">
                                        @foreach($role->permissions as $key => $item)
                                            <span class="badge badge-info">{{ $item->title }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        @can('role_show')
                                            <a class="btn btn-sm btn-primary"
                                               href="{{ route('admin.roles.show', $role->id) }}">
                                                <i class="bi-eye"></i>
                                            </a>
                                        @endcan

                                        @can('role_edit')
                                            <a class="btn btn-sm btn-primary"
                                               href="{{ route('admin.roles.edit', $role->id) }}">
                                                <i class="bi-pencil"></i>
                                            </a>
                                        @endcan

                                        @can('role_delete')
                                            <button category_id_attr="{{$role->id}}"
                                                    class="btn btn-sm  btn-danger"
                                                    onclick="Confirm_Delete(this)"
                                                    data-url="{{ route('admin.roles.destroy', $role->id) }}">
                                                <i class="icon-trash"><i class="bi-trash"></i></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection







