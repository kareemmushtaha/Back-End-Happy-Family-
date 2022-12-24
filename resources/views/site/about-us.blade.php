@extends('SitePartials.main')
@section('content')
    <div class="about-container">
        <h1>{{ trans('cruds.setting.about_us') }}</h1>
        <div>
           {!! settingContentAr('about_us') !!}
        </div>

    </div>
@endsection
