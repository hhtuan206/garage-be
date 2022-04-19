@extends('layouts.app')

@section('page-title', __('Histories'))
@section('page-heading', __('Histories'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Histories')
    </li>
@stop

@section('content')

    @include('partials.messages')

    <div class="card">
        <div class="card-body">
            <div class="row mb-3 pb-3 border-bottom-light">
                <div class="col-lg-12">
                    <div class="float-right">
                        <a href="{{ route('histories.create') }}" class="btn btn-primary btn-rounded">
                            <i class="fas fa-plus mr-2"></i>
                            @lang('Add History')
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
                        <th class="min-width-150">@lang('Discount')</th>
                        <th class="min-width-150">@lang('Last Total')</th>
                        <th class="min-width-150">@lang('At')</th>
                        <th class="text-center">@lang('Action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($histories))
                        @foreach ($histories as $history)
                            <tr>
                                <td>{{ $history->cars->number_plate }}</td>
                                <td>{{ $history->customers->full_name}}</td>
                                <td>{{ $history->discount}}</td>
                                <td>{{ $history->last_total}}</td>
                                <td>{{ $history->created_at }}</td>
                                <td class="text-center">
                                    <a href="{{ route('histories.edit', $history) }}" class="btn btn-icon"
                                       title="@lang('Edit History')" data-toggle="tooltip" data-placement="top">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('histories.destroy', $history) }}" class="btn btn-icon"
                                       title="@lang('Delete History')"
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
