@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
@endsection
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
                    <div class="col-md-6 text-right">
                        <button type="submit" class="btn btn-primary btn-rounded float-right">
                            <i class="fas fa-search"></i>
                            @lang('Tìm kiếm')
                        </button>
                    </div>
                </div>
            </form>

            <div class="table-responsive" id="users-table-wrapper">
                <table class="table table-striped table-borderless" id="myTable">
                    <thead>
                    <tr>
                        <th class="min-width-100">@lang('vn.Image')</th>
                        <th class="min-width-100">@lang('vn.Name')</th>
                        <th class="min-width-150">@lang('vn.Price')</th>
                        <th class="min-width-150">@lang('vn.Unit')</th>
                        <th class="min-width-150">@lang('vn.Detail')</th>
                        <th class="min-width-150">@lang('vn.Stock')</th>
                        <th class="min-width-150">Thể loại</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($components))
                        @foreach ($components as $component)
                            <tr>
                                <td><img src="{{asset('component/'.$component->image)}}" alt="" width="75px"
                                         height="75px"></td>
                                <td>{{ $component->name }}</td>
                                <td>{{ $component->prices }}đ</td>
                                <td>{{ $component->unit }}</td>
                                <td>{!!  \Illuminate\Support\Str::limit($component->description,$limit = 30, $end = '...') !!} </td>
                                <td>{{ $component->stock ?? 'Hết hàng' }}</td>
                                <td>{{$component->category_name}}</td>
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
        </div>
    </div>
@stop
@section('scripts')
    <script>
        $(document).ready(function () {
            $('#stock').on('change', function () {
                $('#users-form').submit()
            })
        })
    </script>
@endsection

