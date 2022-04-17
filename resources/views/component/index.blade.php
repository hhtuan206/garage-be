@extends('layouts.app')

@section('page-title', __('Components'))
@section('page-heading', __('Components'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Components')
    </li>
@stop

@section('content')

    @include('partials.messages')

    <div class="card">
        <div class="card-body">
            <div class="row mb-3 pb-3 border-bottom-light">
                <div class="col-lg-12">
                    <div class="float-left">
                        <form action="" class="form-inline">
                            <div class="form-group form-group-lg">
                                <input class="form-control input-sm" id="inputsm" type="text">
                                <a><i style='font-size:24px' class='fas'>&#xf002;</i></a>
                            </div>
                        </form>
                    </div>
                    <div class="float-right ">
                        <a href="{{ route('components.create') }}" class="btn btn-primary btn-rounded">
                            <i class="fas fa-plus mr-2"></i>
                            @lang('Add Component')
                        </a>
                    </div>
                </div>
            </div>

            <div class="table-responsive" id="users-table-wrapper">
                <table class="table table-striped table-borderless">
                    <thead>
                    <tr>
                        <th class="min-width-100">@lang('Image')</th>
                        <th class="min-width-100">@lang('Name')</th>
                        <th class="min-width-150">@lang('Prices')</th>
                        <th class="min-width-150">@lang('Discount')</th>
                        <th class="min-width-150">@lang('Detail')</th>
                        <th class="min-width-150">@lang('Stock')</th>
                        <th class="text-center">@lang('Action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($components))
                        @foreach ($components as $component)
                            <tr>
                                <td><img src="{{asset('component/'.$component->image)}}" alt="" width="75px" height="75px"></td>
                                <td>{{ $component->name }}</td>
                                <td>{{ $component->price }}</td>
                                <td>{{ $component->discount }}</td>
                                <td>{!!  \Illuminate\Support\Str::limit($component->description,$limit = 30, $end = '...') !!} </td>
                                <td>{{ $component->stock ?? 'Sold out' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('components.edit', $component) }}" class="btn btn-icon"
                                       title="@lang('Edit Component')" data-toggle="tooltip" data-placement="top">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('components.destroy', $component) }}" class="btn btn-icon"
                                       title="@lang('Delete Component')"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       data-method="DELETE"
                                       data-confirm-title="@lang('Please Confirm')"
                                       data-confirm-text="@lang('Are you sure that you want to delete this component?')"
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
            {!! $components->links() !!}
        </div>
    </div>
@stop
