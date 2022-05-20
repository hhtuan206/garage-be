@extends('layouts.app')

@section('page-title', __('vn.Repairs'))
@section('page-heading', __('vn.Repairs'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Repairs')
    </li>
@stop

@section('content')

    @include('partials.messages')

    <div class="card">
        <div class="card-body">
            <div class="row mb-3 pb-3 border-bottom-light">
                <div class="col-lg-12">
                    <div class="float-right">
                        <a href="{{ route('repairs.create') }}" class="btn btn-primary btn-rounded">
                            <i class="fas fa-plus mr-2"></i>
                            @lang('vn.Add Repair')
                        </a>
                    </div>
                </div>
            </div>

            <div class="table-responsive" id="users-table-wrapper">
                <table class="table table-striped table-borderless">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th class="min-width-100">@lang('vn.Car')</th>
                        <th class="min-width-150">@lang('vn.Customer Name')</th>
                        <th class="min-width-150">Dịch vụ sử dụng</th>
                        <th class="min-width-150">@lang('vn.Total')</th>
                        <th class="min-width-150">@lang('vn.Repair At')</th>
                        <th class="text-center">@lang('vn.Action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($repairs))
                        @foreach ($repairs as $key => $repair)
                            <tr>
                                <td>{{$key}}</td>
                                <td>{{ $repair->car->number_plate }}</td>
                                <td>{{ $repair->user->fullname}}</td>
                                <td>
                                    @foreach($repair->services as $service)
                                        <label class="badge badge-info">{{$service->name}}</label>
                                    @endforeach
                                    </td>
                                <td>{{ number_format($repair->total_price,0)}}đ</td>
                                <td>{{ $repair->created_at }}</td>
                                <td class="text-center">
                                    <a href="{{ route('repairs.show', $repair) }}" class="btn btn-icon"
                                       title="@lang('vn.Edit Repair')" data-toggle="tooltip" data-placement="top">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('repairs.destroy', $repair) }}" class="btn btn-icon"
                                       title="@lang('vn.Delete Repair')"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       data-method="DELETE"
                                       data-confirm-title="@lang('vn.Please Confirm')"
                                       data-confirm-text="@lang('vn.Are you sure that you want to delete this history?')"
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
    </div>
@stop
