<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="first_name">@lang('Number plate')</label>
            <input type="text" class="form-control input-solid"
                   name="number_plate" placeholder="@lang('Number plate')" value="{{ $car->number_plate ?? '' }}">
        </div>
        <div class="form-group">
            <label for="email">@lang('Chassis number')</label>
            <input type="text" class="form-control input-solid" id="email"
                   name="chassis_number" placeholder="@lang('Chassis number')" value="{{ $car->chassis_number ?? '' }}">
        </div>
        <div class="form-group">
            <label for="birthday">@lang('Engine number')</label>
            <div class="form-group">
                <input type="text"
                       name="engine_number"
                       id=''
                       placeholder="@lang('Engine number')"
                       value="{{ $car->engine_number ?? '' }}"
                       class="form-control input-solid"/>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="phone">@lang('Color')</label>
            {!! Form::select('color_id',$colors,$car->color_id ?? '',['class'=>'form-control input-solid']) !!}
        </div>
        <div class="form-group">
            <label for="phone">@lang('Type')</label>
            {!! Form::select('type_id',$types,$car->type_id  ?? '',['class'=>'form-control input-solid']) !!}
        </div>
        <div class="form-group">
            <label for="phone">@lang('Manufacturer')</label>
            {!! Form::select('manufacturer_id',$manufacturers,$car->manufacturer_id  ?? '',['class'=>'form-control input-solid']) !!}
        </div>
    </div>
</div>
