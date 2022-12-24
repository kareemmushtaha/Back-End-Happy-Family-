<div class="landing-dark" id="question_answer">
    <img class="question-img" src="{{asset('assets/site/images/question.png')}}" alt=""/>
    <div class="questions-container my-5">
        <h1 class="text-white">الإستفسارات المقترحة </h1>
        <div>
            @isset($fqas)
                @foreach($fqas as $fqa)
                    <div class="questions-area" style="border-color: white;">
                        <div>
                            <h2 class="text-white">{{$fqa->question}}</h2>
                            <img src="{{asset('assets/site/images/arrow-left-white.png')}}" alt=""/>
                        </div>
                        <h3 class="text-white">
                            {{$fqa->answer}}
                        </h3>
                    </div>
                @endforeach
            @endisset


        </div>
    </div>
</div>
