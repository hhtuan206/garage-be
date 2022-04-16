@extends('layouts.app')

@section('page-title', __('Services'))
@section('page-heading', __('Services'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Services')
    </li>
@stop

@section('content')

    @include('partials.messages')

    <div class="card">
        <div class="card-body">
            <div class="row mb-3 pb-3 border-bottom-light">
                <div class="col-lg-12">
                    <div class="float-right">
                        <a href="{{ route('services.create') }}" class="btn btn-primary btn-rounded">
                            <i class="fas fa-plus mr-2"></i>
                            @lang('Add Service')
                        </a>
                    </div>
                </div>
            </div>

            <div class="table-responsive" id="users-table-wrapper">
                <table class="table table-striped table-borderless">
                    <thead>
                    <tr>
                        <th class="min-width-100">@lang('Name')</th>
                        <th class="min-width-150">@lang('Prices')</th>
                        <th class="min-width-150">@lang('Discount')</th>
                        <th class="min-width-150">@lang('Detail')</th>
                        <th class="min-width-150">@lang('Status')</th>
                        <th class="text-center">@lang('Action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($services))
                        @foreach ($services as $service)
                            <tr>
                                <td>{{ $service->name }}</td>
                                <td>{{ $service->price }}</td>
                                <td>{{ $service->discount }}</td>
                                <td>{!!  \Illuminate\Support\Str::limit($service->detail,$limit = 30, $end = '...') !!} </td>
                                <td>{{ $service->status ? 'active': 'deactivate' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('services.edit', $service) }}" class="btn btn-icon"
                                       title="@lang('Edit Service')" data-toggle="tooltip" data-placement="top">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('services.destroy', $service) }}" class="btn btn-icon"
                                       title="@lang('Delete Service')"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       data-method="DELETE"
                                       data-confirm-title="@lang('Please Confirm')"
                                       data-confirm-text="@lang('Are you sure that you want to delete this service?')"
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
        <div class="card-footer text-muted text-right">
            {!! $services->links() !!}
        </div>
    </div>
@stop
