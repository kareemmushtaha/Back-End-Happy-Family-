@extends('layouts.main')
@section('content')



    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Row-->
            <!--end::Row-->

        @if((Auth::user()->roles->contains('id', 1)) == 1)
            <!--begin::Row-->
                <div class="row gy-5 g-xl-8">

                    <!--begin::Col-->
                    <div class="col-xl-12">
                        <!--begin::Tables Widget 9-->
                        <div class=" card-xl-stretch mb-5 mb-xl-8">

                            <div class="card-body py-3">
                                <!--begin::Table container-->
                                <div class="row g-5 g-xl-8">
                                    <div class="col-xl-3">
                                        <!--begin::Statistics Widget 5-->
                                        <a href="#" class="card bg-body hoverable card-xl-stretch mb-xl-8">
                                            <!--begin::Body-->
                                            <div class="card-body">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                                                <span class="svg-icon svg-icon-primary svg-icon-3x ms-n1">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none">
														<rect x="8" y="9" width="3" height="10" rx="1.5" fill="black"/>
														<rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5"
                                                              fill="black"/>
														<rect x="18" y="11" width="3" height="8" rx="1.5" fill="black"/>
														<rect x="3" y="13" width="3" height="6" rx="1.5" fill="black"/>
													</svg>
												</span>
                                                <!--end::Svg Icon-->
                                                <div
                                                    class="text-gray-900 fw-bolder fs-2 mb-2 mt-5"></div>
                                                <div
                                                    class="fw-bold text-gray-800">{{trans('global.Number_of_applications')}}</div>
                                            </div>
                                            <!--end::Body-->
                                        </a>
                                        <!--end::Statistics Widget 5-->
                                    </div>
                                    <div class="col-xl-3">
                                        <!--begin::Statistics Widget 5-->
                                        <a href="#" class="card bg-warning hoverable card-xl-stretch mb-xl-8">
                                            <!--begin::Body-->
                                            <div class="card-body">
                                                <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->


                                                <span class="svg-icon svg-icon-danger svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Communication/Delete-user.svg--><svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24"/>
                                                        <path
                                                            d="M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z M21,8 L17,8 C16.4477153,8 16,7.55228475 16,7 C16,6.44771525 16.4477153,6 17,6 L21,6 C21.5522847,6 22,6.44771525 22,7 C22,7.55228475 21.5522847,8 21,8 Z"
                                                            fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                        <path
                                                            d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                                                            fill="#000000" fill-rule="nonzero"/>
                                                    </g>
                                                </svg><!--end::Svg Icon--></span>


                                                <!--end::Svg Icon-->
                                                <div
                                                    class="text-white fw-bolder fs-2 mb-2 mt-5">{{$user_not_verified_account->count()}}</div>
                                                <div
                                                    class="fw-bold text-white">{{trans('global.The_number_of_unverified_users')}}</div>
                                            </div>
                                            <!--end::Body-->
                                        </a>
                                        <!--end::Statistics Widget 5-->
                                    </div>
                                    <div class="col-xl-3">
                                        <!--begin::Statistics Widget 5-->
                                        <a href="#" class="card bg-dark hoverable card-xl-stretch mb-xl-8">
                                            <!--begin::Body-->
                                            <div class="card-body">
                                                <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
                                                <span class="svg-icon svg-icon-success svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Communication/Add-user.svg--><svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24"/>
                                                        <path
                                                            d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
                                                            fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                        <path
                                                            d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                                                            fill="#000000" fill-rule="nonzero"/>
                                                    </g>
                                                </svg><!--end::Svg Icon--></span>
                                                <!--end::Svg Icon-->
                                                <div
                                                    class="text-gray-100 fw-bolder fs-2 mb-2 mt-5">{{$user_verified_account->count()}}</div>
                                                <div
                                                    class="fw-bold text-gray-100">{{trans('global.The_number_of_users_whose_accounts_are_verified')}}</div>
                                            </div>
                                            <!--end::Body-->
                                        </a>
                                        <!--end::Statistics Widget 5-->
                                    </div>

                                    <div class="col-xl-3">
                                        <!--begin::Statistics Widget 5-->
                                        <a href="#" class="card bg-info hoverable card-xl-stretch mb-5 mb-xl-8">
                                            <!--begin::Body-->
                                            <div class="card-body">
                                                <!--begin::Svg Icon | path: icons/duotune/graphs/gra007.svg-->
                                                <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none">
														<path opacity="0.3"
                                                              d="M10.9607 12.9128H18.8607C19.4607 12.9128 19.9607 13.4128 19.8607 14.0128C19.2607 19.0128 14.4607 22.7128 9.26068 21.7128C5.66068 21.0128 2.86071 18.2128 2.16071 14.6128C1.16071 9.31284 4.96069 4.61281 9.86069 4.01281C10.4607 3.91281 10.9607 4.41281 10.9607 5.01281V12.9128Z"
                                                              fill="black"/>
														<path
                                                            d="M12.9607 10.9128V3.01281C12.9607 2.41281 13.4607 1.91281 14.0607 2.01281C16.0607 2.21281 17.8607 3.11284 19.2607 4.61284C20.6607 6.01284 21.5607 7.91285 21.8607 9.81285C21.9607 10.4129 21.4607 10.9128 20.8607 10.9128H12.9607Z"
                                                            fill="black"/>
													</svg>
												</span>
                                                <!--end::Svg Icon-->
                                                <div
                                                    class="text-white fw-bolder fs-2 mb-2 mt-5">{{$Municipalities->where('information_user', '!=', null)->count()}}</div>
                                                <div
                                                    class="fw-bold text-white">{{trans('global.The_number_of_municipalities_that_have_completed_their_accounts')}}</div>
                                            </div>
                                            <!--end::Body-->
                                        </a>
                                        <!--end::Statistics Widget 5-->
                                    </div>
                                </div>

                                <div class="row g-5 g-xl-8">
                                    <div class="col-xl-3">
                                        <!--begin::Statistics Widget 5-->
                                        <a href="#" class="card bg-success  hoverable card-xl-stretch mb-xl-8">
                                            <!--begin::Body-->
                                            <div class="card-body">
                                                <span class="svg-icon svg-icon-dark svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Code/Done-circle.svg--><svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"/>
                                                        <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                                        <path
                                                            d="M16.7689447,7.81768175 C17.1457787,7.41393107 17.7785676,7.39211077 18.1823183,7.76894473 C18.5860689,8.1457787 18.6078892,8.77856757 18.2310553,9.18231825 L11.2310553,16.6823183 C10.8654446,17.0740439 10.2560456,17.107974 9.84920863,16.7592566 L6.34920863,13.7592566 C5.92988278,13.3998345 5.88132125,12.7685345 6.2407434,12.3492086 C6.60016555,11.9298828 7.23146553,11.8813212 7.65079137,12.2407434 L10.4229928,14.616916 L16.7689447,7.81768175 Z"
                                                            fill="#000000" fill-rule="nonzero"/>
                                                    </g>
                                                </svg>
                                                </span>
                                                <div
                                                    class="text-gray-100 fw-bolder fs-2 mb-2 mt-5">22222</div>
                                                <div
                                                    class="fw-bold text-gray-100">{{trans('global.Number_of_confirmed_stages')}}</div>
                                            </div>
                                            <!--end::Body-->
                                        </a>
                                        <!--end::Statistics Widget 5-->
                                    </div>
                                    <div class="col-xl-3">
                                        <!--begin::Statistics Widget 5-->
                                        <a href=""
                                           class="card bg-body hoverable card-xl-stretch mb-xl-8">
                                            <!--begin::Body-->
                                            <div class="card-body">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                                                <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Code/Warning-2.svg--><svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"/>
                                                        <path
                                                            d="M11.1669899,4.49941818 L2.82535718,19.5143571 C2.557144,19.9971408 2.7310878,20.6059441 3.21387153,20.8741573 C3.36242953,20.9566895 3.52957021,21 3.69951446,21 L21.2169432,21 C21.7692279,21 22.2169432,20.5522847 22.2169432,20 C22.2169432,19.8159952 22.1661743,19.6355579 22.070225,19.47855 L12.894429,4.4636111 C12.6064401,3.99235656 11.9909517,3.84379039 11.5196972,4.13177928 C11.3723594,4.22181902 11.2508468,4.34847583 11.1669899,4.49941818 Z"
                                                            fill="#000000" opacity="0.3"/>
                                                        <rect fill="#000000" x="11" y="9" width="2" height="7" rx="1"/>
                                                        <rect fill="#000000" x="11" y="17" width="2" height="2" rx="1"/>
                                                    </g>
                                                </svg></span>

                                                <div
                                                    class="text-gray-900 fw-bolder fs-2 mb-2 mt-5">{{$Municipalities->where('information_user', null)->count()}}</div>
                                                <div
                                                    class="fw-bold text-gray-800">{{trans('global.Number_of_municipalities_incomplete_their_accounts')}}</div>
                                            </div>
                                            <!--end::Body-->
                                        </a>
                                        <!--end::Statistics Widget 5-->
                                    </div>

                                    <div class="col-xl-3">
                                        <!--begin::Statistics Widget 5-->
                                        <a href="#" class="card bg-danger  hoverable card-xl-stretch mb-xl-8">
                                            <!--begin::Body-->
                                            <div class="card-body">
                                                <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                                                <span class="svg-icon svg-icon-white svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Code/Error-circle.svg--><svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                     <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"/>
                                                        <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                                        <path
                                                            d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z"
                                                            fill="#000000"/>
                                                    </g>
                                                </svg><!--end::Svg Icon--></span>
                                                <!--end::Svg Icon-->
                                                <div
                                                    class="text-white fw-bolder fs-2 mb-2 mt-5">232434</div>
                                                <div
                                                    class="fw-bold text-white">{{trans('global.The_number_of_uncertain_stages')}}</div>
                                            </div>
                                            <!--end::Body-->
                                        </a>
                                        <!--end::Statistics Widget 5-->
                                    </div>
                                </div>

                                <!--end::Table container-->
                            </div>
                            <!--begin::Body-->
                        </div>
                        <!--end::Tables Widget 9-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
        @elseif(Auth::user()->roles->contains('id', 2) == 2)
            <!--begin::Row-->
                <div class="row gy-5 g-xl-8">

                    <!--begin::Col-->
                    <div class="col-xl-12">
                        <!--begin::Tables Widget 9-->
                        <div class=" card-xl-stretch mb-5 mb-xl-8">
                            <!--begin::Header-->
                            <div class="card-header border-0 pt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bolder fs-3 mb-1">{{trans('global.our_apps')}}</span>
                                    <span
                                        class="text-muted mt-1 fw-bold fs-7"> {{trans('global.More_than')}} {{\App\Models\Project::active()->count()}} {{trans('global.apps')}}</span>
                                </h3>

                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body py-3">
                                <!--begin::Table container-->
                                <div class="row g-6 g-xl-9">
                                @isset($projects)
                                    @foreach($projects as $project)
                                        <!--begin::Col-->
                                            <div class="col-md-6 col-xl-4">
                                                <!--begin::Card-->
                                                <a href="{{route('admin.project_steps.index', $project->id)}}"
                                                   class="card border border-2 border-gray-300 border-hover">
                                                    <!--begin::Card header-->
                                                    <div class="card-header border-0 pt-9">
                                                        <!--begin::Card Title-->
                                                        <div class="card-title m-0">
                                                            <!--begin::Avatar-->
                                                            <div class="symbol symbol-50px w-50px bg-light">
                                                                <img src="assets/media/svg/brand-logos/plurk.svg"
                                                                     alt="image" class="p-3"/>
                                                            </div>
                                                            <!--end::Avatar-->
                                                        </div>
                                                        <!--end::Car Title-->
                                                        <!--begin::Card toolbar-->
                                                    {{--                                                <div class="card-toolbar">--}}
                                                    {{--                                                    <span class="badge badge-light-primary fw-bolder me-auto px-4 py-3">In Progress</span>--}}
                                                    {{--                                                </div>--}}
                                                    <!--end::Card toolbar-->
                                                    </div>
                                                    <!--end:: Card header-->
                                                    <!--begin:: Card body-->
                                                    <div class="card-body p-9">
                                                        <!--begin::Name-->
                                                        <div class="fs-3 fw-bolder text-dark">{{$project->title}}</div>
                                                        <!--end::Name-->
                                                        <!--begin::Description-->
                                                        <p class="text-gray-400 fw-bold fs-5 mt-1 mb-7">{{\Illuminate\Support\Str::limit($project->description, 50)}}</p>
                                                        <!--end::Description-->
                                                        <!--begin::Info-->
                                                        <div class="d-flex flex-wrap mb-5">
                                                            <!--begin::Due-->
                                                            <div
                                                                class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
                                                                <div
                                                                    class="fs-6 text-gray-800 fw-bolder">{{date('d M Y', strtotime($project->created_at))}}</div>
                                                                <div
                                                                    class="fw-bold text-gray-400">{{trans('global.Date_created')}}</div>
                                                            </div>
                                                            <!--end::Due-->
                                                        </div>
                                                        <!--end::Info-->

                                                        <!--end::Users-->
                                                    </div>
                                                    <!--end:: Card body-->
                                                </a>
                                                <!--end::Card-->
                                            </div>
                                        @endforeach
                                    @endisset
                                </div>

                                <!--end::Table container-->
                            </div>
                            <!--begin::Body-->
                        </div>
                        <!--end::Tables Widget 9-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
        @endif

        <!--end::Modals-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
    </div>
    <!--end::Content-->
    <!--begin::Footer-->
    <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
        <!--begin::Container-->
        <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">

        </div>
        <!--end::Container-->
    </div>
    <!--end::Footer-->
    </div>
    <!--end::Wrapper-->
    </div>
    <!--end::Page-->
    </div>
    <!--end::Root-->
    <!--begin::Drawers-->

@endsection
@section('scripts')
    @parent

@endsection
