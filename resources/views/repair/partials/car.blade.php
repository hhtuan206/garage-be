<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="first_name">@lang('vn.Number plate')</label>
            <input type="text" class="form-control input-solid"
                   name="number_plate" id="number_plate" placeholder="@lang('vn.Number plate')" value="{{ $car->number_plate ?? '' }}">
        </div>

    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="birthday">@lang('vn.Engine number')</label>
            <div class="form-group">
                <input type="text"
                       name="engine_number"
                       id="engine_number"
                       placeholder="@lang('vn.Engine number')"
                       value="{{ $car->engine_number ?? '' }}"
                       class="form-control input-solid"/>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="phone">@lang('vn.Attribute')</label>
            {!! Form::select('attribute[]',$attributes,$car->attributes  ?? '',['class'=>'form-control input-solid','multiple','id'=>'attribute']) !!}
        </div>
    </div>
</div>
