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
            <form action="" method="GET" id="users-form" class="pb-2 mb-3 border-bottom-light">
                <div class="row my-3 flex-md-row flex-column-reverse">
                    <div class="col-md-3 mt-md-0 mt-2">
                        <div class="input-group custom-search-form">
                            <input type="text"
                                   class="form-control input-solid"
                                   name="search"
                                   value="{{ Request::get('search') }}"
                                   placeholder="@lang('Tìm theo tên sản phẩm')">

                            <span class="input-group-append">
                                @if (Request::has('search') && Request::get('search') != '')
                                    <a href="{{ route('statis.component') }}"
                                       class="btn btn-light d-flex align-items-center text-muted"
                                       role="button">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="col-md-3 mt-md-0 mt-2">
                        {!! Form::select('stock',[0 => 'Tất cả',1 => 'Tồn kho',2=>'Hết hàng'],Request::get('stock'),['class' => 'form-control input-solid','id' => 'stock']) !!}
                    </div>
                    @permission('admin')
                    <div class="col-md-6 text-right">
                        <a href="{{ route('components.create') }}" class="btn btn-primary btn-rounded">
                            <i class="fas fa-plus mr-2"></i>
                            @lang('vn.Add Component')
                        </a>
                    </div>
                    @endpermission
                </div>
            </form>


            <div class="table-responsive" id="users-table-wrapper">
                <table class="table table-striped table-borderless">
                    <thead>
                    <tr>
                        <th class="">#</th>
                        <th class="">@lang('vn.Image')</th>
                        <th class="">@lang('vn.Name')</th>
                        <th class="">@lang('vn.Price')</th>
                        <th class="">@lang('vn.Unit')</th>
                        <th class="">@lang('vn.Detail')</th>
                        <th class="">@lang('vn.Stock')</th>
                        <th class="">Thể loại</th>
                        <th class="text-center">Số lượt sử dụng</th>
                        <th class="text-center">@lang('vn.Action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($components))
                        @foreach ($components as $key => $component)
                            <tr>
                                <td>{{$key}}</td>
                                <td><img src="{{asset('component/'.$component->image)}}" alt="" width="75px"
                                         height="75px"></td>
                                <td>{{ $component->name }}</td>
                                <td>{{ $component->prices }}đ</td>
                                <td>{{ $component->unit }}</td>
                                <td>{!!  \Illuminate\Support\Str::limit($component->description,$limit = 30, $end = '...') !!} </td>
                                <td>{{ $component->stock ?? 'Hết hàng' }}</td>
                                <td>{{$component->category_name}}</td>
                                <td class="text-center">{{count($component->repairs)}}</td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-icon"
                                       title="@lang('Cập nhật tồn kho')" data-toggle="modal"
                                       data-target="#exampleModal" data-whatever="{{$component->id}}">
                                        <i class="fas fa-layer-group"></i>
                                    </a>
                                    @permission('admin')
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
            $('#stock').on('change', function () {
                $('#users-form').submit()
            })
        })

    </script>
@endsection
