<div class="tab-pane fade show active" id="home" role="tabpanel">
    <form id="contactInformationForm" method="post" action="{{route('admin.settings.saveSetting')}}" class="form">
        @csrf

            <!--begin::Input group-->
            <input type="hidden" name="local" value="ar">

{{--            home_header--}}
            <div class="row g-9 mb-8">
                <strong>{{ trans('cruds.setting.fields.home_header') }}</strong>
                <div class="col-md-12 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.title') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" name="home_header_title" class="form-control form-control-solid" placeholder="{{ trans('cruds.setting.fields.title') }}" id="home_header_title" value="{{settingContentAr('home_header_title')}}">
                        <span class="text-danger errors"
                              id="home_header_title_error"> </span>
                    </div>
                </div>

            </div>

            <div class="row g-9 mb-8">
                <div class="col-md-12 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.price_show_user_information') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                         <input type="text" name="price_show_user_information" class="form-control form-control-solid" placeholder="{{ trans('cruds.setting.fields.price_show_user_information') }}" id="home_header_title" value="{{settingContentAr('price_show_user_information')}}">

                        <span class="text-danger errors"
                              id="price_show_user_information_error"> </span>
                    </div>
                </div>
            </div>

            <div class="row g-9 mb-8">
                <div class="col-md-12 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.description') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <textarea name="home_header_description" rows="6" class="form-control form-control-solid" placeholder="{{ trans('cruds.setting.fields.description') }}" id="home_header_description">{{settingContentAr('home_header_description')}}</textarea>
                        <span class="text-danger errors"
                              id="home_header_description_error"> </span>
                    </div>
                </div>
            </div>

            <hr>

{{--            home_section_get_to_know_us--}}
            <div class="row g-9 mb-8">
                <strong>{{ trans('cruds.setting.fields.home_section_get_to_know_us') }}</strong>
                <div class="col-md-12 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.title') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" name="home_section_get_to_know_us_title" class="form-control form-control-solid" placeholder="{{ trans('cruds.setting.fields.title') }}" id="home_section_get_to_know_us_title" value="{{settingContentAr('home_section_get_to_know_us_title')}}">
                        <span class="text-danger errors"
                              id="home_section_get_to_know_us_title_error"> </span>
                    </div>
                </div>
            </div>

            <div class="row g-9 mb-8">
                <div class="col-md-12 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.description') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <textarea name="home_section_get_to_know_us_description" rows="6" class="form-control form-control-solid" placeholder="{{ trans('cruds.setting.fields.description') }}" id="home_section_get_to_know_us_description">{!! settingContentAr('home_section_get_to_know_us_description') !!}</textarea>
                        <span class="text-danger errors"
                              id="home_section_get_to_know_us_description_error"> </span>
                    </div>
                </div>
            </div>
            <hr>
{{--            section_Features--}}
            <div class="row g-9 mb-8">
                <strong>{{ trans('cruds.setting.fields.home_section_features') }}</strong>
                <div class="col-md-12 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.title') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" name="home_section_features_title_1" class="form-control form-control-solid" placeholder="{{ trans('cruds.setting.fields.title') }}" id="home_section_features_title_1" value="{{settingContentAr('home_section_features_title_1')}}">
                        <span class="text-danger errors"
                              id="home_section_features_title_1_error"> </span>
                    </div>
                </div>
            </div>

            <div class="row g-9 mb-8">
                <div class="col-md-12 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.description') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <textarea name="home_section_features_description_1" rows="6" class="form-control form-control-solid" placeholder="{{ trans('cruds.setting.fields.description') }}" id="home_section_features_description_1">{{settingContentAr('home_section_features_description_1')}}</textarea>
                        <span class="text-danger errors"
                              id="home_section_features_description_1_error"> </span>
                    </div>
                </div>
            </div>

            <div class="row g-9 mb-8">
                <div class="col-md-12 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.title') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" name="home_section_features_title_2" class="form-control form-control-solid" placeholder="{{ trans('cruds.setting.fields.title') }}" id="home_section_features_title_2" value="{{settingContentAr('home_section_features_title_2')}}">
                        <span class="text-danger errors"
                              id="home_section_features_title_2_error"> </span>
                    </div>
                </div>
            </div>

            <div class="row g-9 mb-8">
                <div class="col-md-12 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.description') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <textarea name="home_section_features_description_2" rows="6" class="form-control form-control-solid" placeholder="{{ trans('cruds.setting.fields.description') }}" id="home_section_features_description_2">{{settingContentAr('home_section_features_description_2')}}</textarea>
                        <span class="text-danger errors"
                              id="home_section_features_description_2_error"> </span>
                    </div>
                </div>
            </div>

            <div class="row g-9 mb-8">
                <div class="col-md-12 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.title') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" name="home_section_features_title_3" class="form-control form-control-solid" placeholder="{{ trans('cruds.setting.fields.title') }}" id="home_section_features_title_3" value="{{settingContentAr('home_section_features_title_3')}}">
                        <span class="text-danger errors"
                              id="home_section_features_title_3_error"> </span>
                    </div>
                </div>

            </div>

            <div class="row g-9 mb-8">
                <div class="col-md-12 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.description') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <textarea name="home_section_features_description_3" rows="6" class="form-control form-control-solid" placeholder="{{ trans('cruds.setting.fields.description') }}" id="home_section_features_description_3">{{settingContentAr('home_section_features_description_3')}}</textarea>
                        <span class="text-danger errors"
                              id="home_section_features_description_3_error"> </span>
                    </div>
                </div>
            </div>

            <hr>

