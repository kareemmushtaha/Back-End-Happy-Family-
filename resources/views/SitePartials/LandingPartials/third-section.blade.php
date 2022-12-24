
<div class="landing-dark" id="success_stories">
    @isset($success_stories)
        @foreach($success_stories as $index => $story)
            <div id="{{$index+1}}" class="landing-success @if($index+1 == 1) active-slid @endif">
                <div class="landing-success-content">
                    <h1>نجاحات العلاقات !</h1>
                    <img src="{{asset('assets/site/images/quote.png')}}" alt=""/>
                    <h2>
                        {{$story->description}}
                    </h2>
                    <h3 style="color: #F1BD19;">{{$story->name}}</h3>
                    <h3>{{$story->title}}</h3>
                </div>
                <div class="landing-succesfull-image">
                    <img src="{{asset('assets/site/images/filter-blue.png')}}" alt=""/>
                    <img src="{{$story->photo}}" alt=""/>
                    <img src="{{asset('assets/site/images/filter-burble.png')}}" alt=""/>
                </div>
            </div>
        @endforeach
    @endisset

    <div class="success-storys">
        <img onclick="slidRight()" src="{{asset('assets/site/images/arrow-right-white.png')}}" alt=""/>
        <div id="story-1" class="story active-story"></div>
        <div id="story-2" class="story"></div>
        <div id="story-3" class="story"></div>
        <img onclick="slidLeft()" src="{{asset('assets/site/images/arrow-left-white.png')}}" alt=""/>
    </div>
</div>
