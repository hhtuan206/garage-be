@extends('layouts.app')

@section('page-title', __('Value'))
@section('page-heading',$attribute->name)

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('attributes.index') }}">@lang('Attribute')</a>
    </li>
    <li class="breadcrumb-item active">

    </li>
@stop

@section('content')

    @include('partials.messages')


    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">

                    @lang('vn.Attribute Detail')
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive" id="users-table-wrapper">
                            <table class="table table-striped table-borderless">
                                <thead>
                                <tr>
                                    <th class="min-width-100">@lang('#')</th>
                                    <th class="min-width-100">@lang('vn.Name')</th>
                                    <th class="text-center">@lang('vn.Action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (count($attribute->values))
                                    @foreach ($attribute->values as $key => $value)
                                        <tr>
                                            <td><a href="">{{ $key }}</a></td>
                                            <td>{{ $value->name }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('values.edit', $value->id) }}"
                                                   class="btn btn-icon"
                                                   title="@lang('vn.Edit Option')" data-toggle="tooltip"
                                                   data-placement="top">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('values.destroy', $value->id) }}" class="btn btn-icon"
                                                   title="@lang('vn.Delete Option')"
                                                   data-toggle="tooltip"
                                                   data-placement="top"
                                                   data-method="DELETE"
                                                   data-confirm-title="@lang('vn.Please Confirm')"
                                                   data-confirm-text="@lang('vn.Are you sure that you want to delete this option?')"
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
        </div>
        <div class="col-md-4">
            <div class="card">
                {!! Form::open(['route' => 'values.store','method'=>'POST', 'id' => 'option-value-form']) !!}
                <div class="card-header">
                    @lang('vn.Add New Attribute Value')
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="attribute_id" value="{{$attribute->id}}">
                            <div class="form-group">
                                <label for="">@lang('vn.Attribute Name')</label>
                                <input type="text"
                                       class="form-control input-solid"
                                       value="{{$attribute->name }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="name">@lang('vn.Attribute Value')</label>
                                <input type="text" class="form-control input-solid" name="name" placeholder="Tên">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary ">
                        @lang('vn.Save')
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>




@stop

@section('scripts')

@stop
