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
        <form>
            <div class="main-search-blur"></div>
            <div class="main-content-search">
                <select name="nationality">
                    <option value="null" hidden>السعودية</option>
                    <option value="a">a</option>
                    <option value="b">b</option>
                </select>
                <select name="nationality">
                    <option value="null" hidden>جدة</option>
                    <option value="a">a</option>
                    <option value="b">b</option>
                </select>
                <select name="nationality">
                    <option value="null" hidden>ذكر</option>
                    <option value="a">a</option>
                    <option value="b">b</option>
                </select>
                <div>
                    <h3>من</h3>
                    <input type="number" value="18"/>
                    <h3>الى</h3>
                    <input type="number" value="18"/>
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
