<div class="tab-pane fade" id="footer" role="tabpanel">
    <form id="footerForm" method="post" action="{{route('admin.settings.saveSetting')}}" class="form">
        @csrf
            <!--begin::Input group-->
            <input type="hidden" name="local" value="ar">
            <div class="row g-9 mb-8">
                <div class="col-md-6 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.title_site') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" name="title_site" class="form-control form-control-solid" placeholder="{{ trans('cruds.setting.fields.title_site') }}" id="title_site" value="{{settingContentAr('title_site')}}">
                        <span class="text-danger errors"
                              id="title_site_error"> </span>
                    </div>
                </div>

                <div class="col-md-6 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.description_site') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <textarea type="text" name="description_site" class="form-control form-control-solid" placeholder="{{ trans('cruds.setting.fields.description_site') }}" id="description_site" >{{settingContentAr('description_site')}}</textarea>
                        <span class="text-danger errors"
                              id="description_site_error"> </span>
                    </div>
                </div>
            </div>

            <div class="row g-9 mb-8">
                <div class="col-md-6 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.facebook_link') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" name="facebook_link" class="form-control form-control-solid" placeholder="{{ trans('cruds.setting.fields.facebook_link') }}" id="facebook_link" value="{{settingContentAr('facebook_link')}}">
                        <span class="text-danger errors"
                              id="facebook_link_error"> </span>
                    </div>
                </div>

                <div class="col-md-6 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.twitter_link') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" name="twitter_link" class="form-control form-control-solid" placeholder="{{ trans('cruds.setting.fields.twitter_link') }}" id="twitter_link" value="{{settingContentAr('twitter_link')}}">
                        <span class="text-danger errors"
                              id="twitter_link_error"> </span>
                    </div>
                </div>
            </div>

            <div class="row g-9 mb-8">
                <div class="col-md-12 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.instagram_link') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" name="instagram_link" class="form-control form-control-solid" placeholder="{{ trans('cruds.setting.fields.instagram_link') }}" id="instagram_link" value="{{settingContentAr('instagram_link')}}">
                        <span class="text-danger errors"
                              id="instagram_link_error"> </span>
                    </div>
                </div>

            </div>


            <div class="text-end">
                <button class="btn btn-primary mr-2" type="submit"
                        id="btn_save_footer"> {{ trans('global.save') }}</button>
            </div>
    </form>
</div>

