@extends('SitePartials.main')
@section('content')
    <form id="formcontact" action="#" method="post"
          enctype="multipart/form-data">
        @csrf
        <div class="contact-container">
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
@endsection

@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('click', '#btn_contact_us', function (e) {
            $('#btn_contact_us').html('جاري الارسال <i class="fa fa-spinner fa-spin"></i>').addClass('link-disabled');
            e.preventDefault();
            $('.errors').text('');
            var formData = new FormData($('#formcontact')[0]); //get all data in form
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{ route("sendContactUs") }}",
                data: formData, // send this data to controller
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    $('#btn_contact_us').html('ارسال').removeClass('link-disabled');

                    document.getElementById("formcontact").reset();
                    setTimeout(function () {
                        //the url I want to redirect to
                        $(location).attr('href', data.redirect_url);
                    }, 0);

                }, error: function (reject) {
                    $('#btn_contact_us').html('ارسال').removeClass('link-disabled');
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function (key, val) {
                        // for loop to all validation and show all validate
                        $("#" + key + "_error").text(val[0]);
                    });
                }
            });
        });
    </script>

@endsection






