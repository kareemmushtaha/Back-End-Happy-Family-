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
                <form id="formSaveQuestion" class="form" action="#" method="post"
                      enctype="multipart/form-data">
                @csrf
                <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <!--begin::Title-->
                        <h1 class="mb-3">{{ trans('global.create') }} {{ trans('cruds.chat.question') }}</h1>
                    </div>
                    <!--end::Heading-->
                    <!--begin::Input group-->
                    <div class="row g-9 mb-8">
                        <div class="col-md-12 fv-row">
                            <div class="d-flex flex-column mb-8 fv-row">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">{{ trans('cruds.chat.fields.question_title') }}</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                       title="Specify a target name for future usage and reference"></i>
                                </label>
                                <!--end::Label-->
                                <input type="text" class="form-control form-control-solid"
                                       placeholder="{{ trans('cruds.chat.question') }}"
                                       name="question_title_ar" id="question_title_ar"/>
                                <span class="text-danger errors"
                                      id="question_title_ar_error"> </span>
                            </div>
                        </div>
                    </div>

                    <div class="row g-9 mb-8">
                        <div class="col-md-6 fv-row">
                            <label
                                class="required fs-6 fw-semibold mb-2">{{ trans('cruds.chat.fields.status') }}</label>
                            <select class="form-select form-select-solid" data-control="select2"
                                    data-hide-search="true" data-placeholder="Select status"
                                    name="status" id="status">
                                <option value="1" selected>{{trans('global.active')}}</option>
                                <option value="0">{{trans('global.un_active')}}</option>

                            </select>
                            <span class="text-danger errors"
                                  id="status_error"> </span>
                        </div>
                    </div>

                    <div class="text-center">
                        <button class="btn btn-primary mr-2" type="button"
                                id="btn_save_question"> {{ trans('global.save') }}</button>
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







