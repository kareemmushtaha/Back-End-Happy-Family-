<div class="search-container">
    <form id="searchForm">
        @csrf
        <div class="search-area">
            <div>
                <select name="gender">
                    <option value="" hidden>الجنس</option>
                    <option value="male">ذكر</option>
                    <option value="female">أنثى</option>
                </select>
            </div>
            <div>
                <select name="country" id="country">
                    <option value="" hidden>الدولة</option>
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
                <select name="city"  id="city">
                    <option value="" hidden>المدينة</option>
{{--                    @isset($cities)--}}
{{--                        @foreach($cities as $city)--}}
{{--                            <option value="{{$city->id}}">{{$city->title}}</option>--}}

{{--                        @endforeach--}}
{{--                    @endisset--}}

                </select>
            </div>
            <div class="time-container">
                <h2>من</h2>
                <input type="number" name="from" value="18"/>
                <h2>الى</h2>
                <input type="number" name="to" value="50"/>
            </div>
            <button id="send_data_search" type="submit">بحث</button>
        </div>
    </form>

    <a href="{{route('advanced-search')}}">بحث متقدم</a>


</div><!--start users -->
