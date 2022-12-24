@extends('SitePartials.main')
@section('content')
    <div class="about-container">
        <h1>{{ trans('cruds.setting.privacy_policy') }}</h1>
        <div>
           {!! settingContentAr('privacy_policy') !!}
        </div>

    </div>
@endsection
