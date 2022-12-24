<div class="main-header">
    <div class="main-header-logo">
        <img src="{{asset('assets/site/images/logo-light.png')}}" alt=""/>
        <div>
            <h3>الأسرة السعيدة</h2>
                <h4>للتــــوفيـــــق بـــــيـــن الأزواج</h3>
        </div>
    </div>
    <div class="main-header-links">
        <a href="#about_us">عن المنصة</a>
        <a href="#success_stories">قصص نجاح</a>
        <a href="#our_advantages">مميزاتنا</a>
        <a href="#subscription">الاشتراك</a>
        <a href="#how_to_choose">كيف تختار</a>
        <a href="#question_answer">الأسئلة الشائعة</a>
        <a href="#formContactUs">اتصل بنا</a>
    </div>
    @if(!auth()->check())
    <div class="main-header-login">
        <a onclick="showAlert('login')">تسجيل دخول</a>
        <a onclick="showAlert('signup-1')">سجل مجاناً</a>
        <i onclick="mobileMenu()" class="fa-solid fa-bars"></i>
    </div>

    @else
        <div class="main-header-login">
            <a ></a>
            <a href="{{route('home')}}">مرحبا {{ auth()->user()->first_name }}</a>
        </div>
    @endif
</div>
