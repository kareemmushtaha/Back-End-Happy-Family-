@extends('SitePartials.main')
@section('content')
    <div class="register-container">
        <div>
            <h1>اشترك معنا بباقة {{$package->title}} </h1>
            <h3>
                {{$package->description}}
            </h3>
            <div class="d-flex flex-column gap-4">
                <h2>مميزات الاشتراك</h2>
                {!! $package->subscription_features !!}
                <h2>سعر الإشتراك {{$package->price}}   ريال سعودي <span style="color: #1A225A">صالحة لمدة (3) أشهر </span> </h2>
            </div>
            <a style="color: white" id="btn_save_subscription" href="{{route('urway.payment.checkout',$package->id)}}">اشترك الان</a>
        </div>
        <img src="{{asset('assets/site/images/wallet.png')}}" alt=""/>
    </div>
@endsection

