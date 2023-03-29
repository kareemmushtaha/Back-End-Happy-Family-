<form id="formRegisterUser" class="form" action="#" method="post"
      enctype="multipart/form-data">
    @csrf
    <div id="signup-1"
         class="dark-background   @if(  \Illuminate\Support\Facades\Request::is('landing*' )) hidden @endif ">
        <div class="signup-container">
            @if(  \Illuminate\Support\Facades\Request::is('landing*' ))
                <div class="signup-close">
                    <img src="{{asset('assets/site/images/close.png')}}" alt="" onclick="hideAlert('signup-1')"/>
                </div>
            @endif
            <div>
                <div class="signup-steps">
                    <h2 style="color: #631E73;">تحديد نوع الحساب</h2>
                    <h2>معلومات أساسيه</h2>
                    <h2>بيانات شخصيه</h2>
                    <h2>التعهد</h2>
                </div>
                <div class="signup-progress">
                    <div class="active-progress">1</div>
                    <section class="progress-one"></section>
                    <div>2</div>
                    <section class="progress-two"></section>
                    <div>3</div>
                    <section class="progress-three"></section>
                    <div>4</div>
                </div>

            </div>
            <div class="signup-content">
                <div>
                    <h2>أختر نوع الحساب</h2>
                    <ul>
                        <li data-account="3" id="account" value="3" class="signup-active-answer">فرد</li>
                        <li data-account="2" id="account" value="2">وسيط</li>
                    </ul>
                </div>
                <input type="hidden" value="3" id="user_role" name="user_role">
                <div>
                    <h2>الجنس</h2>
                    <ul>
                        <li data-gender="male" id="gender" value="male" class="signup-active-answer">ذكر</li>
                        <li data-gender="female" id="gender" value="female">أنثى</li>
                    </ul>

                </div>
                <input type="hidden" value="male" id="user_gender" name="user_gender">

            </div>
            <div class="signup-navigate">
                <a onclick="showSignupOneAnswer(), showAlert('signup-2'), hideAlert('signup-1')"
                   class="signup-next-button">التالي</a>
            </div>
        </div>
    </div>
    <div id="signup-2" class="dark-background hidden">
        <div class="signup-container">
            @if(  \Illuminate\Support\Facades\Request::is('landing*' ))
                <div class="signup-close">
                    <img src="{{asset('assets/site/images/close.png')}}" alt="" onclick="hideAlert('signup-1')"/>
                </div>
            @endif
            <div>

                <div class="signup-steps">
                    <h2 style="color: #631E73;">تحديد نوع الحساب</h2>
                    <h2 style="color: #631E73;">معلومات أساسيه</h2>
                    <h2>بيانات شخصيه</h2>
                    <h2>التعهد</h2>
                </div>
                <div class="signup-progress">
                    <div class="active-progress">1</div>
                    <section class="progress-one active-progress"></section>
                    <div class="active-progress">2</div>
                    <section class="progress-two"></section>
                    <div>3</div>
                    <section class="progress-three"></section>
                    <div>4</div>
                </div>
            </div>
                <div class="signup-content mt-3">

                    <div>
                        <h2 style="color: #631E73;">الاسم الاول</h2>
                        <h2 style="color: #8b0534;font-size: 16px;"> لا يظهر للمستخدمين</h2>

                        <input name="first_name" class="col-lg-12" placeholder="الاسم الاول"/>
                    </div>

                    <div>
                        <h2 style="color: #631E73;">العائله</h2>
                        <h2 style="color: #8b0534;font-size: 16px;"> لا يظهر للمستخدمين</h2>
                        <input name="last_name" class="col-lg-12" placeholder="العائله"/>
                    </div>

                    <div>
                        <h2 style="color: #631E73;">البريد الإلكتروني</h2>
                        <input name="email" class="col-lg-12" placeholder="البريد الإلكتروني"/>
                    </div>


                    <div>
                        <h2 style="color: #631E73;">كلمة المرور</h2>
                        <input type="password" class="col-lg-12" name="password" placeholder="كلمة المرور"/>
                    </div>

                    <div>
                        <h2 style="color: #631E73;">رقم الجوال</h2>
                        <input name="phone" class="col-lg-12" placeholder="رقم الجوال"/>
                    </div>

                    <div>
                        <h2 style="color: #631E73;">الاسم الرمزي</h2>
                        <h2 style="color: #8b0534;font-size: 16px;">الإسم الظاهر للمستخدمين</h2>

                        <input name="fake_name" class="col-lg-12" placeholder="الاسم الرمزي"/>
                    </div>


                    <div>
                        <h2 style="color: #631E73;">تاريخ الميلاد</h2>
                        <input class="col-lg-12" name="birth_date" type="date"/>
                    </div>
                </div>
                <div class="signup-navigate">
                    <a onclick="hideAlert('signup-2'), showAlert('signup-1')" class="signup-back-button">السابق</a>
                    <a onclick="hideAlert('signup-2'), showAlert('signup-3')" class="signup-next-button">التالي</a>
                </div>
        </div>
    </div>
    <div id="signup-3" class="dark-background hidden">
        <div class="signup-container">
            @if(  \Illuminate\Support\Facades\Request::is('landing*' ))
                <div class="signup-close">
                    <img src="{{asset('assets/site/images/close.png')}}" alt="" onclick="hideAlert('signup-1')"/>
                </div>
            @endif
            <div>

                <div class="signup-steps">
                    <h2 style="color: #631E73;">تحديد نوع الحساب</h2>
                    <h2 style="color: #631E73;">معلومات أساسيه</h2>
                    <h2 style="color: #631E73;">بيانات شخصيه</h2>
                    <h2>التعهد</h2>
                </div>
                <div class="signup-progress">
                    <div class="active-progress">1</div>
                    <section class="progress-one active-progress"></section>
                    <div class="active-progress">2</div>
                    <section class="progress-two active-progress"></section>
                    <div class="active-progress">3</div>
                    <section class="progress-three"></section>
                    <div>4</div>
                </div>
            </div>
            <div class="signup-content">

                {{--                <input name="nationality" placeholder="الجنسية"/>--}}


                <div>
                    <h2 style="color: #631E73;">الجنسية</h2>
                    <select name="nationality" class="col-lg-12" id="nationality">
                        <option value="null" hidden>الجنسية</option>
                        @foreach(\App\Models\Country::all() as $item)
                            <option value="{{$item->title}}">{{$item->title}}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <h2 style="color: #631E73;">دولة الإقامه</h2>
                    <select name="country_id" class="col-lg-12" id="country">
                        <option value="null" hidden>دولة الإقامه</option>
                        @foreach(\App\Models\Country::all() as $item)
                            <option value="{{$item->id}}">{{$item->title}}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <h2 style="color: #631E73;">المنطقه</h2>
                    <select name="aria_id" class="col-lg-12" id="area">
                        <option value="" hidden>المنطقه</option>
                    </select>
                </div>

                <div>
                    <h2 style="color: #631E73;">المدينه</h2>
                    <select name="city_id" class="col-lg-12">
                        <option value="" hidden>المدينه</option>
                    </select>
                </div>

                <div>
                    <h2 style="color: #631E73;">الطول</h2>
                    <input name="height" id="height" class="col-lg-12" placeholder="الطول"/>
                </div>

                <div>
                    <h2 style="color: #631E73;">الوزن</h2>
                    <input name="width" id="width" class="col-lg-12" placeholder="الوزن"/>
                </div>


            </div>
            <div class="signup-navigate">
                <a onclick="hideAlert('signup-3'), showAlert('signup-2')" class="signup-back-button">السابق</a>
                <a onclick="hideAlert('signup-3'), showAlert('signup-4')" class="signup-next-button">التالي</a>
            </div>
        </div>
    </div>
    <div id="signup-4" class="dark-background hidden">
        <div class="signup-container">
            @if(  \Illuminate\Support\Facades\Request::is('landing*' ))
                <div class="signup-close">
                    <img src="{{asset('assets/site/images/close.png')}}" alt="" onclick="hideAlert('signup-1')"/>
                </div>
            @endif
            <div>

                <div class="signup-steps">
                    <h2 style="color: #631E73;">تحديد نوع الحساب</h2>
                    <h2 style="color: #631E73;">معلومات أساسيه</h2>
                    <h2 style="color: #631E73;">بيانات شخصيه</h2>
                    <h2 style="color: #631E73;">التعهد</h2>
                </div>
                <div class="signup-progress">
                    <div class="active-progress">1</div>
                    <section class="progress-one active-progress"></section>
                    <div class="active-progress">2</div>
                    <section class="progress-two active-progress"></section>
                    <div class="active-progress">3</div>
                    <section class="progress-three active-progress"></section>
                    <div class="active-progress">4</div>
                </div>
            </div>
            <div class="signup-promise">
                <h2>أقسم بالله العظيم أن غرضي هو الزواج الشرعي فقط </h2>
                <h2>أوافق على الشروط و الأحكام</h2>
                <button type="button"
                        id="btn_register_user"> أقسم بالله
                </button>
            </div>

            <div style="max-height: 300px">
                <i class="text-danger errors" id="role_id_error"> </i>
                <i class="text-danger errors" id="user_gender_error"> </i>
                <i class="text-danger errors" id="first_name_error"> </i>
                <i class="text-danger errors" id="last_name_error"> </i>
                <i class="text-danger errors" id="email_error"> </i>
                <i class="text-danger errors" id="phone_error"> </i>
                <i class="text-danger errors" id="fake_name_error"> </i>
                <i class="text-danger errors" id="birth_date_error"> </i>
                <i class="text-danger errors" id="nationality_error"> </i>
                <i class="text-danger errors" id="country_id_error"> </i>
                <i class="text-danger errors" id="aria_id_error"> </i>
                <i class="text-danger errors" id="city_id_error"> </i>
                <i class="text-danger errors" id="height_error"> </i>
                <i class="text-danger errors" id="width_error"> </i>
            </div>
            <div class="signup-navigate">
                <a onclick="hideAlert('signup-4'), showAlert('signup-3')" class="signup-back-button">السابق</a>
            </div>
        </div>
    </div>
</form>










