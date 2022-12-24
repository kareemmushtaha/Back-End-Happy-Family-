@extends('layouts.main')
@section('content')


    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container">
            <!--begin::Tables Widget 11-->
            <div class="card mb-5 mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span
                            class="card-label fw-bolder fs-3 mb-1">{{ trans('global.view') }} {{ trans('cruds.package.title') }} </span>
                    </h3>

                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body py-3">


                    <!--begin::Table container-->
                    <div   class="datatable datatable-default datatable-bordered datatable-loaded ">

                        <table class="table align-middle gs-0 gy-4 " id="kt_datatable_example_1">
                            <!--begin::Table head-->
                            <thead>
                            <tr class="fw-bolder text-muted bg-light">

                                <th class="ps-4 min-w-255px rounded-start" style="margin: 40px">
                                </th>
                                <th class="min-w-4px">
                                    {{ trans('cruds.package.fields.id') }}
                                </th>
                                <th class="min-w-4px">
                                    {{ trans('cruds.package.fields.title') }}
                                </th>
                                <th class="min-w-4px">
                                    {{ trans('cruds.package.fields.price') }}
                                </th>
                                <th class="min-w-4px">
                                    {{ trans('cruds.package.fields.status') }}
                                </th>
                                <th class="min-w-4px">
                                </th>
                                <th class="min-w-4px">
                                </th>
                            </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                            @foreach ($packages  as $key => $package)
                                <tr >

                                    <td>
                                        <a class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6"
                                           style="right: 50px"></a>
                                    </td>
                                    <td>
                                        <a class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6"
                                           style="right: 50px">{{ $key+1 }}</a>
                                    </td>

                                    <td>
                                        <a class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6"> {{ $package->title ?? '' }}</a>
                                    </td>

                                    <td>
                                        <a class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6">{{ $package->price ?? '' }}</a>
                                    </td>
                                    <td>
                                        <a class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6">{{ \App\Models\Package::STATUS[$package->status] ?? '' }}</a>
                                    </td>

                                    <td>

{{--                                        @can('package_show')--}}
                                            <a class="btn btn-sm btn-primary"
                                               href="{{ route('admin.packages.show', $package->id) }}">
                                                <i class="bi-eye"></i>
                                            </a>
{{--                                        @endcan--}}

{{--                                        @can('package_edit')--}}
                                            <a class="btn btn-sm btn-primary"
                                               href="{{ route('admin.packages.edit', $package->id) }}">
                                                <i class="bi-pencil"></i>
                                            </a>
{{--                                        @endcan--}}


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


