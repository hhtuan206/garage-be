@extends('layouts.app')

@section('page-title', __('vn.Repair'))
@section('page-heading', $edit ? $repair->car->number_plate : __('vn.Create New Repair'))

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('repairs.index') }}">@lang('vn.Repair')</a>
    </li>
    <li class="breadcrumb-item active">
        {{ __($edit ? 'vn.Edit' : 'vn.Create') }}
    </li>
@stop

@section('content')

    @include('partials.messages')

    @if ($edit)
        {!! Form::open(['route' => ['repairs.update', $repair], 'method' => 'PUT']) !!}
    @else
        {!! Form::open(['route' => ['repairs.store',['appointment' => $appointment]],'method'=>'POST']) !!}
    @endif

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h5 class="card-title">
                        @lang('vn.Customer Details')
                    </h5>
                    <p class="text-muted">
                        @lang('vn.A general customer information.')
                    </p>
                </div>
                <div class="col-sm-9">
                    <div class="exist">
                        {{--                        @include('repair.partials.customer')--}}
                        {!! Form::select('user_id',$users,Request::get('user') ?? '',['class'=>'form-control input-solid','id' => 'user']) !!}
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
                        @lang('vn.Car Details')
                    </h5>
                    <p class="text-muted">
                        @lang('vn.A general car information.')
                    </p>
                </div>
                <div class="col-md-9">
                    <div class="car">
                        <div id="car_show" class=""></div>
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
                        @lang('vn.Service Details')
                    </h5>
                    <p class="text-muted">
                        @lang('vn.A general Service information.')
                    </p>
                </div>
                <div class="col-sm-9">
                    <div class="">
                        {!! Form::select('services[]',$services,null,['class'=>'form-control input-solid','multiple','id'=>'service']) !!}
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
                        @lang('vn.Component Details')
                    </h5>
                    <p class="text-muted">
                        @lang('vn.A general Component information.')
                    </p>
                </div>
                <div class="col-sm-9">
                    <div class="">
                        {!! Form::select('components[]',$components,null,['class'=>'form-control input-solid','multiple','id'=>'component']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div id="component-render"></div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">
        {{ __($edit ? 'vn.Update Repair' : 'vn.Create Repair') }}
    </button>

@stop

@section('scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#user').change(function () {
                console.log($(this).val())
                $.ajax({
                    url: '{{route('getCar')}}',
                    type: 'post',
                    data: {
                        'id': $(this).val()
                    }
                }).done(function (res) {
                    console.log(res)
                    $('#car_show').html(res)
                })

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
                        $('#component-render').html(res)
                    }
                })
            })
            $('#service').select2();
            $('#component').select2();


        })
    </script>

@stop
