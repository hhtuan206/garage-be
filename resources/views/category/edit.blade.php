@extends('layouts.app')

@section('page-title', __('Attributes'))
@section('page-heading', __('Attributes'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Attribute')
    </li>
@stop

@section('content')

    @include('partials.messages')
    <div class="row ">
        <div class="col-md-6 mx-auto">
            <div class="card">
                {!! Form::open(['route' => ['categories.update',$category],'method' => 'PUT', 'id' => 'option-form']) !!}
                <div class="card-header">
                    Thông tin thể loại
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">@lang('vn.Name')</label>
                                <input type="text"
                                       class="form-control input-solid"
                                       id="name"
                                       name="name"
                                       placeholder="Tên thể loại"
                                       value="{{$category->name}}">
                            </div>
                            <div class="form-group">
                                <label for="detail">Thuộc</label>
                                {!! Form::select('type',['component' => 'Linh kiện', 'news' => 'Tin tức'], null,['class'=> 'form-control input-solid']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">
                        @lang('vn.Save')
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop
