
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <div class="form-group">
                <label for="phone">@lang('vn.Phone')</label>
                <input type="text" class="form-control input-solid" id="phone"
                       name="phone" placeholder="@lang('vn.Phone')" value="{{ $customer->phone ?? '' }}">
            </div>
        </div>
        <div class="form-group">
            <label for="email">@lang('vn.Email')</label>
            <input type="text" class="form-control input-solid" id="email"
                   name="email" placeholder="@lang('vn.Email')" value="{{ $customer->email ?? '' }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="first_name">@lang('vn.Full Name')</label>
            <input type="text" class="form-control input-solid"
                   name="full_name" id="full_name" placeholder="@lang('vn.Full Name')"
                   value="{{ $customer->full_name ?? '' }}">
        </div>
        <div class="form-group">
            <label for="address">@lang('vn.Address')</label>
            <input type="text" class="form-control input-solid" id="address"
                   name="address" placeholder="@lang('vn.Address')" value="{{ $customer->address ?? '' }}">
        </div>
    </div>
</div>
