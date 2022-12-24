<div class="profile-top">
    <div>
        <div class="img-border">
            <a href="">

                <img id="icon" src="{{asset( auth()->user()->photo)}} " alt=""/>

            </a>
        </div>
        <div>
            <a href="">
                <h2>{{auth()->user()->getFullName()}} </h2>
                <h3 class="mt-2">{{auth()->user()->nationality}}</h3>
            </a>
        </div>
    </div>

    {{--    check user role mediator--}}

    @if(auth()->user()->getType()== "mediator")
        <a href="{{route('mediator.users.index')}}">
            <button>لوحة التحكم</button>
        </a>
    @endif
</div>
