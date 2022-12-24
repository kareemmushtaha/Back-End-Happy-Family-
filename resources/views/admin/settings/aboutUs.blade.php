<div class="tab-pane fade" id="aboutUs" role="tabpanel">
    <form id="aboutUsForm" method="post" action="{{route('admin.settings.saveSetting')}}" class="form">
        @csrf
            <!--begin::Input group-->
            <input type="hidden" name="local" value="ar">
            <div class="row g-9 mb-8">
                <div class="col-md-12 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.about_us') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <textarea name="about_us" id="about_us_description">{{settingContentAr('about_us')}}</textarea>
                        <span class="text-danger errors"
                              id="about_us_error"> </span>
                    </div>
                </div>
            </div>


            <div class="text-end">
                <button class="btn btn-primary mr-2" type="submit"
                        id="btn_save_about_us"> {{ trans('global.save') }}</button>
            </div>
    </form>
</div>

