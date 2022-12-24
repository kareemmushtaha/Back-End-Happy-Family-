@extends('layouts.main')
@section('title',trans('global.view') .' '. trans('cruds.fqa.title_singular'))
@section('content')

    <div>
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Card-->
                <div class="card card-custom example example-compact">
                    <div class="card-header">
                        <h3 class="card-title">{{ trans('global.view') }} {{ trans('cruds.success_stories.title_singular')  }} - {{$fqa->question}} </h3>
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
                                                {{ trans('cruds.fqa.fields.question') }}
                                            </th>
                                            <td>
                                                {{$fqa->question }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.fqa.fields.answer') }}
                                            </th>
                                            <td>
                                                {{$fqa->answer }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ trans('cruds.fqa.fields.status') }}
                                            </th>
                                            <td>
                                            {{ \App\Models\Fqa::STATUS[$fqa->status] }}
                                            </td>
                                        </tr>



                                        </tbody>
                                    </table>
                                    <div class="form-group">
                                        <a class="btn btn-default badge badge-light-primary" onclick="history.back();">
                                            {{ trans('global.return_back') }}
                                        </a>

                                        <a class="btn btn-default badge badge-light-primary" href="{{route('admin.fqas.edit', $fqa->id)}}">
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
