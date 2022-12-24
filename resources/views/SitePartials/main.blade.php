
<!DOCTYPE html>
<html>
@include('SitePartials.header-links')
<body>


@include('SitePartials.header')
@yield('content')
@include('SitePartials.footer')

<script src="{{asset('assets/site/js/script.js')}}"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

@yield('script')



</body>
</html>



















