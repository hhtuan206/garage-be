@extends('layouts.app')

@section('page-title', __('Attributes'))
@section('page-heading', __('Attributes'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Attributes')
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
                                <th>@lang('vn.Value')</th>
                                <th class="text-center">@lang('vn.Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (count($attributes))
                                @foreach ($attributes as $key => $attribute)
                                    <tr>
                                        <td>{{$key}}</td>
                                        <td>
                                            <label for="">{{ $attribute->name }}</label>
                                        </td>
                                        <td>
                                            @foreach($attribute->values as $value)
                                                <span class="badge badge-info">{{$value->name}}</span>
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('attribute.editAttributeValue', $attribute) }}"
                                               class="btn btn-icon"
                                               title="@lang('vn.Edit Attribute Value')" data-toggle="tooltip"
                                               data-placement="top">
                                                <i class="fa fa-cog"></i>
                                            </a>
                                            <a href="{{ route('attributes.edit', $attribute) }}" class="btn btn-icon"
                                               title="@lang('vn.Edit Attribute')" data-toggle="tooltip"
                                               data-placement="top">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('attributes.destroy', $attribute) }}" class="btn btn-icon"
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

        <div class="col-md-4">
            <div class="card">
                {!! Form::open(['route' => 'attributes.store','method' => 'POST', 'id' => 'option-form']) !!}
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
                                       placeholder="@lang('Attribute Name')"
                                       value="">
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

