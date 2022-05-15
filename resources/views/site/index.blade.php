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
                        @if($site[0]->content)
                            <br>
                            <img src="{{asset('upload/'.$site[0]->content)}}" alt="" width="100">
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
                               value="{{ $site[1]->content }}">
                    </div>
                    <div class="form-group">
                        <label for="description">@lang('vn.Phone')</label>
                        <input type="text"
                               class="form-control input-solid"
                               name="phone"
                               placeholder="@lang('vn.Phone')"
                               value="{{ $site[2]->content }}">
                    </div>
                    <div class="form-group">
                        <label for="address">@lang('vn.Address')</label>
                        <textarea name="address" id="" cols="12" rows="3"
                                  class="form-control input-solid">{{ $site[3]->content }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">
        {{ __('vn.Update Site') }}
    </button>

@stop

