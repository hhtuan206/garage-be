<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="first_name">@lang('Number plate')</label>
            <input type="text" class="form-control input-solid"
                   name="number_plate" id="number_plate" placeholder="@lang('Number plate')" value="{{ $car->number_plate ?? '' }}">
        </div>

    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="birthday">@lang('Engine number')</label>
            <div class="form-group">
                <input type="text"
                       name="engine_number"
                       id="engine_number"
                       placeholder="@lang('Engine number')"
                       value="{{ $car->engine_number ?? '' }}"
                       class="form-control input-solid"/>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="phone">@lang('Attribute')</label>
            {!! Form::select('attribute[]',$attributes,$car->attributes  ?? '',['class'=>'form-control input-solid','multiple','id'=>'attribute']) !!}
        </div>
    </div>
</div>
