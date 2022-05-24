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
                        <a href="{{ route('cars.create') }}" class="btn btn-primary btn-rounded">
                            <i class="fas fa-plus mr-2"></i>
                            @lang('Thêm xe')
                        </a>
                    </div>
                </div>
            </div>

            <div class="table-responsive" id="users-table-wrapper">
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
