@extends('layouts.main')
@section('content')
    <div>
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Card-->
                <div class="card card-custom example example-compact">
                    <div class="card-header">
                        <h3 class="card-title">{{ trans('global.view') }} {{ trans('cruds.role.title') .' ' . $role->title }} </h3>
                        <div class="card-toolbar">
                            <div class="example-tools justify-content-center">
                            <span class="example-toggle" data-toggle="tooltip" title=""
                                  data-original-title="View code"></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body py-3">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="kt_table_widget_5_tab_1">
                                <!--begin::Table container-->
                                <div class="table-responsive">
                                    <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4">
                                        <tbody>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.role.fields.id') }}
                                            </th>
                                            <td>
                                                {{ $role->id }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.role.fields.title') }}
                                            </th>
                                            <td>
                                                {{ $role->title }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.role.fields.permissions') }}
                                            </th>
                                            <td>
                                                @foreach($role->permissions as $key => $permissions)
                                                    <span class="badge badge-info">{{ $permissions->title }}</span>
                                                @endforeach
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                    <div class="form-group">
                                        <a class="btn btn-default badge badge-light-primary" onclick="history.back();">
                                            {{ trans('global.return_back') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
