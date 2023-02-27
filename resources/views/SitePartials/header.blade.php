<div class="header">
    <a href="">
        <div class="logo-area">
            <img src="{{asset('assets/site/images/logo.png')}}" alt=""/>
            <div>
                <h2>الأسرة السعيدة</h2>
                <h3>للتوفيق بين الأزواج</h3>
            </div>
        </div>
    </a>
    <div class="header-content">
        @if(auth()->check())
            @if(auth()->user()->getType()== "mediator")
                <a href="{{route('mediator.users.index')}}">لوحة تحكم</a>
            @endif
        @endif
        <a href="{{route('home')}}"
           @if(  \Illuminate\Support\Facades\Request::is('home*' )) style="color: #F1BD19;" @endif> الرئيسية</a>
        <a href="{{route('landing')}}">عن المنصة</a>
        <a href="{{route('package',1)}}"
           @if(  \Illuminate\Support\Facades\Request::is('package*' )) style="color: #F1BD19;" @endif>الاشتراك</a>
        <a href="{{route('question_answer')}}"
           @if(  \Illuminate\Support\Facades\Request::is('question_answer*' )) style="color: #F1BD19;" @endif>الأسئلة
            الشائعة</a>
        <a href="{{route('contact')}}"
           @if(  \Illuminate\Support\Facades\Request::is('contact*' )) style="color: #F1BD19;" @endif>اتصل بنا</a>
        <div class="icons">
           <a href=" {{route('advanced-search')}}"> <img src="{{asset('assets/site/images/search.png')}}" alt=""/></a>
            @if(\Illuminate\Support\Facades\Auth::check())
{{--                <img src="{{asset('assets/site/images/settings.png')}}" alt=""/>--}}
{{--                <img id="icon" onclick="notification('messages')" src="{{asset('assets/site/images/messages.png')}} "alt=""/>--}}
              <a href="{{route('chat.index')}}">  <img id="icon"  src="{{asset('assets/site/images/messages.png')}} "alt=""/></a>
                <img id="icon" onclick="notification('alert')" src="{{asset('assets/site/images/bell.png')}} " alt=""/>
            @endif
        </div>

        @if( \Illuminate\Support\Facades\Auth::check())
            <div class="account" onclick="notification('logout')">
                <div class="img-border">
                    <img id="icon" src="{{asset(auth()->user()->photo)}} " alt=""/>
                </div>
                <h2 id="icon">{{auth()->user()->getFullName()}}</h2>
                <img id="icon" src="{{asset('assets/site/images/arrow-down.png')}} " alt=""/>
            </div>
            @endif
            <i onclick="mobileMenu()" class="fa-solid fa-bars"></i>
            @if( \Illuminate\Support\Facades\Auth::check())

            <div id="logout" class="notification">
                <div>
                    <a href="{{route('my_profile')}}">
                        <h2>عرض الملف الشخصي</h2>
                    </a>
                </div>
                <div class="notification-content">
                    <div>
                        <a href="{{route('logout')}}">
                            <div class="d-flex justify-content-between">
                                <h2>تسجيل الخروج</h2>
                                <img style="width: 20px; height: 20px;" src="{{asset('assets/site/images/exit.png')}} "
                                     alt=""/>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div id="messages" class="notification">
                <div>
                    <h2>الرسائل</h2>
                    <a href="{{route('chat.index')}}">
                        <h3>عرض الكل</h3>
                    </a>
                </div>
                <div class="notification-content">

                            <div>
                                <a href="">
                                    <div class="d-flex justify-content-between">
                                        <h2></h2>
                                        <h4>قبل 5 ثوان</h4>
                                    </div>
                                    <div class="d-flex gap-3 align-items-center">
                                        <div class="img-border">
                                            <img style="width: 50px; height: 50x; border-radius: 50%;"
                                                 src="{{asset('assets/site/images/man.png')}}" alt=""/>
                                        </div>
                                        <h2>أرسل لك رسالة</h2>
                                    </div>
                                </a>
                            </div>

                </div>
            </div>
            <div id="alert" class="notification">
                <div>
                    <h2>الإشعارات</h2>
                    <a href="">
                        <h3>عرض الكل</h3>
                    </a>
                </div>
                <a href="">
                    <div class="notification-content">
                        <img style="width: 20px; height: 20px;" src="{{asset('assets/site/images/bell.png')}}" alt=""/>
                        <div>
                            <div class="d-flex justify-content-between">
                                <h2>عنوان الإشعار</h2>
                                <h4>قبل 5 ثوان</h4>
                            </div>
                            <h2>هنا نص نص نص الاشعار...</h2>
                        </div>
                    </div>
                </a>
                <a href="">
                    <div class="notification-content">
                        <img style="width: 20px; height: 20px;" src="{{asset('assets/site/images/bell.png')}}" alt=""/>
                        <div>
                            <div class="d-flex justify-content-between">
                                <h2>عنوان الإشعار</h2>
                                <h4>قبل 5 ثوان</h4>
                            </div>
                            <h2>هنا نص نص نص الاشعار...</h2>
                        </div>
                    </div>
                </a>
                <a href="">
                    <div class="notification-content">
                        <img style="width: 20px; height: 20px;" src="{{asset('assets/site/images/bell.png')}}" alt=""/>
                        <div>
                            <div class="d-flex justify-content-between">
                                <h2>عنوان الإشعار</h2>
                                <h4>قبل 5 ثوان</h4>
                            </div>
                            <h2>هنا نص نص نص الاشعار...</h2>
                        </div>
                    </div>
                </a>
                <a href="">
                    <div class="notification-content">
                        <img style="width: 20px; height: 20px;" src="{{asset('assets/site/images/bell.png')}}" alt=""/>
                        <div>
                            <div class="d-flex justify-content-between">
                                <h2>عنوان الإشعار</h2>
                                <h4>قبل 5 ثوان</h4>
                            </div>
                            <h2>هنا نص نص نص الاشعار...</h2>
                        </div>
                    </div>
                </a>
                <a href="">
                    <div class="notification-content">
                        <img style="width: 20px; height: 20px;" src="{{asset('assets/site/images/bell.png')}}" alt=""/>
                        <div>
                            <div class="d-flex justify-content-between">
                                <h2>عنوان الإشعار</h2>
                                <h4>قبل 5 ثوان</h4>
                            </div>
                            <h2>هنا نص نص نص الاشعار...</h2>
                        </div>
                    </div>
                </a>
            </div>
        @else
            <div>
                <a class="signup" href="{{route('login')}}">سجل مجانا</a>
            </div>
        @endif
    </div>
    <div class="mobile-menu">

        @if(\Illuminate\Support\Facades\Auth::check())
            <a href="">
                <div class="account">
                    <div class="img-border">
                        <img src="{{asset('assets/site/images/man.png')}}" alt=""/>
                    </div>
                    <h2>طلال بندر المداح</h2>
                </div>
            </a>
        @else
            <div>
                <a class="signup" href="{{route('login')}}">سجل مجانا</a>
            </div>
        @endif












            @if(auth()->check())
                @if(auth()->user()->getType()== "mediator")
                    <a href="{{route('mediator.users.index')}}">لوحة تحكم</a>
                @endif
            @endif
            <a href="{{route('home')}}"
               @if(  \Illuminate\Support\Facades\Request::is('home*' ))  @endif> الرئيسية</a>
            <a href="{{route('landing')}}" >عن المنصة</a>
            <a href="{{route('package',1)}}"
               @if(  \Illuminate\Support\Facades\Request::is('package*' )) style="color: #F1BD19;" @endif>الاشتراك</a>
            <a href="{{route('question_answer')}}"
               @if(  \Illuminate\Support\Facades\Request::is('question_answer*' )) style="color: #F1BD19;" @endif>الأسئلة
                الشائعة</a>
            <a href="{{route('contact')}}"
               @if(  \Illuminate\Support\Facades\Request::is('contact*' )) style="color: #F1BD19;" @endif>اتصل بنا</a>
            <div class="icons">
                <a href=" {{route('advanced-search')}}"> <img src="{{asset('assets/site/images/search.png')}}" alt=""/></a>
                @if(\Illuminate\Support\Facades\Auth::check())
                    {{--                <img src="{{asset('assets/site/images/settings.png')}}" alt=""/>--}}
                    {{--                <img id="icon" onclick="notification('messages')" src="{{asset('assets/site/images/messages.png')}} "alt=""/>--}}
                    <a href="{{route('chat.index')}}">  <img id="icon"  src="{{asset('assets/site/images/messages.png')}} "alt=""/></a>
                    <img id="icon" onclick="notification('alert')" src="{{asset('assets/site/images/bell.png')}} " alt=""/>
                @endif
            </div>

            @if(auth()->check())
                <a href="{{route('logout')}}">
                    تسجيل الخروج
                    <img style="width: 20px; height: 20px; margin-right: 30px;" src="{{asset('assets/site/images/exit.png')}}"
                         alt=""/>
                </a>
            @endif



    </div>
</div><!-- start body -->
