<div class="section date-container">
    <div>

        @if(\Illuminate\Support\Facades\Auth::check())
            @if( \Carbon\Carbon::now()->format('A') =="PM")
                <h1> مساء الخير {{auth()->user()->getFullName()}} </h1>
            @else
                <h1> صباح الخير {{auth()->user()->getFullName()}} </h1>
            @endif
            <h2 class="mt-3">{{\Carbon\Carbon::now()->locale('ar')->format('Y M D')}}</h2>

        @else
            <h1> أهلا وسهلا بك في الأسرة السعيدة </h1>
            <h2 class="mt-3">{{\Carbon\Carbon::now()->locale('ar')->format('Y M D')}}</h2>
        @endif
    </div>
    <img src="{{asset('assets/site/images/plane.png')}}" alt=""/>
</div>
