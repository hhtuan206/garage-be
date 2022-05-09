@extends('layouts.app')

@section('page-title', __('Options'))
@section('page-heading', __('Options'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Categories')
    </li>
@stop

@section('content')

    @include('partials.messages')
    <div class="row ">
        <div class="col-md-6 mx-auto">
            <div class="card">
                {!! Form::open(['route' => ['values.update',$value],'method' => 'PUT', 'id' => 'option-form']) !!}
                <div class="card-header">
                    Attribute Information
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
                                       placeholder="@lang('Value Name')"
                                       value="{{$value->name}}">
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
