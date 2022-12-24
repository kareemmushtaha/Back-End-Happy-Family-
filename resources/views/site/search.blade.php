@extends('SitePartials.main')
@section('content')

    <div class="full">
        <div class="section users-container">
            @include('SitePartials.form-search')

            <div class="users-area">
                <div>
                    @include('SitePartials.user-card')
                </div>
            </div><!-- end users -->
            <div class="pages">
                <div>
                    <a href="">
                        <img src="{{asset('assets/site/images/vector-right.png')}}" alt=""/>
                    </a>
                </div>
                <div class="numbers">
                    <a href="">1</a>
                    <a href="" class="active-page">2</a>
                    <a href="">4</a>
                     <a>...</a>
                    <a href="">37</a>
                    <a href="">40</a>
                </div>
                <div>
                    <a href="">
                        <img src="{{asset('assets/site/images/vector-left.png')}}" alt=""/>
                    </a>
                </div>
            </div>
        </div>
    </div><!--end body -->



@endsection
