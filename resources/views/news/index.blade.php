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
                        <a href="{{ route('news.create') }}" class="btn btn-primary btn-rounded">
                            <i class="fas fa-plus mr-2"></i>
                            @lang('vn.Add News')
                        </a>
                    </div>
                </div>
            </div>

            <div class="table-responsive" id="users-table-wrapper">
                <table class="table table-striped table-borderless">
                    <thead>
                    <tr>
                        <th class="min-width-100">@lang('vn.Title')</th>
                        <th class="min-width-150">@lang('vn.Content')</th>
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
                                <td> <img
                                    class="rounded-squares img-responsive"
                                    width="40"
                                    src="{{asset('new/'.$new->image_cover)}}"
                                    alt="{!! $new->title  !!}"></td>
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
