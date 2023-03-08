@component('mail::message')

    {{$data['message']}},

    Name : {{$data['name']}}.
    Email : {{$data['email']}}.
    Birth_date : {{$data['birth_date']}}.
    Gender : {{$data['gender']}}.
    Phone : {{$data['phone']}}
    Message : {{$data['message']}}

    Thanks,

@endcomponent
