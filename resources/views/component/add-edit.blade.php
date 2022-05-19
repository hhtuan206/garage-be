@extends('layouts.app')

@section('page-title', __('vn.Component'))
@section('page-heading', $edit ? $component->name : __('vn.Create New Component'))

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('components.index') }}">@lang('vn.Component')</a>
    </li>
    <li class="breadcrumb-item active">
        {{ __($edit ? 'vn.Edit' : 'vn.Create') }}
    </li>
@stop

@section('content')

    @include('partials.messages')

    @if ($edit)
        {!! Form::open(['route' => ['components.update', $component], 'method' => 'PUT', 'id' => 'component-form', 'enctype' => 'multipart/form-data']) !!}
    @else
        {!! Form::open(['route' => 'components.store', 'id' => 'component-form', 'enctype' => 'multipart/form-data']) !!}
    @endif

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h5 class="card-title">
                        @lang('vn.Component Details')
                    </h5>
                    <p class="text-muted">
                        @lang('vn.A general component information.')
                    </p>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="name">@lang('vn.Name')</label>
                        <input type="text"
                               class="form-control input-solid"
                               id="name"
                               name="name"
                               placeholder="@lang('vn.Component')"
                               value="{{ $edit ? $component->name : old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="price">@lang('vn.Price')</label>
                        <input type="text"
                               class="form-control input-solid"
                               id="price"
                               name="price"
                               placeholder="@lang('vn.Price')"
                               value="{{ $edit ? $component->price : old('price') }}">
                    </div>
                    <div class="form-group">
                        <label for="discount">@lang('vn.Unit')</label>
                        <input type="text"
                               class="form-control input-solid"
                               id="unit"
                               name="unit"
                               placeholder="@lang('vn.Unit')"
                               value="{{ $edit ? $component->unit : old('unit') }}">
                    </div>
                    <div class="form-group">
                        <label for="stock">@lang('vn.Stock')</label>
                        <input type="text"
                               class="form-control input-solid"
                               id="stock"
                               name="stock"
                               placeholder="@lang('vn.Stock')"
                               value="{{ $edit ? $component->stock : old('stock') }}">
                    </div>
                    <div class="form-group">
                        <label for="detail">@lang('vn.Description')</label>
                        <textarea name="description"
                                  id="description"
                                  class="form-control input-solid">{{ $edit ? $component->description : old('description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="detail">Thể loại</label>
                        {!! Form::select('category_id',$categories, $component->category_id ?? '',['class'=> 'form-control input-solid']) !!}
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                @if($edit)
                                    <img src="{{asset('component/'. $component->image )}}" width="75px" height="75px"
                                         alt="">
                                @else
                                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                @endif
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputGroupFile01"
                                       aria-describedby="inputGroupFileAddon01" name="image">
                                <label class="custom-file-label" id="display" for="inputGroupFile01">Choose file</label>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">
        {{ __($edit ? 'vn.Update Component' : 'vn.Create Component') }}
    </button>

@stop

@section('scripts')

    <script src="//cdn.ckeditor.com/4.18.0/basic/ckeditor.js"></script>
    <script>
        $(document).ready(function () {
            CKEDITOR.replace('description');

            $('#inputGroupFileAddon01').on('change', function () {
                var fileName = $(this).val();
                $(this).next('#display').html(fileName);
            })
        })

    </script>
    {{--    @if ($edit)--}}
    {{--        {!! JsValidator::formRequest('Vanguard\Http\Requests\Role\UpdateRoleRequest', '#role-form') !!}--}}
    {{--    @else--}}
    {{--        {!! JsValidator::formRequest('Vanguard\Http\Requests\Role\CreateRoleRequest', '#role-form') !!}--}}
    {{--    @endif--}}
@stop
