@extends('layouts.app')

@section('page-title', __('Quản lý xe'))
@section('page-heading', __('Quản lý xe'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Quản lý xe')
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
                                   placeholder="@lang('Tìm theo tên khách hàng hoặc biển số xe')">

                            <span class="input-group-append">
                                @if (Request::has('search') && Request::get('search') != '')
                                    <a href="{{ route('cars.index') }}"
                                       class="btn btn-light d-flex align-items-center text-muted"
                                       role="button">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="col-md-3 mt-md-0 mt-2">
                    </div>

                    <div class="col-md-6 text-right">
                        <a href="{{ route('cars.create') }}" class="btn btn-primary btn-rounded">
                            <i class="fas fa-plus mr-2"></i>
                            @lang('Thêm xe')
                        </a>
                    </div>
                </div>
            </form>

            <div class="table-responsive-sm" id="users-table-wrapper">
                <table class="table table-striped table-borderless">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th class="min-width-100">@lang('Biển Số Xe')</th>
                        <th class="min-width-150">@lang('Họ Tên Khách Hàng')</th>
                        <th class="min-width-150">@lang('Đặc điểm')</th>
                        <th class="min-width-150">@lang('Lần cuối sửa')</th>
                        <th class="text-center">@lang('vn.Action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($cars))
                        @foreach ($cars as $key => $car)
                            <tr>
                                <td>{{$key}}</td>
                                <td>{{ $car->number_plate }}</td>
                                <td>{{ $car->user->fullname }}</td>
                                <td>
                                    @foreach($car->values as $value)
                                        <label for="" class="badge badge-info">
                                            {{\Vanguard\Models\Attribute::find($value->attribute_id)->name}}
                                            :{{$value->name}}

                                        </label>
                                        <br>
                                    @endforeach
                                </td>
                                <td>{{(count($car->repairs))? date('d-m-Y',strtotime($car->repairs->last()->created_at)) : 'Chưa từng sửa chữa' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('cars.edit', $car) }}" class="btn btn-icon"
                                       title="Cập nhật xe" data-toggle="tooltip" data-placement="top">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('cars.destroy', $car) }}" class="btn btn-icon"
                                       title="@lang('Xoá xe')"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       data-method="DELETE"
                                       data-confirm-title="@lang('vn.Please Confirm')"
                                       data-confirm-text="@lang('Bạn có chắc muốn xoá xe này?')"
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
            {!! $cars->links() !!}
        </div>
    </div>
@stop
