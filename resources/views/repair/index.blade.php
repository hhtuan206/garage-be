@extends('layouts.app')

@section('page-title', __('Repairs'))
@section('page-heading', __('Repairs'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Repairs')
    </li>
@stop

@section('content')

    @include('partials.messages')

    <div class="card">
        <div class="card-body">
            <div class="row mb-3 pb-3 border-bottom-light">
                <div class="col-lg-12">
                    <div class="float-right">
                        <a href="{{ route('repairs.create') }}" class="btn btn-primary btn-rounded">
                            <i class="fas fa-plus mr-2"></i>
                            @lang('Add Repair')
                        </a>
                    </div>
                </div>
            </div>

            <div class="table-responsive" id="users-table-wrapper">
                <table class="table table-striped table-borderless">
                    <thead>
                    <tr>
                        <th class="min-width-100">@lang('Car')</th>
                        <th class="min-width-150">@lang('Customer Name')</th>
                        <th class="min-width-150">@lang('Services')</th>
                        <th class="min-width-150">@lang('Total')</th>
                        <th class="min-width-150">@lang('Repair At')</th>
                        <th class="text-center">@lang('Action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($repairs))
                        @foreach ($repairs as $repair)
                            <tr>
                                <td>{{ $repair->car->number_plate }}</td>
                                <td>{{ $repair->user->fullname}}</td>
                                <td>
                                    @foreach($repair->services as $service)
                                        <label class="badge badge-info">{{$service->name}}</label>
                                    @endforeach
                                    </td>
                                <td>{{ $repair->total_price}}</td>
                                <td>{{ $repair->created_at }}</td>
                                <td class="text-center">
                                    <a href="{{ route('repairs.edit', $repair) }}" class="btn btn-icon"
                                       title="@lang('Edit Repair')" data-toggle="tooltip" data-placement="top">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('repairs.destroy', $repair) }}" class="btn btn-icon"
                                       title="@lang('Delete Repair')"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       data-method="DELETE"
                                       data-confirm-title="@lang('Please Confirm')"
                                       data-confirm-text="@lang('Are you sure that you want to delete this history?')"
                                       data-confirm-delete="@lang('Yes, delete it!')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4"><em>@lang('No records found.')</em></td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
