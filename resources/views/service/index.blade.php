@extends('layouts.app')

@section('page-title', __('vn.Services'))
@section('page-heading', __('vn.Services'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('vn.Services')
    </li>
@stop

@section('content')

    @include('partials.messages')

    <div class="card">
        <div class="card-body">
            <form action="" method="GET" id="users-form" class="pb-2 mb-3 border-bottom-light">
                <div class="row my-3 flex-md-row flex-column-reverse">
                    <div class="col-md-4 mt-md-0 mt-2">
                        <div class="input-group custom-search-form">
                            <input type="text"
                                   class="form-control input-solid"
                                   name="search"
                                   value="{{ Request::get('search') }}"
                                   placeholder="@lang('Search for users...')">

                            <span class="input-group-append">
                                @if (Request::has('search') && Request::get('search') != '')
                                    <a href="{{ route('users.index') }}"
                                       class="btn btn-light d-flex align-items-center text-muted"
                                       role="button">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                                <button class="btn btn-light" type="submit" id="search-users-btn">
                                    <i class="fas fa-search text-muted"></i>
                                </button>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-2 mt-2 mt-md-0">
                        {!!
                            Form::select(
                                'status',
                                [''=>'Tất cả','active'=>"Đang hoạt động",'deactivate'=>'Dừng hoạt động'],
                                Request::get('status'),
                                ['id' => 'status', 'class' => 'form-control input-solid']
                            )
                        !!}
                    </div>

                    <div class="col-md-6">
                        <a href="{{ route('services.create') }}" class="btn btn-primary btn-rounded float-right">
                            <i class="fas fa-plus mr-2"></i>
                            @lang('vn.Add Service')
                        </a>
                    </div>
                </div>
            </form>
            <div class="table-responsive" id="users-table-wrapper">
                <table class="table table-striped table-borderless">
                    <thead>
                    <tr>
                        <th class="min-width-100">#</th>
                        <th class="min-width-100">@lang('vn.Name')</th>
                        <th class="min-width-150">@lang('vn.Price')</th>
                        <th class="min-width-150">@lang('vn.Detail')</th>
                        <th class="min-width-150">@lang('vn.Status')</th>
                        <th class="text-center">@lang('vn.Action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($services))
                        @foreach ($services as $key => $service)
                            <tr>
                                <td>{{$key}}</td>
                                <td>{{ $service->name }}</td>
                                <td>{{ $service->prices }}</td>
                                <td>{!!  \Illuminate\Support\Str::limit($service->detail,$limit = 30, $end = '...') !!} </td>
                                <td><label for=""
                                           class="badge badge-info">{{ $service->status ? 'Hoạt động': 'Dừng hoạt động' }}</label>
                                </td>

                                <td class="text-center">
                                    @permission('edit.service')
                                    <a href="{{ route('services.edit', $service) }}" class="btn btn-icon"
                                       title="@lang('vn.Edit Service')" data-toggle="tooltip" data-placement="top">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('services.destroy', $service) }}" class="btn btn-icon"
                                       title="@lang('vn.Delete Service')"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       data-method="DELETE"
                                       data-confirm-title="@lang('vn.Please Confirm')"
                                       data-confirm-text="@lang('vn.Are you sure that you want to delete this service?')"
                                       data-confirm-delete="@lang('vn.Yes, delete it!')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    @endpermission
                                </td>

                            </tr>
                        @endforeach

                    @else
                        <tr>
                            <td colspan="4"><em>@lang('vn.No records found.')</em></td>
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
