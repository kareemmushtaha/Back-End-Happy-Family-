@extends('SitePartials.main')
@section('content')

    <div class="body">
        <div class="section profile-container">
            @if(\Illuminate\Support\Facades\Auth::check())
                @include('SitePartials.profile-card')
            @endif

            @include('SitePartials.advice-card')

        </div>
        <div class="d-flex flex-column gap-5 main">
            @include('SitePartials.welcome-component')
            <div class="section users-container">
                @include('SitePartials.form-search')
                <div class="users-area">
                    <div id="user_card_paginate">
                        @include('site._userCardPaginate')
                    </div>
                </div><!-- end users -->

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

                let data = {
                    page: page,
                    paginate: paginate,

                }
                $.ajax(
                    {
                        url: '{{route('home')}}',
                        data: data,
                        type: "get",
                        datatype: "html"
                    }).done(function(data){
                    $("#user_card_paginate").empty().html(data);
                    location.hash = page;
                }).fail(function(jqXHR, ajaxOptions, thrownError){
                    alert('No response from server');
                });
            }

            $(document).on('change', '#country', function (e) {
                e.preventDefault();

                let country_id = $(this).val();
                $.ajax({
                    type: 'post',
                    enctype: 'multipart/form-data',
                    url: "{{ route("filterAreas") }}",
                    data: {'country_id': country_id}, // send this data to controller
                    dataType: 'json',

                    success: function (data) {
                        $('select[name="area"]').empty();
                        $('select[name="area"]').append('<option value="">المنطقه</option>');
                        $.each(data.areas, function (key, value) {

                            $('select[name="area"]').append(`<option value="${value.id}">${value.title}</option>`);
                        });

                    }
                });
            });

            $(document).on('change', '#area', function (e) {
                e.preventDefault();

                let area_id = $(this).val();
                $.ajax({
                    type: 'post',
                    enctype: 'multipart/form-data',
                    url: "{{ route("filterCities") }}",
                    data: {'area_id': area_id}, // send this data to controller
                    dataType: 'json',

                    success: function (data) {
                        $('select[name="city"]').empty();
                        $('select[name="city"]').append('<option value="">المدينة</option>');
                        $.each(data.cities, function (key, value) {

                            $('select[name="city"]').append(`<option value="${value.id}">${value.title}</option>`);
                        });

                    }
                });
            });

            $(document).on('click', '#send_data_search', function (e) {
                e.preventDefault();
                var formData = new FormData($('#searchForm')[0]); //get all data in form
                $.ajax({
                    type: 'post',
                    enctype: 'multipart/form-data',
                    url: "{{ route("homeSearch") }}",
                    data: formData, // send this data to controller
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function (data) {
                        $("#user_card_paginate").empty().html(data);

                    }
                });
            });
        });
    </script>
@endsection
