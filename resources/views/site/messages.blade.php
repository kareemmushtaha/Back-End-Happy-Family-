@extends('SitePartials.main')
@section('content')

    <form id="answer" class="hidden">
        <div class="dark-background" style="background-color: #1a215a7f;">
            <div class="popup-container">
                <img src="{{asset('assets/site/images/close.png')}}" alt="" onclick="hideAlert('answer')"/>
                <h1>أدخل إجابة مخصصة</h1>
                <input id="answer_title_ar" placeholder="أدخل نص  الااجاب المناسبة"/>
                <h3>هذه الإجابة سوف تخضع إلى التدقيق من الادرارة</h3>
                <button type="button" onclick="SendCustomAnswer()">إرسال</button>
            </div>
        </div>
    </form>
    <!-- question alert  -->
    <form id="question" class="hidden">
        <div class="dark-background" style="background-color: #1a215a7f;">
            <div class="popup-container">
                <img src="{{asset('assets/site/images/close.png')}}" alt="" onclick="hideAlert('question')"/>
                <h1>أدخل سؤال مخصصة</h1>
                <input id="question_title_ar" placeholder="أدخل نص  السؤال المناسب"/>
                <h3>هذا السؤال سوف يخضع إلى التدقيق من الادرارة</h3>
                <button type="button" onclick="SendCustomQuestion()">إرسال</button>
            </div>
        </div>
    </form>
    <div id="notification" class="dark-background hidden" style="background-color: #1a215a7f;">
        <div class="popup-container">
            <img src="{{asset('assets/site/images/close.png')}}" alt="" onclick="hideAlert('notification')"/>
            <h1>ملاحظة</h1>
            <h2>
                هذا السؤال لا يزال قيد إنتظار الموافقة من قبل الإدارة
                يرجى متابعه الاشعارات خلال الساعات القادمة
            </h2>
            <button onclick="hideAlert('notification')">موافق</button>
        </div>
    </div>

    <div id="answerSelect" class="dark-background hidden" style="background-color: transparent;">
        <div class="popup-container-answers">
            <div>
                <img src="{{asset('assets/site/images/close.png')}}" alt="" onclick="hideAlert('answerSelect')"/>
                <h1>إختر الإجابة المناسبة</h1>
            </div>
            <section>
                <ul>
                    @foreach($answers as $answer)
                        <li id="answer" data-answer-id="{{$answer->id}}"
                            onclick="choiceAnswer(this)">{{$answer->answer_title}}</li>
                    @endforeach
                </ul>
            </section>
            <div>
                <h3 class="p-0" onclick="hideAlert('answerSelect'); showAlert('answer')">هل تريد إرسال رسالة مخصصة
                    ؟؟</h3>
                <button class="m-0" onclick=" SendAnswer()">
                    <img class="plus-img" style="width: 15px; height: 15px; margin-left: 10px;"
                         src="{{asset('assets/site/images/plus.png')}}" alt=""/>
                    إرسال الإجابة
                </button>
            </div>
        </div>
    </div>

    <div class="messages-container">

        <div class="messages-chats-area" >

                        <a class="bg-white px-5">
                            <h1>الدردشات</h1>
                        </a>
            <form class="p-2 ">
                <button type="submit">
                    <img style="width: 25px; height: 25px;" src="{{asset('assets/site/images/search-dark.png')}}"
                         alt=""/>
                </button>
                <input name="search" id="search"  placeholder="ابحث هنا"/>
            </form>
            <div class="messages-chats-area" id="users-links-chat">

            </div>
        </div>

        <div class="messages-texts-area">
            <div id="mobile-profile" class="profile-img-div" onclick="mobileProfile()">
                <img id="mobile-profile" src="{{asset('assets/site/images/profile.png')}}" alt=""/>
            </div>
            <div id="mobile-chats" class="chat-img-div" onclick="mobileChats()">
                <img id="mobile-chats" src="{{asset('assets/site/images/chat.png')}}" alt=""/>
            </div>

            <input type="number" value="" id="current_question_id" hidden>
            <input type="number" value="" id="current_answer_id" hidden>
            <div class="texts-container chats" id="chats">
                <p class="chose_contact">{{trans('global.chose_contact')}}</p>


            </div>
            <div class="text-reply">
                <div class="reply-content">
                    @foreach($questions as $question)
                        <input type="hidden" name="chat_id" id="chat_id">

                        <div>
                            <h2>
                                {{$question->question_title}}
                            </h2>

                            <button class="btn_send" onclick="send_question(this)" data-question_id="{{$question->id}}"
                                    data-url="{{ route('chat.send_question_chat') }}"> أرسل
                            </button>
                        </div>
                    @endforeach
                </div>
                <div class="reply-buttons">
                    <button onclick="showAlert('question')">أضف سؤال مخصص</button>
                    <button onclick="showAlert('notification')">حدد سؤال</button>
                </div>
            </div>
        </div>
        <div class="messages-profile-area">
            <div class="user bg-white shadow-none align-items-center px-0 h-auto" id="other_person">

            </div>
        </div>
    </div>

