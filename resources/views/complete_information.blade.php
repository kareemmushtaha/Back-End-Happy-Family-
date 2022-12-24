<!DOCTYPE html>
@include('includes.head')
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body"
      class="bg-white header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed toolbar-tablet-and-mobile-fixed aside-enabled aside-fixed"
      style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px" dir="rtl">
<!--begin::Main-->
<div class="d-flex flex-column flex-root">
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <!--begin::Aside-->
        <div class="d-flex flex-column flex-lg-row-auto w-xl-600px" style="background-color: #c2bcbc21">
            <!--begin::Header-->
            <div class="d-flex flex-column text-center p-10 pt-lg-20">
                <!--begin::Logo-->
                <a class="py-9">
                    <img alt="Logo" src="assets/media/logos/logo.png" class="h-70px"/>
                </a>
                <!--end::Logo-->
                <!--begin::Title-->
                <h1 class="fw-bolder fs-2qx pb-5 pb-md-10" style="color: #ffb954;">مرحبا بك
                    في {{ trans('panel.site_title') }}</h1>
                <!--end::Title-->
                <!--begin::Description-->
                <p class="fw-bold fs-2" style="color: #ffb954;">WELCOME TO SHAMSI UNDP
                    <!--end::Description-->
            </div>
            <!--end::Header-->
            <!--begin::Illustration-->
            <div
                class="d-flex flex-row-fluid bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-size-lg-auto bgi-position-y-bottom min-h-100px min-h-lg-350px"
                style="background-image: url(assets/media/svg/illustrations/checkout.svg)"></div>
            <!--end::Illustration-->
        </div>
        <!--begin::Aside-->
        <!--begin::Body-->
        <div class="d-flex flex-column flex-lg-row-fluid py-10">
            <!--begin::Content-->
            <div class="d-flex flex-center flex-column flex-column-fluid">
                <!--begin::Wrapper-->
                <div class="w-lg-600px p-10 p-lg-15 mx-auto">

                    @if(session()->has('message'))
                        <p class="alert alert-info">
                            {{ session()->get('message') }}
                        </p>
                @endif

                <!--begin::Form-->
                    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form"
                          action="{{ route('complete_profile_info') }}"
                          method="POST">
                    @csrf
                    <!--begin::Heading-->
                        <div class="text-center mb-10">
                            <!--begin::Title-->
                            <h1 class="text-dark mb-3">{{trans('global.completeProfile')}}</h1>
                            <!--end::Title-->
                        </div>
                        <!--begin::Heading-->
                        <!--begin::Input group-->


                        <div class="row ">
                            <div class="fv-row mb-10   ">
                                <!--begin::Label-->
                                <label class="form-label fs-6 fw-bolder ">{{trans('global.municipal_code')}}</label>
                                <input id="municipal_code" type="text"
                                       class="form-control form-control-lg form-control-solid text-right  {{ $errors->has('municipal_code') ? ' is-invalid' : '' }}"
                                       required autocomplete="municipal_code" autofocus
                                       name="municipal_code"
                                       value="{{ old('municipal_code', null) }}"/>
                                @if($errors->has('municipal_code'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('municipal_code') }}</strong>
                                    </span>
                            @endif

                            <!--end::Input-->
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-lg btn-warning fw-bo   lder me-3 my-2">
                                <span
                                    class="indicator-label"> {{ trans('global.confirmation') }}{{ trans('global.data') }}</span>
                                <span class="indicator-progress">Please wait...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!--end::Content-->
            <!--begin::Footer-->
            <!--end::Footer-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Authentication - Sign-in-->
</div>
<!--end::Main-->
<!--begin::Javascript-->
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="assets/plugins/global/plugins.bundle.js"></script>
<script src="assets/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="assets/js/custom/authentication/sign-in/general.js"></script>
<!--end::Page Custom Javascript-->
<!--end::Javascript-->
</body>
<!--end::Body-->
</html>
