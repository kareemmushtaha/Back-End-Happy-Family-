<!DOCTYPE html>

<html direction="rtl" dir="rtl" style="direction: rtl">

<!--begin::Head-->
@include('includesMediator.head')
<!--end::Head-->


<!--begin::Body-->
<body id="kt_body"
      class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed toolbar-tablet-and-mobile-fixed aside-enabled aside-fixed"
      style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
<!--begin::Main-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="page d-flex flex-row flex-column-fluid">
        <!--begin::Aside-->
    @include('includesMediator.sidebar')
    <!--end::Aside-->
        <!--begin::Wrapper-->
        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
            <!--begin::Header-->
        @include('includesMediator.header')
        <!--end::Header-->
            <!--begin::Content-->
            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                <!--begin::Toolbar-->
            @include('includesMediator.toolbar')
            <!--end::Toolbar-->
                @yield('content')
            </div>
            <!--end::Content-->
            <!--begin::Footer-->
        @include('includesMediator.footer')
        <!--end::Footer-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>

<script src="{{ asset('assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js')}}"></script>
<script src="{{ asset('assets/js/custom/modals/create-account.js')}}"></script>

<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script src="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.js')}}"></script>

<script src="{{ asset('assets/js/custom/documentation/general/datatables/basic.js')}}"></script>
<script src="{{ asset('assets/js/custom/documentation/documentation.js')}}"></script>

<script src="{{ asset('assets/js/custom/apps/customers/list/export.js')}}"></script>
<script src="{{ asset('assets/js/custom/apps/customers/list/list.js')}}"></script>
<script src="{{ asset('assets/js/custom/apps/customers/add.js')}}"></script>
<script src="{{ asset('assets/js/custom/apps/chat/chat.js')}}"></script>
<script src="{{ asset('assets/js/custom/modals/create-app.js')}}"></script>
<script src="{{ asset('assets/js/custom/modals/upgrade-plan.js')}}"></script>
<script src="{{ asset('assets/js/jquery.multi-select.js')}}"></script>
<script src="{{ asset('assets/js/custom/widgets.js')}}"></script>
<script src="{{ asset('assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
<script src="{{ asset('assets/js/custom/utilities/modals/create-app.js')}}"></script>
<script src="{{ asset('assets/js/custom/utilities/modals/new-target.js')}}"></script>
<script src="{{ asset('assets/js/custom/utilities/modals/users-search.js')}}"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>


<script>
    function Confirm_Delete(event) {

        var token = '{{csrf_token()}}';
        var url = $(event).data('url');
        var tr = $(event).parent();
        Swal.fire({
            title: "{{trans('global.areYouSure')}}",
            text: "❗❗",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "{{trans('global.yes')}}",
            cancelButtonText: "{{trans('global.no')}} {{trans('global.cancel')}}",
            reverseButtons: true
        }).then(function (result) {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        '_token': token,
                        '_method': 'DELETE'
                    },
                    success: function (response) {
                        if (response.status) {
                            Swal.fire(
                                response.msg,
                                "--",
                                "success"
                            )
                            tr.parent().remove();
                        } else {
                            Swal.fire(response.msg, "...", "error");
                        }
                    }
                });
            } else {
                Swal.fire(
                    response.msg,
                    "{{trans('global.undone')}}",
                    "error"
                )
            }
        });
    }

    function Change_Status(event) {
        var token = '{{csrf_token()}}';
        var url = $(event).data('url');
        var id = $(event).data('id');
        var tr = $(event).parent();
        $.ajax({
            url: url,
            type: 'get',
            data: {
                '_token': token,
                'id': id
            },
            success: function (response) {
                if (response.status == true) {

                    Swal.fire({
                        title: response.msg,
                        text: "{{trans('global.update_success')}}",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "{{trans('global.confirmation')}}",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                    $('.StatusRow' + response.id).text(response.active);

                    //  location.reload();
                } else {
                    Swal.fire("{{trans('global.sorry_some_error')}}", response.msg, "error");

                }
            }
        });
    }
</script>
@yield('script')

</body>
</html>
