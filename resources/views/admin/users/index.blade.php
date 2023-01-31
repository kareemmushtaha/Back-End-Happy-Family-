@extends('layouts.main')
@section('content')
    @include('admin.users.create')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container">
            <div class="card mb-5 mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                <span
                    class="card-label fw-bold fs-3 mb-1">{{ trans('global.view') }} {{ trans('cruds.user.title') }}</span>
                    </h3>
                    <div class="card-toolbar">
                            <a href=" " class="btn btn-sm btn-light-primary" data-bs-toggle="modal"
                               data-bs-target="#kt_modal_new_target">
                                <span class="svg-icon svg-icon-2 bi-bag-plus"></span>
                                {{ trans('global.add') }} {{ trans('cruds.user.admin') }}</a>

                        <a href="/register" class="btn btn-sm btn-light-primary" style="margin: 15px"
                           data-bs-target="#kt_modal_new_target">
                            <span class="svg-icon svg-icon-2 bi-bag-plus"></span>
                            {{ trans('global.add') }} {{ trans('global.add_mediator') }}</a>
                    </div>

                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body py-3">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                            <!--begin::Table head-->
                            <thead>
                            <tr class="fw-bold text-muted">
                                <th class="w-25px">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    </div>
                                </th>
                                <th class="min-w-150px"> {{ trans('cruds.user.fields.id') }}</th>
                                <th class="min-w-140px">    {{ trans('cruds.user.fields.name') }}</th>
                                <th class="min-w-120px"> {{ trans('cruds.user.fields.email') }}</th>
                                <th class="min-w-120px">{{ trans('cruds.user.fields.verified') }}</th>
                                <th class="min-w-100px "> {{ trans('cruds.user.fields.roles') }}</th>
                                <th class="min-w-100px "> {{ trans('cruds.user.fields.status') }}</th>
                                <th class="min-w-100px text-end"> {{ trans('global.actions') }}</th>
                            </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                            @foreach ($users  as $key => $user)
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="text-dark fw-bold text-hover-primary fs-6">#{{ $key+1 }}</a>
                                    </td>
                                    <td>
                                        <a href="#"
                                           class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ $user->first_name ?? '' }}</a>
                                        <span
                                            class="text-muted fw-semibold text-muted d-block fs-7">{{ $user->last_name ?? ''}}</span>
                                    </td>
                                    <td>
                                        <a href="#"
                                           class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ $user->email ?? '' }}</a>
                                        <span
                                            class="text-muted fw-semibold text-muted d-block fs-7">{{ $user->email_verified_at ? 'verified at' :'not verified at' }}</span>
                                    </td>
                                    <td>
                                <span
                                    class="badge badge-light-success">  {{ $user->verified ? 'مؤكد' : 'غير مؤكد' }} </span>
                                    </td>
                                    <td>

                                        <span class="badge badge-light-success">  {{  $user->getTypeAr()  }} </span>

                                    </td>
                                    <td>

                                        <button id="btn_un_active_{{$user->id}}"
                                                class="btn btn-success @if($user->check_active == 0) d-none @endif check_active btn-sm"
                                                data-check_active="{{$user->check_active}}"
                                                data-user_id="{{$user->id}}">
                                            {{trans('global.cancel_active')}}
                                        </button>
                                        <button id="btn_active_{{$user->id}}"
                                                class="btn btn-danger @if($user->check_active == 1) d-none @endif check_active btn-sm"
                                                data-check_active="{{$user->check_active}}"
                                                data-user_id="{{$user->id}}">
                                            {{trans('global.make_active')}}
                                        </button>


                                    </td>
                                    <td class="text-end">
                                        @can('user_show')
                                            <a href="{{ route('admin.users.show', $user->id) }}"
                                               class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                                                @include('partials.icons.show')
                                            </a>
                                        @endcan

                                        @can('user_edit')
                                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                               class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                @include('partials.icons.edit')
                                            </a>
                                        @endcan

                                        @can('user_delete')
                                            <button category_id_attr="{{$user->id}}"
                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm"
                                                    onclick="Confirm_Delete(this)"
                                                    data-url="{{ route('admin.users.destroy', $user->id) }}">
                                                @include('partials.icons.delete')
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Table container-->
                </div>
                <!--begin::Body-->
            </div>
        </div>
    </div>
    <!--end::Tables Widget 13-->

@endsection



@section('script')

    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $(document).on('click', '#btn_save_user', function (e) {
            $('#btn_save_user').html('{{trans('global.save')}} <i class="fa fa-spinner fa-spin"></i>');
            e.preventDefault();
            $('.errors').text('');
            var formData = new FormData($('#formSaveUser')[0]); //get all data in form
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{ route("admin.users.store") }}",
                data: formData, // send this data to controller
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    $('#btn_save_user').html('save');
                    if (data.status == true) {

                        document.getElementById("formSaveUser").reset();
                        setTimeout(function () {
                            var url = "{{ route('admin.users.index') }}"; //the url I want to redirect to
                            $(location).attr('href', url);
                        }, 0);

                    } else {
                        Swal.fire("{{trans('global.sorry_some_error')}}", "{{trans('global.sorry_some_error')}}", "error");
                    }
                }, error: function (reject) {
                    $('#btn_save_user').html("save");

                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function (key, val) {
                        // for loop to all validation and show all validate
                        $("#" + key + "_error").text(val[0]);
                    });
                }
            });
        });

        $(document).on('click', '.check_active', function (e) {
            e.preventDefault();
            let check_active = $(this).data('check_active');
            let user_id = $(this).data('user_id');
            var formData = new FormData($('#formSaveUser')[0]); //get all data in form
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{ route("admin.users.changeStatus") }}",
                data: {'check_active': check_active, 'user_id': user_id}, // send this data to controller
                dataType: 'json',
                success: function (data) {
                    if (data.status == true) {
                        if (data.check_active == 0) {
                            $('#btn_active_' + user_id).addClass('display');
                            $('#btn_active_' + user_id).removeClass('d-none');
                            $('#btn_un_active_' + user_id).addClass('d-none');
                            $('#btn_active_' + user_id).attr('data-check_active', data.check_active);
                            $('#btn_un_active_' + user_id).attr('data-check_active', data.check_active);
                        } else if (data.check_active == 1) {
                            $('#btn_un_active_' + user_id).addClass('display');
                            $('#btn_un_active_' + user_id).removeClass('d-none');
                            $('#btn_active_' + user_id).addClass('d-none');
                            $('#btn_active_' + user_id).attr('data-check_active', data.check_active);
                            $('#btn_un_active_' + user_id).attr('data-check_active', data.check_active);
                        }
                        toastr.success(data.msg)
                    }
                },
            });
        });
    </script>

@endsection


