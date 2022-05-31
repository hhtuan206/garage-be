@extends('layouts.app')

@section('page-title', __('vn.Site Config'))
@section('page-heading', __('vn.Site Config'))

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('site.index') }}">@lang('vn.Site Config')</a>
    </li>
@stop

@section('content')

    @include('partials.messages')

    {!! Form::open(['route' => ['site.store'], 'method' => 'POST',  'enctype' => 'multipart/form-data']) !!}

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h5 class="card-title">
                        @lang('vn.Site Config')
                    </h5>
                    <p class="text-muted">
                        @lang('vn.A general site information.')
                    </p>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="name">@lang('vn.Logo')</label>
                        @if($site->logo)
                            <br>
                            <img src="{{asset('upload/'.$site->logo)}}" alt="" width="100">
                        @endif
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01"
                                   name="logo">
                            <label class="custom-file-label" for="inputGroupFile01">@lang('vn.Choosefile')</label>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="display_name">@lang('vn.Email')</label>
                        <input type="email"
                               class="form-control input-solid"
                               name="email"
                               placeholder="@lang('vn.Email')"
                               value="{{ $site->email }}">
                    </div>
                    <div class="form-group">
                        <label for="description">@lang('vn.Phone')</label>
                        <input type="text"
                               class="form-control input-solid"
                               name="phone"
                               placeholder="@lang('vn.Phone')"
                               value="{{ $site->phone }}">
                    </div>
                    <div class="form-group">
                        <label for="address">@lang('vn.Address')</label>
                        <textarea name="address" id="" cols="12" rows="3"
                                  class="form-control input-solid">{{ $site->address }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="address">@lang('Giờ làm việc')</label>
                        <textarea name="open_hour" id="" cols="12" rows="3"
                                  class="form-control input-solid">{{ $site->open_hour }}</textarea>
                    </div>
                    <div class="form-group">
                        <div class="d-flex align-items-center">
                            <div class="ml-3 d-flex flex-column">
                                <label class="mb-0">@lang('Đặt lịch')</label>
                                <small class="pt-0 text-muted">
                                    @lang('Bật tắt đặt lịch.')
                                </small>
                            </div>
                            <div class="switch">
                                <input type="hidden" value="0" name="appointment">
                                {!! Form::checkbox('appointment', 1, $site->appointment, ['class' => 'switch', 'id' => 'switch-forgot-pass','style' => 'width = 10px;']) !!}
                                <label for="switch-forgot-pass"></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">
        {{ __('vn.Update Site') }}
    </button>

@stop

