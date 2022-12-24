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
                style="background-image: url(assets/media/svg/illustrations/login_register.png)"></div>
            <!--end::Illustration-->
        </div>
        <!--begin::Aside-->
        <!--begin::Body-->
        <div class="d-flex flex-column flex-lg-row-fluid py-10">
            <!--begin::Content-->
            <div class="d-flex flex-center flex-column flex-column-fluid">
                <!--begin::Wrapper-->
                <div class="w-lg-500px p-10 p-lg-15 mx-auto">

                    @if(session()->has('message'))
                        <p class="alert alert-info">
                            {{ session()->get('message') }}
                        </p>
                @endif

                <!--begin::Form-->
                    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="POST"
                          action="{{ route('register') }}">
                    {{ csrf_field() }}
                    <!--begin::Heading-->
                        <div class="text-center mb-10">
                            <!--begin::Title-->
                            <h1 class="text-dark mb-3">{{ trans('global.register') }}</h1>
                            <!--end::Title-->
                        </div>
                        <!--begin::Heading-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10 text-right">
                            <!--begin::Label-->


                            <label class="form-label fs-6 fw-bolder text-right">{{ trans('global.user_name') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->

                            <input type="text" name="name"
                                   class="form-control text-right form-control-lg form-control-solid  {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                   required autofocus placeholder="{{ trans('global.user_name') }}"
                                   value="{{ old('name', null) }}">
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>

                            @endif

                            <br>

                            <input type="email" name="email"
                                   class="form-control text-right form-control-lg form-control-solid{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                   required placeholder="{{ trans('global.login_email') }}"
                                   value="{{ old('email', null) }}">
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <br>

                            <input type="password" name="password"
                                   class="form-control text-right form-control-lg form-control-solid {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                   required
                                   placeholder="{{ trans('global.login_password') }}">

                            @if($errors->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                            <br>

                            <input type="password" name="password_confirmation"
                                   class="form-control text-right form-control-lg form-control-solid " required
                                   placeholder="{{ trans('global.login_password_confirmation') }}">


                            <!--end::Input-->
                        </div>

                        <div class="text-center">
                            <!--begin::Submit button-->
                            <button type="submit" class="btn btn-lg btn-warning fw-bolder me-3 my-2">
                                <span class="indicator-label">   {{ trans('global.register') }}</span>
                                <span class="indicator-progress">Please wait...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <!--end::Submit button-->
                        </div>

                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Wrapper-->
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




