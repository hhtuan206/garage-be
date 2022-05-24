@extends('layouts.app')

@section('page-title', __('Thêm xe'))
@section('page-heading', $edit ? $car->user->fullname : __('Thêm xe'))

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('cars.index') }}">@lang('Quản lý xe')</a>
    </li>
    <li class="breadcrumb-item active">
        {{ __($edit ? 'Edit' : 'Create') }}
    </li>
@stop

@section('content')

    @include('partials.messages')

    @if ($edit)
        {!! Form::open(['route' => ['cars.update', $car], 'method' => 'PUT']) !!}
    @else
        {!! Form::open(['route' => 'cars.store']) !!}
    @endif

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h5 class="card-title">
                        @lang('Khách hàng')
                    </h5>
                    <p class="text-muted">
                        @lang('Thông tin khách hàng.')
                    </p>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="">Khách hàng</label>
                        {!! Form::select('user_id',$users,$car->user_id?? '',['class'=>'form-control input-solid']) !!}
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
                        @lang('Xe')
                    </h5>
                    <p class="text-muted">
                        @lang('Thông tin xe.')
                    </p>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="">Biển số</label>
                        <input type="text" class="form-control input-solid" name="number_plate"
                               value="{{$car->number_plate ?? ''}}">
                    </div>
                    <div class="form-group">
                        <label for="">Số máy</label>
                        <input type="text" class="form-control input-solid" name="engine_number"
                               value="{{$car->engine_number ?? ''}}">
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
                        @lang('Thông tin')
                    </h5>
                    <p class="text-muted">
                        @lang('Thông tin thêm.')
                    </p>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="">Thuộc tính</label>
                        {!! Form::select('attribute[]',$attributes,$car->attributes  ?? '',['class'=>'form-control input-solid','multiple','id'=>'attribute']) !!}
                    </div>
                    <div class="form-group">
                        <div id="attribute-value"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">
        {{ __($edit ? 'Update Appointment' : 'Create Appointment') }}
    </button>

@stop

@section('scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>

        $(document).ready(function () {
            $('#attribute').on('change', function () {
                console.log($(this).val()
                )
                $.ajax({
                    url: '{{route("render-attribute")}}',
                    type: "post",
                    data: {
                        'attribute': $(this).val()
                    },
                    success: function (res) {
                        console.log(res)
                        $('#attribute-value').html(res)
                    }
                })
            })
            $('#service').select2();
            $('#component').select2();
            $('#attribute').select2();
        })
    </script>
@stop
