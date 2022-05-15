@extends('layouts.app')

@section('page-title', __('vn.Service'))
@section('page-heading', $edit ? $service->name : __('vn.Create New Service'))

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('services.index') }}">@lang('vn.Service')</a>
    </li>
    <li class="breadcrumb-item active">
        {{ __($edit ? 'vn.Edit' : 'vn.Create') }}
    </li>
@stop

@section('content')

    @include('partials.messages')

    @if ($edit)
        {!! Form::open(['route' => ['services.update', $service], 'method' => 'PUT', 'id' => 'service-form']) !!}
    @else
        {!! Form::open(['route' => 'services.store', 'id' => 'service-form']) !!}
    @endif

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h5 class="card-title">
                        @lang('vn.Service Details')
                    </h5>
                    <p class="text-muted">
                        @lang('vn.A general service information.')
                    </p>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="name">@lang('vn.Name')</label>
                        <input type="text"
                               class="form-control input-solid"
                               id="name"
                               name="name"
                               placeholder="@lang('vn.Service Name')"
                               value="{{ $edit ? $service->name : old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="price">@lang('vn.Price')</label>
                        <input type="text"
                               class="form-control input-solid"
                               id="price"
                               name="price"
                               placeholder="@lang('vn.Price')"
                               value="{{ $edit ? $service->price : old('price') }}">
                    </div>

                    <div class="form-group">
                        <label for="detail">@lang('vn.Detail')</label>
                        <textarea name="detail"
                                  id="detail"
                                  class="form-control input-solid">{{ $edit ? $service->detail : old('detail') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="status">@lang('vn.Status')</label>
                        {!! Form::select('status',[0=>'Deactivate',1=>"Active"],null,['class'=>'form-control input-solid']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">
        {{ __($edit ? 'vn.Update Service' : 'vn.Create Service') }}
    </button>

@stop

@section('scripts')

    <script src="//cdn.ckeditor.com/4.18.0/basic/ckeditor.js"></script>
    <script>CKEDITOR.replace('detail');</script>
{{--    @if ($edit)--}}
{{--        {!! JsValidator::formRequest('Vanguard\Http\Requests\Role\UpdateRoleRequest', '#role-form') !!}--}}
{{--    @else--}}
{{--        {!! JsValidator::formRequest('Vanguard\Http\Requests\Role\CreateRoleRequest', '#role-form') !!}--}}
{{--    @endif--}}
@stop
