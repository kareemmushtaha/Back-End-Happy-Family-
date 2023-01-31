@extends('layoutsMediator.main')
@section('content')

    <div>
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Card-->
                <div class="card card-custom example example-compact">
                    <div class="card-header">
                        <h3 class="card-title">{{ trans('global.view') }} {{ trans('cruds.user.title_singular') ." ".  $user->first_name }}  </h3>
                        <div class="card-toolbar">
                            <div class="example-tools justify-content-center">
                            <span class="example-toggle" data-toggle="tooltip" title=""
                                  data-original-title="View code"></span>
                            </div>
                        </div>
                    </div>

                    <div class="card-body py-3">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="kt_table_widget_5_tab_1">
                                <!--begin::Table container-->
                                <div class="table-responsive">
                                    <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4">
                                        <tbody>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.user.fields.id') }}
                                            </th>
                                            <td>
                                                {{ $user->id }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ trans('cruds.user.fields.photo') }}
                                            </th>
                                            <td>
                                                <img src="{{$user->getPhoto($user->photo)}}" style="border-radius: 50%" width="80" height="80">
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ trans('cruds.user.fields.name') }}
                                            </th>
                                            <td>
                                                {{ $user->first_name }} {{$user->last_name}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.user.fields.email') }}
                                            </th>
                                            <td>
                                                {{ $user->email }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.user.fields.fake_name') }}
                                            </th>
                                            <td>
                                                {{ $user->fake_name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.user.fields.birth_date') }}
                                            </th>
                                            <td>
                                                {{ $user->birth_date }}
                                            </td>
                                        </tr>   <tr>
                                            <th>
                                                {{ trans('cruds.user.fields.gender') }}
                                            </th>
                                            <td>
                                                {{ $user->gender }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.user.fields.nationality') }}
                                            </th>
                                            <td>
                                                {{ $user->nationality }}
                                            </td>
                                        </tr>   <tr>
                                            <th>
                                                {{ trans('cruds.user.fields.phone') }}
                                            </th>
                                            <td>
                                                {{ $user->phone }}
                                            </td>
                                        </tr>   <tr>
                                            <th>
                                                {{ trans('cruds.user.fields.country_id') }}
                                            </th>
                                            <td>
                                                {{ $user->country->title }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.user.fields.aria_id') }}
                                            </th>
                                            <td>
                                                {{ $user->aria->title }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.user.fields.city_id') }}
                                            </th>
                                            <td>
                                                {{ $user->city->title }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ trans('cruds.user.fields.height') }}
                                            </th>
                                            <td>
                                                {{ $user->height }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ trans('cruds.user.fields.width') }}
                                            </th>
                                            <td>
                                                {{ $user->width }}
                                            </td>
                                        </tr>



                                        <tr>
                                            <th>
                                                {{ trans('cruds.user.fields.email_verified_at') }}
                                            </th>
                                            <td>
                                                {{ $user->email_verified_at }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.user.fields.verified') }}
                                            </th>
                                            <td>
                                                <input type="checkbox"
                                                       disabled="disabled" {{ $user->verified ? 'checked' : '' }}>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.user.fields.two_factor') }}
                                            </th>
                                            <td>
                                                <input type="checkbox"
                                                       disabled="disabled" {{ $user->two_factor ? 'checked' : '' }}>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.user.fields.roles') }}
                                            </th>
                                            <td class="">
                                                @foreach($user->roles as $key => $roles)
                                                    <span class="badge badge-light-danger">{{ $roles->title }}</span>
                                                @endforeach
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="form-group">
                                        <a class="btn btn-default badge badge-light-primary" onclick="history.back();">
                                            {{ trans('global.return_back') }}
                                        </a>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    @isset($user->information_user )
                        <div class="card-body py-3 mt-8">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="kt_table_widget_5_tab_1">
                                    <h3> {{ trans('cruds.user.fields.more_information') }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body py-3">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="kt_table_widget_5_tab_1">
                                    <!--begin::Table container-->
                                    <div class="table-responsive">
                                        <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4">
                                            <tbody>
                                            <tr>
                                                <th>
                                                    {{ trans('cruds.user.fields.municipal_name') }}
                                                </th>
                                                <td>
                                                    {{json_decode( $user->information_user->data_information)->lgu_name_arabic?? '' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    {{ trans('cruds.user.fields.mem_name_arabic') }}
                                                </th>
                                                <td>
                                                    {{json_decode( $user->information_user->data_information)->mem_name_arabic?? '' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    {{ trans('cruds.user.fields.dis_name_arabic') }}
                                                </th>
                                                <td>
                                                    {{json_decode( $user->information_user->data_information)->dis_name_arabic?? '' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    {{ trans('cruds.user.fields.lgu_ArabicType') }}
                                                </th>
                                                <td>
                                                    {{json_decode( $user->information_user->data_information)->lgu_ArabicType?? '' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    {{ trans('cruds.user.fields.Category_name_arabic') }}
                                                </th>
                                                <td>
                                                    {{json_decode( $user->information_user->data_information)->Category_name_arabic?? '' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    {{ trans('cruds.user.fields.lgu_Arabic_SelWay') }}
                                                </th>
                                                <td>
                                                    {{json_decode( $user->information_user->data_information)->lgu_Arabic_SelWay?? '' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    {{ trans('cruds.user.fields.lgu_TypeofAppointment') }}
                                                </th>
                                                <td>
                                                    {{json_decode( $user->information_user->data_information)->lgu_TypeofAppointment?? '' }}
                                                </td>
                                            </tr>


                                            </tbody>
                                        </table>
                                        <div class="form-group">
                                            <a class="btn btn-default badge badge-light-primary"
                                               onclick="history.back();">
                                                {{ trans('global.return_back') }}
                                            </a>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endisset
                </div>
            </div>
        </div>
    </div>
@endsection