{{--            section how to choose--}}

            <div class="row g-9 mb-8">
                <strong>{{ trans('cruds.setting.fields.home_section_how_to_choose') }}</strong>
                <div class="col-md-12 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.title') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" name="home_section_how_to_choose_title_1" class="form-control form-control-solid" placeholder="{{ trans('cruds.setting.fields.title') }}" id="home_section_how_to_choose_title_1" value="{{settingContentAr('home_section_how_to_choose_title_1')}}">
                        <span class="text-danger errors"
                              id="home_section_how_to_choose_title_1_error"> </span>
                    </div>
                </div>

            </div>

            <div class="row g-9 mb-8">
                <div class="col-md-12 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.description') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <textarea name="home_section_how_to_choose_description_1" rows="6" class="form-control form-control-solid" placeholder="{{ trans('cruds.setting.fields.description') }}" id="home_section_how_to_choose_description_1">{{settingContentAr('home_section_how_to_choose_description_1')}}</textarea>
                        <span class="text-danger errors"
                              id="home_section_how_to_choose_description_1_error"> </span>
                    </div>
                </div>
            </div>

            <div class="row g-9 mb-8">
                <div class="col-md-12 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.title') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" name="home_section_how_to_choose_title_2" class="form-control form-control-solid" placeholder="{{ trans('cruds.setting.fields.title') }}" id="home_section_how_to_choose_title_2" value="{{settingContentAr('home_section_how_to_choose_title_2')}}">
                        <span class="text-danger errors"
                              id="home_section_how_to_choose_title_2_error"> </span>
                    </div>
                </div>

            </div>

            <div class="row g-9 mb-8">
                <div class="col-md-12 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.description') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <textarea name="home_section_how_to_choose_description_2" rows="6" class="form-control form-control-solid" placeholder="{{ trans('cruds.setting.fields.description') }}" id="home_section_how_to_choose_description_2">{{settingContentAr('home_section_how_to_choose_description_2')}}</textarea>
                        <span class="text-danger errors"
                              id="home_section_how_to_choose_description_2_error"> </span>
                    </div>
                </div>
            </div>

            <div class="row g-9 mb-8">
                <div class="col-md-12 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.title') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" name="home_section_how_to_choose_title_3" class="form-control form-control-solid" placeholder="{{ trans('cruds.setting.fields.title') }}" id="home_section_how_to_choose_title_3" value="{{settingContentAr('home_section_how_to_choose_title_3')}}">
                        <span class="text-danger errors"
                              id="home_section_how_to_choose_title_3_error"> </span>
                    </div>
                </div>

            </div>

            <div class="row g-9 mb-8">
                <div class="col-md-12 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.description') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <textarea name="home_section_how_to_choose_description_3" rows="6" class="form-control form-control-solid" placeholder="{{ trans('cruds.setting.fields.description') }}" id="home_section_how_to_choose_description_3">{{settingContentAr('home_section_how_to_choose_description_3')}}</textarea>
                        <span class="text-danger errors"
                              id="home_section_how_to_choose_description_3_error"> </span>
                    </div>
                </div>
            </div>

            <div class="text-end">
                <button class="btn btn-primary mr-2" type="submit"
                        id="btn_save_contact_information"> {{ trans('global.save') }}</button>
            </div>
    </form>
</div>

