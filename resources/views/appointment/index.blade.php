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
            <div class="row mb-3 pb-3 border-bottom-light">
                <div class="col-lg-12">
                    <div class="float-left">
                        <form action="" class="form-inline">
                            <div class="form-group form-group-lg">
                                <input class="form-control input-sm" id="inputsm" type="text">
                                <a><i style='font-size:24px' class='fas'>&#xf002;</i></a>
                            </div>
                        </form>
                    </div>
                    <div class="float-right ">
                        <a href="{{ route('appointments.create') }}" class="btn btn-primary btn-rounded">
                            <i class="fas fa-plus mr-2"></i>
                            @lang('vn.Add Appointment')
                        </a>
                    </div>
                </div>
            </div>

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
                                    <a href="{{ route('repairs.create', ['user' => $appointment->user_id]) }}"
                                       class="btn btn-icon"
                                       title="Sửa chữa" data-toggle="tooltip" data-placement="top">
                                        <i class="fab fa-accusoft"></i>
                                    </a><a href="{{ route('appointments.edit', $appointment) }}" class="btn btn-icon"
                                           title="Cập nhật đặt lịch" data-toggle="tooltip" data-placement="top">
                                        <i class="fas fa-edit"></i>
                                    </a>
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
