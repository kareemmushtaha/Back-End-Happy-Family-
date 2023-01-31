@extends('SitePartials.main')
@section('content')

    <div class="advanced-container">
        <div>
            <div class="personally-edit">
                <div>
                    <div class="img-border">
                        <img src="{{asset('assets/site/images/man.png')}}" alt=""/>
                    </div>
                    <div class="d-flex flex-column gap-2">
                        <h2>{{auth()->user()->first_name . ' '. auth()->user()->last_name}}</h2>
                        <h3>{{auth()->user()->fake_name}}</h3>
                    </div>
                </div>
                <a href="{{route('edit_profile')}}">تعديل الملف الشخصي</a>

                <a href="{{route('showProfile', auth()->user()->show_profile == 1 ? 0 : 1)}}">{{auth()->user()->show_profile == 1 ? 'إخفاء الملف الشخصي' : 'إظهار الملف الشخصي'}}</a>
            </div>
            <div class="personally-details">
                <div>
                    <img src="{{asset('assets/site/images/global.png')}}" alt=""/>
                    <h3>{{auth()->user()->country->title}}</h3>
                </div>
                <div>
                    <img src="{{asset('assets/site/images/location.png')}}" alt=""/>
                    <h3>{{auth()->user()->aria->title}}</h3>
                </div>
                <div>
                    <img src="{{asset('assets/site/images/location.png')}}" alt=""/>
                    <h3>{{auth()->user()->city->title}}</h3>
                </div>
                <div>
                    <img src="{{asset('assets/site/images/calendar.png')}}" alt=""/>
                    <h3>{{auth()->user()->age()}} </h3>
                </div>
            </div>
            <div class="personally-details second">
                <div>
                    <img src="{{asset('assets/site/images/male.png')}}" alt=""/>
                    <h3>{{auth()->user()->getGender()}}</h3>
                </div>
{{--                <div>--}}
{{--                    <img src="{{asset('assets/site/images/weight.png')}}" alt=""/>--}}
{{--                    <h3>السعودية</h3>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <img src="{{asset('assets/site/images/height.png')}}" alt=""/>--}}
{{--                    <h3>السعودية</h3>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
    <form id="formAnswerQuestions" class="form" action="#" method="post"
          enctype="multipart/form-data">
        @csrf
        <div class="advanced-container mt-5">
            <div class="overflow-auto">
                <h2>إجابات أسئلة الموقع</h2>
                @foreach($questions as $question)
                    <h2>
                        {{$question->question_title}}
                    </h2>
                    <div class="advanced-selects-container">
                        <div>
                            <select name="answers[]" required>
                                <option value="null"   hidden  >اختر الاجابة</option>
                                @foreach($question->answers as $answer)
                                    <option value="{{$answer->id}}"
                                            @if(getAnsweredQuestion($question->id,auth()->user()->id) ==$answer->id) selected
                                            @endif
                                            data-question_id="{{$question->id}}">{{$answer->answer_title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="advanced-bottom">
            <button type="button"
                    id="btn_answer_questions">حفظ الاجابات
            </button>
        </div>
    </form>
@endsection



@section('script')

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

    <script>


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $(document).on('click', '#btn_answer_questions', function (e) {
            $('#btn_answer_questions').html('انتظر <i class="fa fa-spinner fa-spin"></i>').addClass('link-disabled');
            e.preventDefault();
            $('.errors').text('');
            var formData = new FormData($('#formAnswerQuestions')[0]); //get all data in form
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{ route("update-answer-questions") }}",
                data: formData, // send this data to controller
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    $('#btn_answer_questions').html('حفظ الاجابات').removeClass('link-disabled');
                    if (data.status == true) {
                        setTimeout(function () {
                            var url = "{{ route('home') }}"; //the url I want to redirect to
                            $(location).attr('href', url);
                        }, 0);
                    } else {
                        Swal.fire("{{trans('global.please_checked_answers')}}", data.msg, "error");
                    }
                }, error: function (reject) {
                    $('#btn_answer_questions').html('حفظ الاجابات').removeClass('link-disabled');
                }
            });
        });

    </script>

@endsection
