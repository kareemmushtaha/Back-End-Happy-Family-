@extends('SitePartials.main')
@section('content')
    <div class="full">
        <div class="section users-container">
            <div class="search-container">
                <h1>نتائج البحث</h1>
            </div><!--start users -->
            <div id="result_advance_search">
                @include('site._resultAdvanceSearchPaginate')
            </div>
        </div>
    </div><!--end body -->


@endsection
@section('script')
    <script>
        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(window).on('hashchange', function() {
                if (window.location.hash) {
                    var page = window.location.hash.replace('#', '');
                    if (page == Number.NaN || page <= 0) {
                        return false;
                    }else{
                        getData(page);
                    }
                }
            });

            $(document).ready(function()
            {
                $(document).on('click', '.pagination a',function(event)
                {
                    event.preventDefault();

                    $('li').removeClass('active');
                    $(this).parent('li').addClass('active');

                    var myurl = $(this).attr('href');
                    var page=$(this).attr('href').split('page=')[1];


                    getData(page);
                });

            });

            function getData(page){
                var paginate = $('select[name="paginate"]').val();
                let gender = '{{$gender}}';
                let country = '{{$country}}';
                let area = '{{$area}}';
                let city = '{{$city}}';
                let year_from = '{{$year_from}}';
                let year_to = '{{$year_to}}';

                let data = {
                    page: page,
                    paginate: paginate,
                    gender: gender,
                    country: country,
                    area: area,
                    city: city,
                    year_from: year_from,
                    year_to: year_to,

                };
                $.ajax(
                    {
                        url: '{{route('resultSearchLanding')}}',
                        data: data,
                        type: "post",
                        datatype: "html"
                    }).done(function(data){
                    $("#result_advance_search").empty().html(data);
                    location.hash = page;
                }).fail(function(jqXHR, ajaxOptions, thrownError){
                    alert('No response from server');
                });
            }

        });
    </script>
@endsection
