@extends('layouts.app')

@section('page-title', __('vn.News'))
@section('page-heading', __('vn.News'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('vn.News')
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
                                   placeholder="@lang('Tìm theo tiêu đề')">

                            <span class="input-group-append">
                                @if (Request::has('search') && Request::get('search') != '')
                                    <a href="{{ route('news.index') }}"
                                       class="btn btn-light d-flex align-items-center text-muted"
                                       role="button">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="col-md-3 mt-md-0 mt-2">
                    </div>

                    <div class="col-md-6 text-right">
                        <a href="{{ route('news.create') }}" class="btn btn-primary btn-rounded">
                            <i class="fas fa-plus mr-2"></i>
                            @lang('vn.Add News')
                        </a>
                    </div>
                </div>
            </form>

            <div class="table-responsive" id="users-table-wrapper">
                <table class="table table-striped table-borderless">
                    <thead>
                    <tr>
                        <th class="min-width-100">@lang('vn.Title')</th>
                        <th class="min-width-150">@lang('vn.Content')</th>
                        <th class="min-width-150">Thể loại</th>
                        <th class="min-width-150">@lang('vn.Image Cover')</th>
                        <th class="text-center">@lang('vn.Action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($news))
                        @foreach ($news as $new)
                            <tr>
                                <td>{{ $new->title }}</td>
                                <td>{!!  \Illuminate\Support\Str::limit($new->content,$limit = 30, $end = '...') !!} </td>
                                <td>{{$new->category_name}}</td>
                                <td> <img src="{{asset('new/'. $new->image )}}" width="75px" height="75px"
                                          alt=""></td>
                                <td class="text-center">
                                    <a href="{{ route('news.edit', $new) }}" class="btn btn-icon"
                                       title="@lang('vn.Edit News')" data-toggle="tooltip" data-placement="top">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('news.destroy', $new) }}" class="btn btn-icon"
                                       title="@lang('vn.Delete News')"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       data-method="DELETE"
                                       data-confirm-title="@lang('vn.Please Confirm')"
                                       data-confirm-text="@lang('vn.Are you sure that you want to delete this news?')"
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
            {!! $news->links() !!}
        </div>
    </div>
@stop
