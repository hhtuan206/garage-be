@extends('layouts.app')

@section('page-title', __('Thống kê sửa chữa'))
@section('page-heading', __('Thống kê sửa chữa'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Thống kê sửa chữa')
    </li>
@stop

@section('content')

    @include('partials.messages')

    <div class="card">
        <div class="card-body">

            <form action="" method="GET" id="users-form" class="pb-2 mb-3 border-bottom-light">
                <div class="row my-3 flex-md-row flex-column-reverse">
                    <div class="col-md-3 mt-md-0 mt-2">
                        <label for="">Tìm theo biển số xe hoặc tên khách hàng</label>
                        <div class="input-group custom-search-form">
                            <input type="text"
                                   class="form-control input-solid"
                                   name="search"
                                   value="{{ Request::get('search') }}"
                                   placeholder="@lang('Biển số xe hoặc khách hàng')">

                            <span class="input-group-append">
                                @if (Request::has('search') && Request::get('search') != '')
                                    <a href="{{ route('statis.repair') }}"
                                       class="btn btn-light d-flex align-items-center text-muted"
                                       role="button">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="col-md-3 mt-md-0 mt-2">
                        <label for="">Từ ngày</label>
                        <div class="input-group custom-search-form">
                            <input type="datetime-local"
                                   class="form-control input-solid"
                                   name="start_date"
                                   value="{{ Request::get('start_date') }}"
                                   placeholder="@lang('Search for users...')">
                        </div>
                    </div>
                    <div class="col-md-3 mt-md-0 mt-2">
                        <label for="">Đến ngày</label>
                        <div class="input-group custom-search-form">
                            <input type="datetime-local"
                                   class="form-control input-solid"
                                   name="end_date"
                                   value="{{ Request::get('end_date') }}">
                        </div>
                    </div>
                    <div class="col-md-3 text-right">
                        <button type="submit" class="btn btn-primary btn-rounded float-right">
                            <i class="fas fa-search"></i>
                            @lang('Tìm kiếm')
                        </button>
                    </div>
                </div>
            </form>
            <div class="table-responsive" id="users-table-wrapper">
                <table class="table table-borderless table-striped">
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
    <br>
    <div class="row table-responsive">
        <div class="col-md-12 text-right">
            <a href="" class="btn btn-primary btn-rounded float-right">
                <i class="fa fa-print"></i>
                @lang('In thống kê')
            </a>
        </div>
    </div>
    <br>
@stop

@section('scripts')
    <script>
        $("#status").change(function () {
            $("#users-form").submit();
        });
    </script>
@stop
