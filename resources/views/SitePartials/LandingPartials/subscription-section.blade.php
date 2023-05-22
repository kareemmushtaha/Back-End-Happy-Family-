
<div class="landing-dark" id="subscription">
    <img class="wife-img" src="{{asset('assets/site/images/wife.png')}}" alt=""/>
    <img class="heart-img" src="{{asset('assets/site/images/heart.png')}}" alt=""/>
    <div class="landing-register">
        <h1>{{$package->title}}</h1>
        <h3>
            {!! $package->description !!}
        </h3>
        <div class="d-flex flex-column gap-2">
            <h2>مميزات الاشتراك</h2>
            {!! $package->subscription_features !!}
            <h2>سعر الإشتراك {{$package->price}}  ريال سعودي</h2>
        </div>

        @if(auth()->check())
        <a href="{{route('package',1)}}">اشترك الان</a>
        @else
            <a  onclick="showAlert('login')" >اشترك الان</a>
        @endif
    </div>
</div>
