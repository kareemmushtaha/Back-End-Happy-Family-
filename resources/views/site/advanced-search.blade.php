@extends('SitePartials.main')
@section('content')

    <form method="post" action="{{route('result-advanced-search')}}">
        @csrf
        <div class="advanced-container">
            <div class="overflow-auto">
                <h1>البحث المتقدم</h1>
                <div class="advanced-selects-container">

                    <div class="advanced-range-area">
                        <h2 style="width: 100%">ابحث عن</h2>
                        <input type="text" name="search" placeholder="ابحث عن ..." />
                    </div>
                    <div>
                        <img src="{{asset('assets/site/images/location.png')}}" alt=""/>
                        <select name="country" id="country">
                            <option value="" hidden>دولة الإقامة</option>
                            @isset($countries)
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{$country->title}}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>
                    <div>
                        <img src="{{asset('assets/site/images/global.png')}}" alt=""/>
                        <select name="area" id="area">
                            <option value="" hidden>المنطقه</option>

                        </select>
                    </div>
                    <div>
                        <img src="{{asset('assets/site/images/location.png')}}" alt=""/>
                        <select name="city" id="city">
                            <option value="" hidden>المدينة</option>
                        </select>
                    </div>
                </div>
                <div class="advanced-range-container">
                    <div>
                        <h2>نطاق الوزن</h2>
                        <div class="advanced-range-area">
                            <h2>من</h2>
                            <input type="number" name="weight_from" value="40"/>
                            <h2>الى</h2>
                            <input type="number" name="weight_to" value="120"/>
                        </div>
                    </div>
                    <div>
                        <h2>نطاق الطول</h2>
                        <div class="advanced-range-area">
                            <h2>من</h2>
                            <input type="number" name="height_from"  value="100"/>
                            <h2>الى</h2>
                            <input type="number" name="height_to" value="200"/>
                        </div>
                    </div>
                    <div>
                        <h2>نطاق العمر</h2>
                        <div class="advanced-range-area">
                            <h2>من</h2>
                            <input type="number" name="year_from" value="1960"/>
                            <h2>الى</h2>
                            <input type="number" name="year_to" value="2004"/>
                        </div>
                    </div>
                </div>
                <h2>إجابات أسئلة الموقع</h2>
                @isset($questions)
                    @foreach($questions as $question)
                        <h2>
                            {{$question->question_title}}
                        </h2>
                        <div class="advanced-selects-container">
                            <div>
                                <select name="answers[]" >
                                    <option value=""   hidden  >اختر الاجابة</option>
                                    @isset($question->answers)
                                        @foreach($question->answers as $answer)
                                            <option value="{{$answer->id}}" data-question_id="{{$question->id}}">{{$answer->answer_title}}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>
                        </div>
                    @endforeach
                @endisset

            </div>
        </div>
        <div class="advanced-bottom">
            <button type="submit">إبحث</button>
        </div>
    </form>


@endsection

@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function () {

            $(document).on('change', '#country', function (e) {
                e.preventDefault();

                let country_id = $(this).val();
                $.ajax({
                    type: 'post',
                    enctype: 'multipart/form-data',
                    url: "{{ route("filterAreas") }}",
                    data: {'country_id': country_id}, // send this data to controller
                    dataType: 'json',

                    success: function (data) {
                        $('select[name="area"]').empty();
                        $('select[name="area"]').append('<option value="">المنطقه</option>');
                        $.each(data.areas, function (key, value) {

                            $('select[name="area"]').append(`<option value="${value.id}">${value.title}</option>`);
                        });

                    }
                });
            });

            $(document).on('change', '#area', function (e) {
                e.preventDefault();

                let area_id = $(this).val();
                $.ajax({
                    type: 'post',
                    enctype: 'multipart/form-data',
                    url: "{{ route("filterCities") }}",
                    data: {'area_id': area_id}, // send this data to controller
                    dataType: 'json',

                    success: function (data) {
                        $('select[name="city"]').empty();
                        $('select[name="city"]').append('<option value="">المدينة</option>');
                        $.each(data.cities, function (key, value) {

                            $('select[name="city"]').append(`<option value="${value.id}">${value.title}</option>`);
                        });

                    }
                });
            });

        });
    </script>
@endsection
