<div class="main-content" id="about_us">
    <h1>{{settingContentAr('home_header_title')}}</h1>
    <div class="main-content-headlines">
        <div></div>
        <h2>{{settingContentAr('home_header_description')}}</h2>
    </div>
    <div class="main-content-inputs">
        <div class="main-content-user main-header-login">
            <a href="{{route('home')}}">اعثر على شريك حياتك </a>
            <a style="background-color:#560c74;color: white " onclick="showAlert('signup-1')">وفق بين مسلم و مسلمة</a>
        </div>
        <form action="{{route('resultSearchLanding')}}" method="post">
            @csrf
            <div class="main-search-blur"></div>
            <div class="main-content-search">
                <select name="country" id="country">
                    <option value="" hidden>دولة الإقامة</option>
                    @isset($countries)
                        @foreach($countries as $country)
                            <option value="{{$country->id}}">{{$country->title}}</option>

                        @endforeach
                    @endisset
                </select>
                <select name="area" id="area">
                    <option value="" hidden>المنطقه</option>

                </select>
                <select name="city" id="city">
                    <option value="" hidden>المدينة</option>
                </select>

                <select name="gender">
                    <option value="" hidden>الجنس</option>
                    <option value="male">ذكر</option>
                    <option value="female">أنثى</option>
                </select>
                <div>
                    <h2>من</h2>
                    <h2>من</h2>
                    <input type="number" name="year_from" value="1960"/>
                    <h2>الى</h2>
                    <input type="number" name="year_to" value="2004"/>
                </div>
                <button type="submit">
                    <img src="{{asset('assets/site/images/search-gold.png')}}" alt=""/>
                </button>
            </div>
        </form>
    </div>
    <div class="main-content-numbers">
        <div>
            <h2>وجدوا شريكهم</h2>
            <h1>100k+</h1>
        </div>
        <div>
            <h2>مسلم و مسلمه يثقونا بنا</h2>
            <h1>300k+</h1>
        </div>
        <div>
            <h2>وسيط</h2>
            <h1>40k+</h1>
        </div>
    </div>
</div>
