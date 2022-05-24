<div class="row">
    <div class="mb-auto">
        <div class="mb-3">
            <label for="first_name" class="form-label">@lang('First Name')</label>
            <input type="text" class="form-control " id="first_name"
                   name="first_name" placeholder="@lang('First Name')" value="{{ $edit ? $user->first_name : '' }}">
        </div>
        <div class="mb-3">
            <label for="last_name">@lang('Last Name')</label>
            <input type="text" class="form-control " id="last_name"
                   name="last_name" placeholder="@lang('Last Name')" value="{{ $edit ? $user->last_name : '' }}">
        </div>
    </div>

    <div class="mb-auto">
        <div class="mb-3">
            <label for="birthday" class="form-label">@lang('Date of Birth')</label>
            <div class="form-group">
                <input type="text"
                       name="birthday"
                       id='birthday'
                       value="{{ $edit && $user->birthday ? $user->present()->birthday : '' }}"
                       class="form-control "/>
            </div>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">@lang('Phone')</label>
            <input type="text" class="form-control" id="phone"
                   name="phone" placeholder="@lang('Phone')" value="{{ $edit ? $user->phone : '' }}">
        </div>

    </div>
    <div class="mb-3">
        <label for="address" class="form-label">@lang('Address')</label>
        <textarea class="form-control" id="address"
                  name="address" placeholder="@lang('Address')">{{ $edit ? $user->address : '' }}</textarea>
    </div>
    @if ($edit)
        <div class="col-md-12 mb-3">
            <button type="submit" class="btn btn-primary" id="update-details-btn">
                <i class="fa fa-refresh"></i>
                @lang('Update Details')
            </button>
        </div>
    @endif
</div>
