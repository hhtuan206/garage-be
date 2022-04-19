@extends('layouts.app')

@section('page-title', __('History'))
@section('page-heading', $edit ? $history->name : __('Create New History'))

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('histories.index') }}">@lang('History')</a>
    </li>
    <li class="breadcrumb-item active">
        {{ __($edit ? 'Edit' : 'Create') }}
    </li>
@stop

@section('content')

    @include('partials.messages')

    @if ($edit)
        {!! Form::open(['route' => ['histories.update', $role], 'method' => 'PUT', 'id' => 'history-form']) !!}
    @else
        {!! Form::open(['route' => 'histories.store', 'id' => 'history-form']) !!}
    @endif

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h5 class="card-title">
                        @lang('Customer Details')
                    </h5>
                    <p class="text-muted">
                        @lang('A general customer information.')
                    </p>
                </div>
                <div class="col-sm-9">
                    <div class="exist">
                        @include('history.partials.customer')
                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h5 class="card-title">
                        @lang('Car Details')
                    </h5>
                    <p class="text-muted">
                        @lang('A general car information.')
                    </p>
                </div>
                <div class="col-sm-9">
                    <div class="car">
                        @include('history.partials.car')
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h5 class="card-title">
                        @lang('Insurance Details')
                    </h5>
                    <p class="text-muted">
                        @lang('A general Insurance information.')
                    </p>
                </div>
                <div class="col-sm-9">
                    <div class="">
                        @include('history.partials.insurance')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h5 class="card-title">
                        @lang('Service Details')
                    </h5>
                    <p class="text-muted">
                        @lang('A general Service information.')
                    </p>
                </div>
                <div class="col-sm-9">
                    <div class="">
                        {!! Form::select('service_id[]',$services,null,['class'=>'form-control input-solid','multiple','id'=>'service']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h5 class="card-title">
                        @lang('Service Details')
                    </h5>
                    <p class="text-muted">
                        @lang('A general Service information.')
                    </p>
                </div>
                <div class="col-sm-9">
                    <div class="">
                        {!! Form::select('component_id[]',$components,null,['class'=>'form-control input-solid','multiple','id'=>'component']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div id="table"></div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">
        {{ __($edit ? 'Update History' : 'Create History') }}
    </button>

@stop

@section('scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#full_name').keyup(function () {
                if ($('#full_name').val() !== null) {
                    $.ajax({
                        url: '{{route('findCustomer')}}',
                        type: 'post',
                        data: {
                            'full_name': $('#full_name').val()
                        },
                        success: function (res) {
                            $('.exist').html(res)
                        }, error: function () {
                        }
                    })
                }
            })
            $('#component').on('change', function () {
                console.log($(this).val()
                )
                $.ajax({
                    url: '{{route("render-component")}}',
                    type: "post",
                    data: {
                        'component': $(this).val()
                    },
                    success: function (res) {
                        $('#table').html(res)
                    }
                })
            })
            $('#service').select2();
            $('#component').select2();
        })
    </script>

@stop
