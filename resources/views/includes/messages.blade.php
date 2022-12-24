@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>
                    {{$error}}
                </li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('status'))
    <div class="alert alert-success" style="margin: 50px">
        {{session('status')}}
    </div>
@endif



@if (session('danger'))
    <div class="alert alert-danger" role="alert" style="margin: 50px">
        {{session('danger')}}
    </div>
@endif

@if (session('info'))
    <div class="alert alert-info" role="alert" style="margin: 50px">
        {{session('info')}}
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

    </div>
@endif
