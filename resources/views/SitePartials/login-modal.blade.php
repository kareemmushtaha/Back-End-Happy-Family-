<div class="login-profile">
    <h1>اعثر على شريك حياتك </h1>
    <h2>
        يثق بنا أكثر من 3،0 مليون مسلم ومسلمة من حول العالم <br/>
        اختر شريك حياتك بناء على المواصفات التي تتطلبها
    </h2>
    <img class="cubble-img" src="{{asset('assets/site/images/cubble.png')}}" alt=""/>
    <img class="like-img" src="{{asset('assets/site/images/like.png')}}" alt=""/>
    <img class="love-img" src="{{asset('assets/site/images/love.png')}}" alt=""/>
</div>

<form id="formLoginUser" action="#" method="post"
      enctype="multipart/form-data">
    @csrf
    @if(  \Illuminate\Support\Facades\Request::is('landing*' ))
        <div class="signup-close">
            <img src="{{asset('assets/site/images/close.png')}}" alt="" onclick="hideAlert('login')"/>
        </div>
    @endif
    <h1>تسجيل دخول</h1>
    <h2>البريد الإلكتروني او رقم الموبايل</h2>
    <input placeholder="أدخل البريد الإلكتروني أو رقم الموبايل" name="email"/>

    <h2>كلمة المرور</h2>
    <input placeholder="أدخل كلمة المرور" name="password" type="password"/>

    <h3> هل نسيت كلمة المرور</h3>
    <button type="button" id="btn_login_user">تسجيل دخول</button>
    <div>


        @if(  \Illuminate\Support\Facades\Request::is('landing*' ))
            <a onclick="hideAlert('login'), showAlert('signup-1')">
                ليس لديك حساب ؟
                <spane style="color: #631E73;">انشاء حساب</spane>
            </a>
        @else
            <a href="{{route('site_register')}}">
                ليس لديك حساب ؟
                <spane style="color: #631E73;">انشاء حساب</spane>
            </a>

        @endif
        <a href="{{route('home')}}">
            الدخول كزائر
        </a>
    </div>
</form>
