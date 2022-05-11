@extends('layouts.app')

@section('page-title', __('Site Config'))
@section('page-heading', __('Site Config'))

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('site.index') }}">@lang('Site Config')</a>
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
                        @lang('Site Config')
                    </h5>
                    <p class="text-muted">
                        @lang('A general site information.')
                    </p>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="name">@lang('Logo')</label>
                        @if($site[0]->content)
                            <br>
                            <img src="{{asset('upload/'.$site[0]->content)}}" alt="" width="75">
                        @endif
                        <input type="file"
                               class="form-control input-solid"
                               name="logo"
                               placeholder="@lang('Logo')"
                               value="{{$site[0]->content}}">

                    </div>
                    <div class="form-group">
                        <label for="display_name">@lang('Email')</label>
                        <input type="email"
                               class="form-control input-solid"
                               name="email"
                               placeholder="@lang('Display Name')"
                               value="{{ $site[1]->content }}">
                    </div>
                    <div class="form-group">
                        <label for="description">@lang('Phone')</label>
                        <input type="text"
                               class="form-control input-solid"
                               name="phone"
                               placeholder="@lang('Phone')"
                               value="{{ $site[2]->content }}">
                    </div>
                    <div class="form-group">
                        <label for="address">@lang('Address')</label>
                        <textarea name="address" id="" cols="12" rows="3"
                                  class="form-control input-solid">{{ $site[3]->content }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">
        {{ __('Update Site') }}
    </button>

@stop

