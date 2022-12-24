
<form id="formcontact" method="post"
      enctype="multipart/form-data">
    @csrf
    <div class="contact-container w-100 my-0" style="border-radius: 0px;">
        <h1>تواصل معنا </h1>
        <div class="contact-area">
            <div>
                <input name="email" id="email" placeholder="البريد الإلكتروني"/>

                <input name="title" id="title" placeholder="عنوان الرسالة"/>
            </div>
            <span class="text-danger errors"
                  id="email_error"> </span>
            <span class="text-danger errors"
                  id="title_error"> </span>
            <div>
                <div class="contact-details">
                    <div>
                        <img src="{{asset('assets/site/images/point.png')}}" alt=""/>
                        <a href="">
                            {{settingContentAr('address')}}
                        </a>
                    </div>
                    <div>
                        <img src="{{asset('assets/site/images/call.png')}}" alt=""/>
                        <a href="">{{settingContentAr('phone')}}</a>
                    </div>
                    <div>
                        <img src="{{asset('assets/site/images/mail.png')}}" alt=""/>
                        <a href="">{{settingContentAr('email')}}</a>
                    </div>
                    <div>
                        <img src="{{asset('assets/site/images/mail.png')}}" alt=""/>
                        <a href="">{{settingContentAr('website')}}</a>
                    </div>
                </div>
                <textarea name="content_msg" placeholder="أكتب الرسالة"></textarea>
            </div>
            <span class="text-danger errors"
                  id="content_msg_error"> </span>
            <div dir="ltr">
                <button type="button" id="btn_contact_us">أرسل</button>
            </div>
        </div>
    </div>
</form>
