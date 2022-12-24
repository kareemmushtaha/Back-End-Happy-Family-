@extends('layouts.main')
@section('title',trans('global.create') .''. trans('cruds.setting.title_singular'))
@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container">
            <!--begin::Tables Widget 11-->
            <div class="card mb-5 mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span
                            class="card-label fw-bolder fs-3 mb-1">{{ trans('global.list') }} {{ trans('cruds.setting.title_singular') }} </span>
                    </h3>
                    <div class="card-toolbar">

                    </div>
                </div>
                <!--end::Header-->
                <div class="py-5">
                    <div class="d-flex flex-column flex-md-row rounded border p-10">
                        <ul class="nav nav-tabs nav-pills flex-row border-0 flex-md-column me-5 mb-3 mb-md-0 fs-6">
                            <li class="nav-item me-0 mb-md-2">
                                <a class="nav-link active btn btn-flex btn-active-light-success" data-bs-toggle="tab" href="#home">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen001.svg-->
                                    <span class="svg-icon svg-icon-2 svg-icon-primary me-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M11 2.375L2 9.575V20.575C2 21.175 2.4 21.575 3 21.575H9C9.6 21.575 10 21.175 10 20.575V14.575C10 13.975 10.4 13.575 11 13.575H13C13.6 13.575 14 13.975 14 14.575V20.575C14 21.175 14.4 21.575 15 21.575H21C21.6 21.575 22 21.175 22 20.575V9.575L13 2.375C12.4 1.875 11.6 1.875 11 2.375Z" fill="black"/>
                                            </svg>
                                        </span>
                                    <!--end::Svg Icon-->
                                    <span class="d-flex flex-column align-items-start">
                                            <span class="fs-4 fw-bolder" style="width: max-content">{{ trans('cruds.setting.home') }}</span>
{{--                                            <span class="fs-7"></span>--}}
                                        </span>
                                </a>
                            </li>
                            <li class="nav-item me-0 mb-md-2">
                                <a class="nav-link btn btn-flex btn-active-light-warning" data-bs-toggle="tab" href="#aboutUs">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen001.svg-->
                                    <span class="svg-icon svg-icon-2 svg-icon-primary me-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M11 2.375L2 9.575V20.575C2 21.175 2.4 21.575 3 21.575H9C9.6 21.575 10 21.175 10 20.575V14.575C10 13.975 10.4 13.575 11 13.575H13C13.6 13.575 14 13.975 14 14.575V20.575C14 21.175 14.4 21.575 15 21.575H21C21.6 21.575 22 21.175 22 20.575V9.575L13 2.375C12.4 1.875 11.6 1.875 11 2.375Z" fill="black"/>
                                            </svg>
                                        </span>
                                    <!--end::Svg Icon-->
                                    <span class="d-flex flex-column align-items-start">
                                            <span class="fs-4 fw-bolder" style="width: max-content">{{ trans('cruds.setting.about_us') }}</span>
{{--                                            <span class="fs-7"></span>--}}
                                        </span>
                                </a>
                            </li>
                            <li class="nav-item me-0 mb-md-2">
                                <a class="nav-link btn btn-flex btn-active-light-info" data-bs-toggle="tab" href="#privacyPolicy">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen003.svg-->
                                    <span class="svg-icon svg-icon-2 svg-icon-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M13.0079 2.6L15.7079 7.2L21.0079 8.4C21.9079 8.6 22.3079 9.7 21.7079 10.4L18.1079 14.4L18.6079 19.8C18.7079 20.7 17.7079 21.4 16.9079 21L12.0079 18.8L7.10785 21C6.20785 21.4 5.30786 20.7 5.40786 19.8L5.90786 14.4L2.30785 10.4C1.70785 9.7 2.00786 8.6 3.00786 8.4L8.30785 7.2L11.0079 2.6C11.3079 1.8 12.5079 1.8 13.0079 2.6Z" fill="black"/>
                                            </svg>
                                        </span>
                                    <!--end::Svg Icon-->
                                    <span class="d-flex flex-column align-items-start">
                                            <span class="fs-4 fw-bolder" style="width: max-content">{{ trans('cruds.setting.privacy_policy') }}</span>
{{--                                            <span class="fs-7">Description</span>--}}
                                        </span>
                                </a>
                            </li>
                            <li class="nav-item me-0 mb-md-2">
                                <a class="nav-link btn btn-flex btn-active-light-info" data-bs-toggle="tab" href="#contact_information">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen003.svg-->
                                    <span class="svg-icon svg-icon-2 svg-icon-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M13.0079 2.6L15.7079 7.2L21.0079 8.4C21.9079 8.6 22.3079 9.7 21.7079 10.4L18.1079 14.4L18.6079 19.8C18.7079 20.7 17.7079 21.4 16.9079 21L12.0079 18.8L7.10785 21C6.20785 21.4 5.30786 20.7 5.40786 19.8L5.90786 14.4L2.30785 10.4C1.70785 9.7 2.00786 8.6 3.00786 8.4L8.30785 7.2L11.0079 2.6C11.3079 1.8 12.5079 1.8 13.0079 2.6Z" fill="black"/>
                                            </svg>
                                        </span>
                                    <!--end::Svg Icon-->
                                    <span class="d-flex flex-column align-items-start">
                                            <span class="fs-4 fw-bolder" style="width: max-content">{{ trans('cruds.setting.information_contact') }}</span>
{{--                                            <span class="fs-7">Description</span>--}}
                                        </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-flex btn-active-light-danger" data-bs-toggle="tab" href="#footer">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen017.svg-->
                                    <span class="svg-icon svg-icon-2 svg-icon-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3" d="M5 8.04999L11.8 11.95V19.85L5 15.85V8.04999Z" fill="black"/><path d="M20.1 6.65L12.3 2.15C12 1.95 11.6 1.95 11.3 2.15L3.5 6.65C3.2 6.85 3 7.15 3 7.45V16.45C3 16.75 3.2 17.15 3.5 17.25L11.3 21.75C11.5 21.85 11.6 21.85 11.8 21.85C12 21.85 12.1 21.85 12.3 21.75L20.1 17.25C20.4 17.05 20.6 16.75 20.6 16.45V7.45C20.6 7.15 20.4 6.75 20.1 6.65ZM5 15.85V7.95L11.8 4.05L18.6 7.95L11.8 11.95V19.85L5 15.85Z" fill="black"/>
                                            </svg>
                                        </span>
                                    <!--end::Svg Icon-->
                                    <span class="d-flex flex-column align-items-start">
                                            <span class="fs-4 fw-bolder">{{ trans('cruds.setting.footer') }}</span>
{{--                                            <span class="fs-7">Description</span>--}}
                                        </span>
                                </a>
                            </li>
                        </ul>
                        <div class="card-body py-3">
                            <!--begin::Table container-->
                            <div class="tab-content" id="myTabContent">
                                @include('admin.settings.home')

                                @include('admin.settings.aboutUs')

                                @include('admin.settings.privacyPolicy')

                                @include('admin.settings.contactInformation')

                                @include('admin.settings.footer')

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')

    <script>
        ClassicEditor
            .create( document.querySelector( '#about_us_description' ), {
                language: {
                    // The UI will be English.
                    ui: 'en',

                    // But the content will be edited in Arabic.
                    content: 'ar'
                }
            } )
            .then( editor => {
                window.editor = editor;
            } )
            .catch( err => {
                console.error( err.stack );
            } );

        ClassicEditor
            .create( document.querySelector( '#home_section_get_to_know_us_description' ), {
                language: {
                    // The UI will be English.
                    ui: 'en',

                    // But the content will be edited in Arabic.
                    content: 'ar'
                }
            } )
            .then( editor => {
                window.editor = editor;
            } )
            .catch( err => {
                console.error( err.stack );
            } );

        ClassicEditor
            .create( document.querySelector( '#privacy_policy_description' ), {
                language: {
                    // The UI will be English.
                    ui: 'en',

                    // But the content will be edited in Arabic.
                    content: 'ar'
                }
            } )
            .then( editor => {
                window.editor = editor;
            } )
            .catch( err => {
                console.error( err.stack );
            } );

    </script>
@endsection





