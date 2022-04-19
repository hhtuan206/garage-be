<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="first_name">@lang('Code')</label>
            <input type="text" class="form-control input-solid"
                   name="code" placeholder="@lang('Code')" value="">
        </div>
        <div class="form-group">
            <label for="email">@lang('Date Expired')</label>
            <input type="text" class="form-control input-solid" id="email"
                   name="date-expired" placeholder="@lang('Date Expired')" value="">
        </div>
        <div class="form-group">
            <label for="birthday">@lang('Status')</label>
            {!! Form::select('status',['0'=>'None','1'=>"Yes"],null,['class'=>'form-control input-solid']) !!}
        </div>
    </div>
</div>
