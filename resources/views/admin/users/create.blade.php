<div class="modal fade" id="kt_modal_new_target" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content rounded">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0 justify-content-end">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
									<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                          transform="rotate(-45 6 17.3137)" fill="currentColor"/>
									<rect x="7.41422" y="6" width="16" height="2" rx="1"
                                          transform="rotate(45 7.41422 6)" fill="currentColor"/>
								</svg>
							</span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                <!--begin:Form-->
                <form id="formSaveUser" class="form" action="#" method="post"
                      enctype="multipart/form-data">
                @csrf
                <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <!--begin::Title-->
                        <h1 class="mb-3">{{ trans('global.create') }} {{ trans('cruds.user.title_singular') }}</h1>
                    </div>
                    <!--end::Heading-->
                    <!--begin::Input group-->
                    <div class="row g-9 mb-8">
                        <div class="col-md-6 fv-row">
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">{{ trans('cruds.user.fields.first_name') }}</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                       title="Specify a target name for future usage and reference"></i>
                                </label>
                                <!--end::Label-->
                                <input type="text" class="form-control form-control-solid"
                                       placeholder="{{ trans('cruds.user.fields.name') }}"
                                       name="first_name" id="first_name"/>
                                <span class="text-danger errors"
                                      id="first_name_error"> </span>
                            </div>
                        </div>
                        <div class="col-md-6 fv-row">
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">{{ trans('cruds.user.fields.last_name') }}</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                       title="Specify a target name for future usage and reference"></i>
                                </label>
                                <!--end::Label-->
                                <input type="text" class="form-control form-control-solid"
                                       placeholder="{{ trans('cruds.user.fields.name') }}"
                                       name="last_name" id="last_name"/>
                                <span class="text-danger errors"
                                      id="last_name_error"> </span>
                            </div>
                        </div>

                    </div>


                    <div class="row g-9 mb-8">
                        <div class="col-md-6 fv-row">
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">{{ trans('cruds.user.fields.email') }}</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                       title="Specify a target name for future usage and reference"></i>
                                </label>
                                <!--end::Label-->
                                <input type="email" class="form-control form-control-solid"
                                       placeholder="{{ trans('cruds.user.fields.email') }}"
                                       value="" name="email"
                                       id="email"/>
                                <span class="text-danger errors"
                                      id="email_error"> </span>
                            </div>
                        </div>
                        <div class="col-md-6 fv-row">
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">{{ trans('cruds.user.fields.password') }}</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                   title="Specify a target name for future usage and reference"></i>
                            </label>
                            <!--end::Label-->
                            <input type="password" class="form-control form-control-solid"
                                   placeholder="{{ trans('cruds.user.fields.password') }}" name="password" id="password"/>
                            <span class="text-danger errors"
                                  id="password_error"> </span>
                        </div>
                    </div>
                    </div>

                    <div class="row g-9 mb-8">
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">{{ trans('cruds.user.fields.roles') }}</label>
                            <select class="form-select form-select-solid" data-control="select2"
                                    data-hide-search="true" data-placeholder="Select role"
                                    name="roles[]" id="roles">
                                <option value="">إختر الصلاحية</option>
                                @foreach($roles as $id => $role)
                                    <option value="{{ $id }}">{{ $role }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger errors"
                                  id="roles_error"> </span>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary mr-2" type="button"
                                id="btn_save_user"> {{ trans('global.save') }}</button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end:Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>







