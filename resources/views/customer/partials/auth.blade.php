<div class="mb-3">
    <label for="email" class="form-label">@lang('Email')</label>
    <input type="email"
           class="form-control input-solid"
           id="email"
           name="email"
           placeholder="@lang('Email')"
           value="{{ $edit ? $user->email : '' }}">
</div>

<div class="mb-3">
    <label for="username" class="form-label">@lang('Username')</label>
    <input type="text"
           class="form-control input-solid"
           id="username"
           placeholder="(@lang('optional'))"
           name="username"
           value="{{ $edit ? $user->username : '' }}">
</div>

<div class="mb-3">
    <label for="password" class="form-label">{{ $edit ? __("New Password") : __('Password') }}</label>
    <input type="password"
           class="form-control input-solid"
           id="password"
           name="password"
           @if ($edit) placeholder="@lang("Leave field blank if you don't want to change it")" @endif>
</div>

<div class="mb-3">
    <label for="password_confirmation" class="form-label">{{ $edit ? __("Confirm New Password") : __('Confirm Password') }}</label>
    <input type="password"
           class="form-control input-solid"
           id="password_confirmation"
           name="password_confirmation"
           @if ($edit) placeholder="@lang("Leave field blank if you don't want to change it")" @endif>
</div>

@if ($edit)
    <button type="submit" class="btn btn-primary mt-2" id="update-login-details-btn">
        <i class="fa fa-refresh"></i>
        @lang('Update Details')
    </button>
@endif