@endsection

@section('script')

    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            setUsersLink();



            // setInterval(getMessages, 10000);
            // setInterval(function () {
            //     var user_name = $('#search_user').val();
            //     if (user_name !== '') {
            //         searchUser();
            //     } else {
            //         setUsersLink();
            //     }
            // }, 1000);
        });

        $(document).on('keyup', '#search', function () {
            let search = $(this).val();
            $.ajax({
                type: "post",
                url: "{{route('chat.searchMessages')}}",
                data: {'search': search},
                dataType: "json",
                success: function (response) {
                    $('#users-links-chat').html('')
                    var user_id = {{auth()->user()->id}};
                    // console.log(response.chat)
                    var un_seen = '';
                    $.each(response.chat, function (key, value) {
                        un_seen = `<span class="float-right primary"><span class="badge badge-pill text-secondary  badge-danger"> ${value.last_message_time} </span>` +
                            `</span>`;
                        // }
                        var user_link = '';
                        if (value.sender_id === user_id) {
                            user_link =
                                ' <a href="javascript:void(0)"  class="media border-0 show_messages" data-chat-id="' + value.id + '" >' +
                                ' <div class="media-left pr-1">' +
                                '<span class="avatar avatar-md avatar-busy">' +
                                '<img class="media-object rounded-circle" src=" ' + value.receiver.photo + ' " alt="Generic placeholder image">' +
                                '<i></i>' +
                                ' </span>' +
                                '  </div>' +
                                ' <div class="media-body w-100">' +
                                '<h6 class="list-group-item-heading">' +
                                value.receiver.first_name
                                + '<span class="font-small-3 float-right info">' +
                                '</span>' +
                                '</h6>' +
                                '<p class="list-group-item-text text-muted mb-0">' +
                                ' <i class="ft-check primary font-small-2"></i>' +
                                value.last_message +

                                un_seen +
                                ' </p>' +
                                '</div>' +
                                '</a>';
                            // user_link = ' <a href="javascript:void(0)" class="d-block show_messages" data-chat-id="' + value.id + '" > ' + value.receiver.name + '</a>';
                        } else if (value.received_id === user_id) {
                            user_link =
                                ' <a href="javascript:void(0)"  class="media border-0 show_messages" data-chat-id="' + value.id + '" >' +
                                ' <div class="media-left pr-1">' +
                                '<span class="avatar avatar-md avatar-busy">' +
                                '<img class="media-object rounded-circle" src="{{asset('assets/man.png')}}"  alt="Generic placeholder image">' +
                                '<i></i>' +
                                ' </span>' +
                                '  </div>' +
                                ' <div class="media-body w-100">' +
                                '<h6 class="list-group-item-heading">' +
                                value.sender.first_name
                                +
                                '</h6>' +
                                '<p class="list-group-item-text text-muted mb-0">' +
                                ' <i class="ft-check primary font-small-2"></i>' +
                                value.last_message +
                                '<span class="float-right primary">' +
                                un_seen +
                                '  </span>' +
                                ' </p>' +
                                '</div>' +
                                '</a>';
                            // user_link = ' <a href="javascript:void(0)" class="d-block show_messages" data-chat-id="' + value.id + '" > ' + value.sender.name + '</a>';
                        }
                        // var data = value.conversation[value.conversation.length -1 ].message;
                        $("#users-links-chat").append(user_link);
                    });
                },
                error: function (response) {
                }
            });
        });

        function setUsersLink() {
            $.ajax({
                type: "GET",
                url: "{{route('chat.getMessages')}}",
                dataType: "json",
                success: function (response) {
                    $('#users-links-chat').html('')
                    var user_id = {{auth()->user()->id}};
                    // console.log(response.chat)
                    var un_seen = '';
                    $.each(response.chat, function (key, value) {
                        un_seen = `<span class="float-right primary"><span class="badge badge-pill text-secondary  badge-danger"> ${value.last_message_time} </span>` +
                            `</span>`;
                        // }
                        var user_link = '';
                        if (value.sender_id === user_id) {
                            user_link =
                            ' <a href="javascript:void(0)"  class="media border-0 show_messages" data-chat-id="' + value.id + '" >' +
                                ' <div class="media-left pr-1">' +
                                '<span class="avatar avatar-md avatar-busy">' +
                                '<img class="media-object rounded-circle" src=" ' + value.receiver.photo + ' " alt="Generic placeholder image">' +
                                '<i></i>' +
                                ' </span>' +
                                '  </div>' +
                                ' <div class="media-body w-100">' +
                                '<h6 class="list-group-item-heading">' +
                                value.receiver.fake_name
                                + '<span class="font-small-3 float-right info">' +
                                '</span>' +
                                '</h6>' +
                                '<p class="list-group-item-text text-muted mb-0">' +
                                ' <i class="ft-check primary font-small-2"></i>' +
                                value.last_message +

                                un_seen +
                                ' </p>' +
                                '</div>' +
                                '</a>';
                            // user_link = ' <a href="javascript:void(0)" class="d-block show_messages" data-chat-id="' + value.id + '" > ' + value.receiver.name + '</a>';
                        } else if (value.received_id === user_id) {
                            user_link =
                                ' <a href="javascript:void(0)"  class="media border-0 show_messages" data-chat-id="' + value.id + '" >' +
                                ' <div class="media-left pr-1">' +
                                '<span class="avatar avatar-md avatar-busy">' +
                                '<img class="media-object rounded-circle" src="{{asset('assets/man.png')}}"  alt="Generic placeholder image">' +
                                '<i></i>' +
                                ' </span>' +
                                '  </div>' +
                                ' <div class="media-body w-100">' +
                                '<h6 class="list-group-item-heading">' +
                                value.sender.fake_name
                                +
                                '</h6>' +
                                '<p class="list-group-item-text text-muted mb-0">' +
                                ' <i class="ft-check primary font-small-2"></i>' +
                                value.last_message +
                                '<span class="float-right primary">' +
                                un_seen +
                                '  </span>' +
                                ' </p>' +
                                '</div>' +
                                '</a>';
                            // user_link = ' <a href="javascript:void(0)" class="d-block show_messages" data-chat-id="' + value.id + '" > ' + value.sender.name + '</a>';
                        }
                        // var data = value.conversation[value.conversation.length -1 ].message;
                        $("#users-links-chat").append(user_link);
                    });
                },
                error: function (response) {
                }
            });
        }

        var chat_id = 0;
        var user_id = {{auth()->user()->id}};

        function getMessages() {
            if (chat_id != 0)
                $.get("{{route('chat.getChatMessage')}}/" + chat_id, function (response) {
                    // console.table(response)
                    $('#chats').html('');
                    var message = '';
                    var question = '';
                    var answer = '';

                    if (response.messages.length == 0) {
                        message = ' <div class="text-send" id="welcome_message">' +
                            '<div>' +
                            '<h2> ' + "اهلا بك عزيزي" + '</h2>';
                        $('#chats').append(message);
                    }

                    appendOtherUserCard(response.other_user),
                        $.each(response.messages, function (key, value) {
                            console.log(value)

                            const fixed_text_question = "عذرا هذا السؤال قيد التدقيق";

                            if (value.question.status == 0) {
                                question = '<p>' + fixed_text_question + '</p>';
                            } else {
                                question = '<p>' + value.question.question_title + '</p>';
                            }

                            if (user_id !== value.received_id) {
                                var answer_id = `answer_conversation${value.id}`;
                            } else {
                                var answer_id = `answer_conversation${value.id}{{auth()->user()->id}}`;
                            }

                            const no_answer = "لم يتم الإجابة بعد";
                            const no_accept_answer = "هذه الاجابة قيد التدقيق من قبل الإدارة";
                            if (value.answer) {

                                if (value.answer.status == 1) {
                                    answer = `<p id="${answer_id}">  ${value.answer.answer_title}  </p>`;
                                } else {
                                    answer = `<p id="${answer_id}">  ${no_accept_answer}  </p>`;
                                }
                            } else {
                                answer = `<p id="${answer_id}">  ${no_answer}  </p>`;
                            }

                            if (user_id === value.received_id) {
                                message = '<div class="text-recieve">' +
                                    '<div>' +
                                    '<h2>' + question + '</h2>' +
                                    '</div> <div>' +
                                    '<img class="plus-img alertAnswerSelect" onclick="alertAnswerSelect(this)" src="{{asset('assets/site/images/plus.png')}}" alt=""   data-question-id="' + value.question.id + '"  /> ' +
                                    '<h2>' + answer + '</h2>' +
                                    '</div>' +
                                    '<img class="link-recieve-img" src="{{asset('assets/site/images/link-recieve.png')}}" alt=""/>' +
                                    '</div>';
                            } else {
                                message = ' <div class="text-send">' +
                                    '<div>' +
                                    '<h2> ' + question + '</h2>' +
                                    '</div> <div>' +
                                    '<h2>' + answer + '</h2>' +
                                    ' </div>' +
                                    '<img class="link-send-img" src="{{asset('assets/site/images/link-send.png')}}" alt=""/>'
                                    + '</div>';
                            }
                            $('#chats').append(message);
                        });
                });
        }


        $(document).on('click', '.show_messages', function (e) {
            e.preventDefault();
            var item = $(this);
            chat_id = item.data('chat-id');
            $('#chat_id').val(chat_id);
            getMessages();
            $('#chat-app-form').show();
        });

        function alertAnswerSelect(event) {
            var question_id = $(event).data('question-id');
            $("#current_answer_id").val('');
            $("#current_question_id").val(question_id);
            document.getElementById('answerSelect').classList.remove('hidden');
        }

        function choiceAnswer(event) {
            var answer_id = $(event).data('answer-id');
            $("#current_answer_id").val(answer_id);
        }

        function SendAnswer() {
            var answer_id = $("#current_answer_id").val();
            var question_id = $("#current_question_id").val();
            var chat_id = $("#chat_id").val();
            var token = '{{csrf_token()}}';

            $.ajax({
                url: '{{ route('chat.send_answer_chat') }}',
                type: 'get',
                data: {
                    '_token': token,
                    'question_id': question_id,
                    'answer_id': answer_id,
                    'chat_id': chat_id,
                },
                success: function (response) {
                    if (response.status == true) {
                        $("#current_answer_id").val('');
                        document.getElementById('answerSelect').classList.add('hidden');
                        document.getElementById(`answer_conversation${response.conversation_id}{{auth()->user()->id}}`).innerHTML = response.answer_title;
                        sendNotification(response.msg);
                    } else {
                        sendNotification(response.msg);
                    }
                }
            });
        }
        function SendCustomAnswer() {
            var question_id = $("#current_question_id").val();
            var chat_id = $("#chat_id").val();
            var answer_title_ar = $("#answer_title_ar").val();
            var token = '{{csrf_token()}}';
            $.ajax({
                url: '{{ route('chat.send_custom_answer_chat') }}',
                type: 'get',
                data: {
                    '_token': token,
                    'question_id': question_id,
                    'chat_id': chat_id,
                    'answer_title_ar': answer_title_ar,
                },
                success: function (response) {
                    const fixed_text = "هذه الاجابة قيد التدقيق من قبل الإدارة";
                    if (response.status == true) {
                        $("#current_answer_id").val('');
                        document.getElementById('answerSelect').classList.add('hidden');
                        document.getElementById(`answer_conversation${response.conversation_id}{{auth()->user()->id}}`).innerHTML = fixed_text;
                        sendNotification(response.msg);
                    } else {
                        sendNotification(response.msg);
                    }
                }
            });
        }

        function SendCustomQuestion() {
            var token = '{{csrf_token()}}';
            var question_title_ar = $("#question_title_ar").val();

            var chat_id = $('#chat_id').val();
            $.ajax({
                url: '{{ route('chat.send_custom_question_chat') }}',
                type: 'get',
                data: {
                    '_token': token,
                    'question_title_ar': question_title_ar,
                    'chat_id': chat_id
                },
                success: function (response) {
                    if (response.status == true) {
                        const random_string = Math.random().toString(36).substring(2, 7);
                        const fixed_text_question = " هذا السؤال قيد التدقيق الان";

                        message = ` <div class="text-send  question_id${random_string}">` +
                            `<div>` +
                            `<h2> ${fixed_text_question} </h2>` +
                            `</div> <div>` +
                            `<h2>  لم يتم الرد </h2>` +
                            `</div>` +
                            `<img class="link-send-img" src="{{asset('assets/site/images/link-send.png')}}" alt=""/>`
                            + `</div>`;

                        $("#chats").last().append(message);
                        scroll_to_question(random_string);
                        sendNotification(response.msg);
                    } else {
                        sendNotification(response.msg);
                    }
                }
            });
        }

        function appendOtherUserCard(response) {
            $("#other_person").html("");
            url_ = "{{route('personally',':user_id')}}";
            url_ = url_.replace(':user_id', response.id);
            card = ` <div class="user-profile d-flex flex-column align-items-center">` +
                `  <div class="img-border">` +
                `   <img src="${response.photo}" alt=""/>` +
                `</div>` +
                `<div>` +
                `<h1>` + response.fake_name + `</h1>` +
                `</div>` +
                `</div>` +

                `<div class="user-details">` +
                `<img src="{{asset('assets/site/images/global.png')}}" alt=""/>` +
                `<h2> ${response.country.title}</h2>` +
                `<img src="{{asset('assets/site/images/calendar.png')}}" alt=""/>` +
                `<h2>25 عام</h2>` +
                `<img src="{{asset('assets/site/images/location.png')}}" alt=""/>` +
                `<h2> ${response.city.title}</h2>` +
                `</div>` +
                `<a href="${url_}">  <button class="px-5">عرض الملف الشخصي</button></a>` +
                `<a href=""><h1 style="color: #FF7171;">@if(auth()->user()->getType() == "FollowMediator") انت الأن تتحدث بنيابة عن {{auth()->user()->first_name}} @endif</h1></a>`;


            $("#other_person").append(card);
        }

        function send_question(event) {
            var token = '{{csrf_token()}}';
            var question_id = $(event).data('question_id');
            var chat_id = $('#chat_id').val();
            var url = $(event).data('url');
            $.ajax({
                url: url,
                type: 'get',
                data: {
                    '_token': token,
                    'question_id': question_id,
                    'chat_id': chat_id
                },
                success: function (response) {
                    if (response.status == true) {
                        const random_string = Math.random().toString(36).substring(2, 7);


                        message = ` <div class="text-send  question_id${random_string}">` +
                            `<div>` +
                            `<h2> ${response.question_title} </h2>` +
                            `</div> <div>` +
                            `<h2>  لم يتم الرد </h2>` +
                            `</div>` +
                            `<img class="link-send-img" src="{{asset('assets/site/images/link-send.png')}}" alt=""/>`
                            + `</div>`;

                        $("#chats").last().append(message);
                        scroll_to_question(random_string);
                        sendNotification(response.msg);
                    } else {
                        sendNotification(response.msg);
                    }
                }
            });
        }

        function scroll_to_question(random_string) {
            $('.chats').animate({
                scrollTop: $(".question_id" + random_string).offset().top
            }, 2000);
        }

        function sendNotification(msg) {

            $(document).ready(function () {
                toastr.options.timeOut = 1500; // 1.5s
                toastr.info(msg);
                $('#linkButton').click(function () {
                    toastr.success('Click Button');
                });
            });
        }

    </script>


@endsection
