@extends('layouts.app')

@section('page-title', __('News'))
@section('page-heading', $edit ? $news->title : __('Create New News'))

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('news.index') }}">@lang('News')</a>
    </li>
    <li class="breadcrumb-item active">
        {{ __($edit ? 'Edit' : 'Create') }}
    </li>
@stop

@section('content')

    @include('partials.messages')

    @if ($edit)
        {!! Form::open(['route' => ['news.update', $news], 'method' => 'PUT', 'id' => 'new-form','enctype' => 'multipart/form-data']) !!}
    @else
        {!! Form::open(['route' => 'news.store', 'id' => 'new-form','enctype' => 'multipart/form-data']) !!}
    @endif

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h5 class="card-title">
                        @lang('News Details')
                    </h5>
                    <p class="text-muted">
                        @lang('A general new information.')
                    </p>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="name">@lang('Title')</label>
                        <input type="text"
                               class="form-control input-solid"
                               id="title"
                               name="title"
                               placeholder="@lang('Title')"
                               value="{{ $edit ? $news->title : old('title') }}">
                    </div>
                    <div class="form-group">
                        <label for="content">@lang('Content')</label>
                        <textarea name="content"
                                  id="content"
                                  class="form-control input-solid">{{ $edit ? $news->content : old('content') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Image Cover</label>
                        <input type="file" class="form-control"  name="image_cover" id="image_cover">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">
        {{ __($edit ? 'Update News' : 'Create News') }}
    </button>

@stop

@section('scripts')

    <script src="//cdn.ckeditor.com/4.18.0/basic/ckeditor.js"></script>
    <script>CKEDITOR.replace('content');</script>
    {{--    @if ($edit)--}}
    {{--        {!! JsValidator::formRequest('Vanguard\Http\Requests\Role\UpdateRoleRequest', '#role-form') !!}--}}
    {{--    @else--}}
    {{--        {!! JsValidator::formRequest('Vanguard\Http\Requests\Role\CreateRoleRequest', '#role-form') !!}--}}
    {{--    @endif--}}
@stop
