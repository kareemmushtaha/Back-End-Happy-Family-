@extends('layouts.main')
@section('content')

    <div>
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Card-->
                <div class="card card-custom example example-compact">
                    <div class="card-header">
                        <h3 class="card-title">{{ trans('global.view') }} {{ trans('cruds.package.title_singular') ." ".  $package->title }}  </h3>
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
                                                {{ trans('cruds.package.fields.id') }}
                                            </th>
                                            <td>
                                                {{ $package->id }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.package.fields.title') }}
                                            </th>
                                            <td>
                                                {{ $package->title }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.package.fields.price') }}
                                            </th>
                                            <td>
                                                {{ $package->price }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.package.fields.description') }}
                                            </th>
                                            <td>
                                                {!! $package->description !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.package.fields.subscription_features') }}
                                            </th>
                                            <td>
                                                {!! $package->subscription_features !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.package.fields.status') }}
                                            </th>
                                            <td>
                                                {{ \App\Models\Package::STATUS[$package->status] }}
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                    <div class="form-group">
                                        <a class="btn btn-default badge badge-light-primary" onclick="history.back();">
                                            {{ trans('global.return_back') }}
                                        </a>

                                        <a class="btn btn-default badge badge-light-primary" href="{{route('admin.packages.edit', $package->id)}}">
                                            {{ trans('global.edit') }}
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
