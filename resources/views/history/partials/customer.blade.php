<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="first_name">@lang('Full Name')</label>
            <input type="text" class="form-control input-solid"
                   name="first_name" id="full_name" placeholder="@lang('First Name')" value="{{ $customer->full_name ?? '' }}">
        </div>
        <div class="form-group">
            <label for="email">@lang('Email')</label>
            <input type="text" class="form-control input-solid" id="email"
                   name="email" placeholder="@lang('Email')" value="{{ $customer->email ?? '' }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="phone">@lang('Phone')</label>
            <input type="text" class="form-control input-solid" id="phone"
                   name="phone" placeholder="@lang('Phone')" value="{{ $customer->phone ?? '' }}">
        </div>
        <div class="form-group">
            <label for="address">@lang('Address')</label>
            <input type="text" class="form-control input-solid" id="address"
                   name="address" placeholder="@lang('Address')" value="{{ $customer->address ?? '' }}">
        </div>
    </div>
</div>
