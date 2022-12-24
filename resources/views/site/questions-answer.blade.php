@extends('SitePartials.main')
@section('content')
    <div class="questions-container" style="background-color: #ffffff;">
        <h1>الأسئلة الشائعة</h1>
        <div>
            @isset($fqas)
                @foreach($fqas as $fqa)
                    <div class="questions-area">
                        <div>
                            <h2>{{$fqa->question}}</h2>
                            <img src="{{asset('assets/site/images/arrow-left.png')}}" alt=""/>
                        </div>
                        <h3>
                            {{$fqa->answer}}
                        </h3>
                    </div>

                @endforeach
            @endisset
            
        </div>

    </div>

@endsection

