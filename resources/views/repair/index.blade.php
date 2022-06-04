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
            <form action="" method="GET" id="users-form" class="pb-2 mb-3 border-bottom-light">
                <div class="row my-3 flex-md-row flex-column-reverse">
                    <div class="col-md-3 mt-md-0 mt-2">
                        <div class="input-group custom-search-form">
                            <input type="text"
                                   class="form-control input-solid"
                                   name="search"
                                   value="{{ Request::get('search') }}"
                                   placeholder="@lang('Biển số xe hoặc khách hàng')">

                            <span class="input-group-append">
                                @if (Request::has('search') && Request::get('search') != '')
                                    <a href="{{ route('repairs.index') }}"
                                       class="btn btn-light d-flex align-items-center text-muted"
                                       role="button">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="col-md-3 mt-md-0 mt-2"></div>
                    <div class="col-md-6 mt-md-0 mt-2 text-right">
                        <a href="{{ route('repairs.create') }}" class="btn btn-primary btn-rounded">
                            <i class="fas fa-plus mr-2"></i>
                            @lang('vn.Add Repair')
                        </a></div>
                </div>
            </form>
            <div class="table-responsive-sm" id="users-table-wrapper">
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
                                       title="@lang('Hoá đơn')" data-toggle="tooltip" data-placement="top">
                                        <i class="fa fa-book"></i>
                                    </a>
                                    @permission('admin')
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
    </div>
@stop
