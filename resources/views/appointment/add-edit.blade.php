@extends('layouts.app')

@section('page-title', __('News'))
@section('page-heading', $edit ? $appointment->user->fullname : __('Create New News'))

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('appointments.index') }}">@lang('Appointment')</a>
    </li>
    <li class="breadcrumb-item active">
        {{ __($edit ? 'Edit' : 'Create') }}
    </li>
@stop

@section('content')

    @include('partials.messages')

    @if ($edit)
        {!! Form::open(['route' => ['appointments.update', $appointment], 'method' => 'PUT']) !!}
    @else
        {!! Form::open(['route' => 'appointments.store']) !!}
    @endif

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h5 class="card-title">
                        @lang('Appointment Details')
                    </h5>
                    <p class="text-muted">
                        @lang('A general appointment information.')
                    </p>
                </div>

                <div class="col-md-9">
                    @include('repair.partials.customer')
                    <div class="form-group">
                        <label for="">Time</label>
                        <input type="datetime-local" name="time" class="form-control input-solid"
                               value="{{($edit)?strftime('%Y-%m-%dT%H:%M:%S', strtotime($appointment->date_time)):''}}">
                    </div>
                    <div class="form-group">
                        <label for="">Status</label>
                        {!! Form::select('status',['Waiting' => 'Đang chờ','Confirm' => 'Xác nhận'],$appointment->status?? '',['class'=>'form-control input-solid']) !!}
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
    <script>
        $(document).ready(function () {
            var today = new Date().toISOString().slice(0, 16);
            document.getElementsByName("time")[0].min = today;
            $('input[name=phone]').change(function () {
                console.log($(this).val())
                if ($('#phone').val() !== null) {
                    $.ajax({
                        url: '{{route('findCustomer')}}',
                        type: 'post',
                        data: {
                            'phone': $(this).val()
                        }
                    }).done(function (res) {
                        console.log(res)
                        if (!jQuery.isEmptyObject(res)) {
                            console.log(res)
                            $('#full_name').val(res.full_name);
                            $('#email').val(res.email);
                            $('#engine_number').val(res.engine_number);
                            $('#number_plate').val(res.number_plate);
                            $('#attribute').val(res.attributes).trigger('change');
                        }
                    })
                }
            })
        })

    </script>
@stop
