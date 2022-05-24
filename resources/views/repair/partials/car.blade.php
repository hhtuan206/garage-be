<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="phone">@lang('Chọn xe')</label>
            {!! Form::select('car_id',$cars,null,['class'=>'form-control input-solid']) !!}
        </div>
    </div>
</div>
