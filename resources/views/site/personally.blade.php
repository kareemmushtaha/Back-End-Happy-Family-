@extends('SitePartials.main')
@section('content')
    <div class="advanced-container">
        <div>
            <div class="personally-edit">
                <div>
                    <div class="img-border">
                        <img src="{{$user['photo']}}" alt=""/>
                    </div>
                    <div class="d-flex flex-column gap-2">
                        <h2>{{$user['fake_name']}} </h2>
                        <h3>{{$user['nationality']}}</h3>
                    </div>
                </div>

                <div class="d-flex flex-column gap-2">
                    <a href="">كشف بيانات</a>
                    @if($user['can_contact_us'])
                        <a href="{{route('chat.createAndOpenChat',$user['id'])}}" class="w-100">تواصل</a>
                    @else
                        <a href="{{route('subscription',$package->id)}}" class="w-100">تواصل</a>
                    @endif
                </div>
            </div>

            <div class="personally-details">
                <div>
                    <img src="{{asset('assets/site/images/global.png')}}" alt=""/>
                    <h3>{{$user['country']}}</h3>
                </div>
                <div>
                    <img src="{{asset('assets/site/images/location.png')}}" alt=""/>
                    <h3>{{$user['aria']}}</h3>
                </div>
                <div>
                    <img src="{{asset('assets/site/images/location.png')}}" alt=""/>
                    <h3>{{$user['city']}}</h3>
                </div>
                <div>
                    <img src="{{asset('assets/site/images/calendar.png')}}" alt=""/>
                    <h3>{{$user['birth_date']}} </h3>
                </div>
            </div>
            <div class="personally-details second">
                <div>
                    <img src="{{asset('assets/site/images/male.png')}}" alt=""/>
                    <h3>{{$user['gender']}} </h3>
                </div>
                <div>
                    <img src="{{asset('assets/site/images/weight.png')}}" alt=""/>
                    <h3>{{$user['width']}}</h3>
                </div>
                <div>
                    <img src="{{asset('assets/site/images/height.png')}}" alt=""/>
                    <h3>{{$user['height']}}</h3>
                </div>
            </div>
        </div>
    </div>


    @if($user['can_show_answer_questions'])
        <div class="advanced-container mt-5">
            <div class="overflow-auto">
                <h2>إجابات أسئلة الموقع</h2>
                @foreach($questions as $question)
                    <h2>
                        {{$question->question_title}}
                    </h2>
                    <div class="advanced-selects-container">
                        <div>
                            <select name="test" disabled>
                                @foreach($question->answers as $answer)
                                    <option
                                        @if(getAnsweredQuestion($question->id,$user['id']) ==$answer->id) selected
                                        @endif
                                        data-question_id="{{$question->id}}">{{$answer->answer_title}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="advanced-container mt-5">
            <div class="overflow-auto">
                <h2 class="text-danger"> ملاحظة : لتتمكن من عرض الأسئلة الشخصية عليك بتسجيل الدخول</h2>
            </div>
        </div>
    @endif


@endsection
