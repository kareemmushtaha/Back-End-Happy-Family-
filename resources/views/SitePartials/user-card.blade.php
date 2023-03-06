<a href="{{route('personally',$user['id'])}}" class="user">
    <div class="user-profile">
        <div class="img-border">
            <img class="" src="{{$user['photo']}}" alt=""/>
        </div>
        <div>
            <h1>{{$user['fake_name']}}</h1>
        </div>
    </div>
    <div class="user-details">
        <img src="{{asset('assets/site/images/global.png')}}" alt=""/>
        <h2>{{$user['country']}}</h2>
        <img src="{{asset('assets/site/images/calendar.png')}}" alt=""/>
        <h2>{{$user['birth_date']}}</h2>
        <img src="{{asset('assets/site/images/location.png')}}" alt=""/>
        <h2>{{$user['city']}}</h2>
    </div>


    <button>عرض الملف الشخصي</button>
</a>
