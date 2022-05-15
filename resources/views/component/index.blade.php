@extends('layouts.app')

@section('page-title', __('vn.Components'))
@section('page-heading', __('vn.Components'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('vn.Components')
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
                            @lang('vn.Add Component')
                        </a>
                    </div>
                </div>
            </div>

            <div class="table-responsive" id="users-table-wrapper">
                <table class="table table-striped table-borderless">
                    <thead>
                    <tr>
                        <th class="min-width-100">@lang('vn.Image')</th>
                        <th class="min-width-100">@lang('vn.Name')</th>
                        <th class="min-width-150">@lang('vn.Price')</th>
                        <th class="min-width-150">@lang('vn.Unit')</th>
                        <th class="min-width-150">@lang('vn.Detail')</th>
                        <th class="min-width-150">@lang('vn.Stock')</th>
                        <th class="text-center">@lang('vn.Action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($components))
                        @foreach ($components as $component)
                            <tr>
                                <td><img src="{{asset('component/'.$component->image)}}" alt="" width="75px"
                                         height="75px"></td>
                                <td>{{ $component->name }}</td>
                                <td>{{ $component->prices }}</td>
                                <td>{{ $component->unit }}</td>
                                <td>{!!  \Illuminate\Support\Str::limit($component->description,$limit = 30, $end = '...') !!} </td>
                                <td>{{ $component->stock ?? 'Hết hàng' }}</td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-icon"
                                       title="@lang('Cập nhật tồn kho')" data-toggle="modal"
                                       data-target="#exampleModal" data-whatever="{{$component->id}}">
                                        <i class="fas fa-layer-group"></i>
                                    </a>
                                    <a href="{{ route('components.edit', $component) }}" class="btn btn-icon"
                                       title="@lang('vn.Edit Component')" data-toggle="tooltip"
                                       data-placement="top">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('components.destroy', $component) }}" class="btn btn-icon"
                                       title="@lang('vn.Delete Component')"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       data-method="DELETE"
                                       data-confirm-title="@lang('vn.Please Confirm')"
                                       data-confirm-text="@lang('vn.Are you sure that you want to delete this component?')"
                                       data-confirm-delete="@lang('vn.Yes, delete it!')">
                                        <i class="fas fa-trash"></i>
                                    </a>
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
            {!! $components->links() !!}
        </div>
    </div>
    @include('component.modal.updateStock')
@stop
@section('scripts')
    <script>
        $(document).ready(function () {
            $('#exampleModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var id = button.data('whatever') // Extract info from data-* attributes
                $('#update-stock').attr('action', "updateStock/" + id)
            })
        })

    </script>
@endsection
