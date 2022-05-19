@extends('layouts.app')

@section('page-title', __('Thể loại'))
@section('page-heading', __('Thể loại'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        Thể loại
    </li>
@stop

@section('content')

    @include('partials.messages')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    @lang('vn.All Information')
                </div>
                <div class="card-body">
                    <div class="table-responsive" id="users-table-wrapper">
                        <table class="table table-striped table-borderless">
                            <thead>
                            <tr>
                                <th>@lang('#')</th>
                                <th>@lang('vn.Name')</th>
                                <th>Thuộc</th>
                                <th class="text-center">@lang('vn.Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (count($categories))
                                @foreach ($categories as $key => $category)
                                    <tr>
                                        <td>{{$key}}</td>
                                        <td>
                                            <label for="">{{ $category->name }}</label>
                                        </td>
                                        <td>
                                            {!! $category->type_v !!}
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('categories.edit', $category) }}"
                                               class="btn btn-icon"
                                               title="Cập nhật thể loại" data-toggle="tooltip"
                                               data-placement="top">
                                                <i class="fa fa-cog"></i>
                                            </a>
                                            <a href="{{ route('categories.destroy', $category) }}" class="btn btn-icon"
                                               title="Xoá thể loại"
                                               data-toggle="tooltip"
                                               data-placement="top"
                                               data-method="DELETE"
                                               data-confirm-title="@lang('vn.Please Confirm')"
                                               data-confirm-text="Bạn có chắc chắn xoá thể loại (sẽ mất thông tin các linh kiện và tin tức dùng thể loại này)?"
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
        </div>

        <div class="col-md-4">
            <div class="card">
                {!! Form::open(['route' => 'categories.store','method' => 'POST', 'id' => 'option-form']) !!}
                <div class="card-header">
                    Add New Attribute
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">@lang('Name')</label>
                                <input type="text"
                                       class="form-control input-solid"
                                       id="name"
                                       name="name"
                                       placeholder="Tên thể loại"
                                       value="">
                            </div>
                            <div class="form-group">
                                <label for="detail">Thuộc</label>
                                {!! Form::select('type',['component' => 'Linh kiện', 'news' => 'Tin tức'], null,['class'=> 'form-control input-solid']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>


@stop

