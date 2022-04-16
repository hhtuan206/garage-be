@extends('layouts.app')

@section('page-title', __('Imports'))
@section('page-heading', __('Imports'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Imports')
    </li>
@stop

@section('content')

    @include('partials.messages')
    <form action="{{route('imports.service')}}" method="post" enctype="multipart/form-data">
        <div class="card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h5 class="card-title">
                                @lang('Service Import')
                            </h5>
                            <p class="text-muted">
                                @lang('Download this file and fill out sample.')
                                <a href="{{route('exports.service')}}">Download</a>
                            </p>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                @csrf
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile01" name="service_import">
                                    <label class="custom-file-label" for="inputGroupFile01" >Choose
                                        file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted text-right">
                    <button class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>

@stop
