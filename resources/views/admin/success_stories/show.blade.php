@extends('layouts.main')
@section('title',trans('global.view') .' '. $story->name)
@section('content')

    <div>
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Card-->
                <div class="card card-custom example example-compact">
                    <div class="card-header">
                        <h3 class="card-title">{{ trans('global.view') }} {{ trans('cruds.success_stories.title_singular')  }} - {{$story->name}} </h3>
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
                                                {{ trans('cruds.success_stories.fields.name') }}
                                            </th>
                                            <td>
                                                {{ $story->name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.success_stories.fields.title') }}
                                            </th>
                                            <td>
                                            {{ $story->title }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.success_stories.fields.description') }}
                                            </th>
                                            <td>
                                            {{ $story->description }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.success_stories.fields.status') }}
                                            </th>
                                            <td>
                                            {{ \App\Models\SuccessStory::STATUS[$story->status] }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.success_stories.fields.photo') }}
                                            </th>
                                            <td>
                                                <img src="{{$story->photo}}" width="150" height="150" style="border-radius: 50%" alt="successStory">
                                            </td>


                                        </tr>


                                        </tbody>
                                    </table>
                                    <div class="form-group">
                                        <a class="btn btn-default badge badge-light-primary" onclick="history.back();">
                                            {{ trans('global.return_back') }}
                                        </a>

                                        <a class="btn btn-default badge badge-light-primary" href="{{route('admin.success-stories.edit', $story->id)}}">
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
