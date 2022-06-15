@extends('layouts.app')

@section('page-title', __('vn.Appointment'))
@section('page-heading', __('vn.Appointment'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('vn.Appointment')
    </li>
@stop

@section('content')

    @include('partials.messages')

    <div class="card">
        <div class="card-body">
            <form action="" method="GET" id="users-form" class="pb-2 mb-3 border-bottom-light">
                <div class="row my-3 flex-md-row flex-column-reverse">
                    <div class="col-md-3 mt-md-0 mt-2">
                        <div class="input-group custom-search-form">
                            <input type="text"
                                   class="form-control input-solid"
                                   name="search"
                                   value="{{ Request::get('search') }}"
                                   placeholder="@lang('Tìm theo tên khách hàng')">

                            <span class="input-group-append">
                                @if (Request::has('search') && Request::get('search') != '')
                                    <a href="{{ route('appointments.index') }}"
                                       class="btn btn-light d-flex align-items-center text-muted"
                                       role="button">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="col-md-2 mt-md-0 mt-2">
                        <div class="input-group custom-search-form">
                            <input type="date"
                                   class="form-control input-solid"
                                   name="start_date"
                                   value="{{ Request::get('start_date') }}"
                                   placeholder="@lang('Search for users...')">
                        </div>
                    </div>
                    <div class="col-md-2 mt-md-0 mt-2">
                        <div class="input-group custom-search-form">
                            <input type="date"
                                   class="form-control input-solid"
                                   name="end_date"
                                   value="{{ Request::get('end_date') }}">
                        </div>
                    </div>
                    <div class="col-md-5 text-right">
                        <a href="{{ route('appointments.create') }}" class="btn btn-primary btn-rounded">
                            <i class="fas fa-plus mr-2"></i>
                            @lang('vn.Add Appointment')
                        </a>
                    </div>
                </div>
            </form>


            <div class="table-responsive" id="users-table-wrapper">
                <table class="table table-striped table-borderless">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th class="min-width-100">@lang('vn.Customer')</th>
                        <th class="min-width-150">@lang('vn.Time')</th>
                        <th class="min-width-150">@lang('vn.Status')</th>
                        <th class="text-center">@lang('vn.Action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($appointments))
                        @foreach ($appointments as $key => $appointment)
                            <tr>
                                <td>{{$key}}</td>
                                <td>{{ $appointment->user->fullname }}</td>
                                <td>{{$appointment->date_time}}</td>
                                <td>{!! $appointment->statuss !!}</td>
                                <td class="text-center">
                                    <a href="{{ route('repairs.create', ['user' => $appointment->user_id,'appointment' => $appointment->id]) }}"
                                       class="btn btn-icon"
                                       title="Sửa chữa" data-toggle="tooltip" data-placement="top">
                                        <i class="fab fa-accusoft"></i>
                                    </a><a href="{{ route('appointments.edit', $appointment) }}" class="btn btn-icon"
                                           title="Cập nhật đặt lịch" data-toggle="tooltip" data-placement="top">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @permission('admin')
                                    <a href="{{ route('appointments.destroy', $appointment) }}" class="btn btn-icon"
                                       title="@lang('vn.Delete Appointment')"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       data-method="DELETE"
                                       data-confirm-title="@lang('vn.Please Confirm')"
                                       data-confirm-text="@lang('vn.Are you sure that you want to delete this appointment?')"
                                       data-confirm-delete="@lang('vn.Yes, delete it!')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    @endpermission
                                </td>
                            </tr>
                        @endforeach

                    @else
                        <tr>
                            <td colspan="4"><em>@lang('vn.No records found.')</em></td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-muted text-right">
            {!! $appointments->links() !!}
        </div>
    </div>
@stop
