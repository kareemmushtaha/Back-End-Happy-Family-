@component('mail::message')

    @if($data['type'] == 'admin')
        {{$data['message']}},

        Name : {{$data['name']}}.
        Email : {{$data['email']}}.
        Project : {{$data['project']}}.
        Step : {{$data['step']}}.
        Step Status : {{$data['step_status']}}
    @else

        Dear {{  env('MAIL_FROM_NAME') }},

        Name : {{$data['name']}}.
        Email : {{$data['email']}}.
        Project : {{$data['project']}}.
        Status Project : {{$data['status_project']}}.
    @endif



    Thanks,
    {{  env('MAIL_FROM_NAME') }}

@endcomponent

{{--$data = [--}}
{{--'email' => $request->email,--}}
{{--'message' => $request->message,--}}
{{--'receiver_name' => $receiver->fullname,--}}
{{--];--}}
