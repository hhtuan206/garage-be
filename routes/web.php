<?php

/**
 * Authentication
 */
Route::get('login', 'Auth\LoginController@show')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('auth.logout');

Route::group(['middleware' => ['registration', 'guest']], function () {
    Route::get('register', 'Auth\RegisterController@show')->name('register');
    Route::post('register', 'Auth\RegisterController@register');
});

Route::emailVerification();

Route::group(['middleware' => ['password-reset', 'guest']], function () {
    Route::resetPassword();
});

/**
 * Two-Factor Authentication
 */
Route::group(['middleware' => 'two-factor'], function () {
    Route::get('auth/two-factor-authentication', 'Auth\TwoFactorTokenController@show')->name('auth.token');
    Route::post('auth/two-factor-authentication', 'Auth\TwoFactorTokenController@update')->name('auth.token.validate');
});

/**
 * Social Login
 */
Route::get('auth/{provider}/login', 'Auth\SocialAuthController@redirectToProvider')->name('social.login');
Route::get('auth/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');

/**
 * Impersonate Routes
 */
Route::group(['middleware' => 'auth'], function () {
    Route::impersonate();
});


/**
 * Installation
 */

Route::group(['prefix' => 'install'], function () {
    Route::get('/', 'InstallController@index')->name('install.start');
    Route::get('requirements', 'InstallController@requirements')->name('install.requirements');
    Route::get('permissions', 'InstallController@permissions')->name('install.permissions');
    Route::get('database', 'InstallController@databaseInfo')->name('install.database');
    Route::get('start-installation', 'InstallController@installation')->name('install.installation');
    Route::post('start-installation', 'InstallController@installation')->name('install.installation');
    Route::post('install-app', 'InstallController@install')->name('install.install');
    Route::get('complete', 'InstallController@complete')->name('install.complete');
    Route::get('error', 'InstallController@error')->name('install.error');
});


Route::post('findCustomer', 'Users\UsersController@findCustomer')->name('findCustomer');
Route::post('render-component', 'Backend\ComponentController@renderComponent')->name('render-component');
Route::post('render-attribute', 'Backend\AttributeController@renderAttribute')->name('render-attribute');
Route::group(['prefix' => 'admin', 'middleware' => ['auth','admin']], function () {
    Route::group(['middleware' => ['auth', 'verified']], function () {

        /**
         * Dashboard
         */

        Route::get('/', 'DashboardController@index')->name('dashboard');

        /**
         * User Profile
         */

        Route::group(['prefix' => 'profile', 'namespace' => 'Profile'], function () {
            Route::get('/', 'ProfileController@show')->name('profile');
            Route::get('activity', 'ActivityController@show')->name('profile.activity');
            Route::put('details', 'DetailsController@update')->name('profile.update.details');

            Route::post('avatar', 'AvatarController@update')->name('profile.update.avatar');
            Route::post('avatar/external', 'AvatarController@updateExternal')
                ->name('profile.update.avatar-external');

            Route::put('login-details', 'LoginDetailsController@update')
                ->name('profile.update.login-details');

            Route::get('sessions', 'SessionsController@index')
                ->name('profile.sessions')
                ->middleware('session.database');

            Route::delete('sessions/{session}/invalidate', 'SessionsController@destroy')
                ->name('profile.sessions.invalidate')
                ->middleware('session.database');
        });

        /**
         * Two-Factor Authentication Setup
         */

        Route::group(['middleware' => 'two-factor'], function () {
            Route::post('two-factor/enable', 'TwoFactorController@enable')->name('two-factor.enable');

            Route::get('two-factor/verification', 'TwoFactorController@verification')
                ->name('two-factor.verification')
                ->middleware('verify-2fa-phone');

            Route::post('two-factor/resend', 'TwoFactorController@resend')
                ->name('two-factor.resend')
                ->middleware('throttle:1,1', 'verify-2fa-phone');

            Route::post('two-factor/verify', 'TwoFactorController@verify')
                ->name('two-factor.verify')
                ->middleware('verify-2fa-phone');

            Route::post('two-factor/disable', 'TwoFactorController@disable')->name('two-factor.disable');
        });


        /**
         * User Management
         */
        Route::resource('users', 'Users\UsersController')
            ->except('update')->middleware('permission:users.manage');

        Route::group(['prefix' => 'users/{user}', 'middleware' => 'permission:users.manage'], function () {
            Route::put('update/details', 'Users\DetailsController@update')->name('users.update.details');
            Route::put('update/login-details', 'Users\LoginDetailsController@update')
                ->name('users.update.login-details');

            Route::post('update/avatar', 'Users\AvatarController@update')->name('user.update.avatar');
            Route::post('update/avatar/external', 'Users\AvatarController@updateExternal')
                ->name('user.update.avatar.external');

            Route::get('sessions', 'Users\SessionsController@index')
                ->name('user.sessions')->middleware('session.database');

            Route::delete('sessions/{session}/invalidate', 'Users\SessionsController@destroy')
                ->name('user.sessions.invalidate')->middleware('session.database');

            Route::post('two-factor/enable', 'TwoFactorController@enable')->name('user.two-factor.enable');
            Route::post('two-factor/disable', 'TwoFactorController@disable')->name('user.two-factor.disable');
        });

        /**
         * Roles & Permissions
         */
        Route::group(['namespace' => 'Authorization'], function () {
            Route::resource('roles', 'RolesController')->except('show')->middleware('permission:roles.manage');

            Route::post('permissions/save', 'RolePermissionsController@update')
                ->name('permissions.save')
                ->middleware('permission:permissions.manage');

            Route::resource('permissions', 'PermissionsController')->middleware('permission:permissions.manage');
        });


        /**
         * Settings
         */

        Route::get('settings', 'SettingsController@general')->name('settings.general')
            ->middleware('permission:settings.general');

        Route::post('settings/general', 'SettingsController@update')->name('settings.general.update')
            ->middleware('permission:settings.general');

        Route::get('settings/auth', 'SettingsController@auth')->name('settings.auth')
            ->middleware('permission:settings.auth');

        Route::post('settings/auth', 'SettingsController@update')->name('settings.auth.update')
            ->middleware('permission:settings.auth');

        if (config('services.authy.key')) {
            Route::post('settings/auth/2fa/enable', 'SettingsController@enableTwoFactor')
                ->name('settings.auth.2fa.enable')
                ->middleware('permission:settings.auth');

            Route::post('settings/auth/2fa/disable', 'SettingsController@disableTwoFactor')
                ->name('settings.auth.2fa.disable')
                ->middleware('permission:settings.auth');
        }

        Route::post('settings/auth/registration/captcha/enable', 'SettingsController@enableCaptcha')
            ->name('settings.registration.captcha.enable')
            ->middleware('permission:settings.auth');

        Route::post('settings/auth/registration/captcha/disable', 'SettingsController@disableCaptcha')
            ->name('settings.registration.captcha.disable')
            ->middleware('permission:settings.auth');

        Route::get('settings/notifications', 'SettingsController@notifications')
            ->name('settings.notifications')
            ->middleware('permission:settings.notifications');

        Route::post('settings/notifications', 'SettingsController@update')
            ->name('settings.notifications.update')
            ->middleware('permission:settings.notifications');

        /**
         * Activity Log
         */


        Route::get('activity/user/{user}/log', 'Users\ActivityController@index')->name('activity.user')
            ->middleware('permission:users.activity');
    });
    Route::resource('services', 'Backend\ServiceController')->middleware('permission:view.service,edit.service');
    Route::resource('components', 'Backend\ComponentController');
    Route::post('updateStock/{id}', 'Backend\ComponentController@updateStock')->name('component.updateStock');
    Route::resource('news', 'Backend\NewsController');
    Route::resource('values', 'Backend\ValueController');
    Route::resource('attributes', 'Backend\AttributeController');
    Route::get('edit-attributes/{attribute}', 'Backend\AttributeController@editValue')->name('attribute.editAttributeValue');
    Route::resource('categories', 'Backend\CategoryController');
    Route::resource('repairs', 'Backend\RepairController');
    Route::resource('appointments', 'Backend\AppointmentController');
    Route::resource('site', 'Backend\SiteController');
    Route::resource('categories', 'Backend\CategoryController');
    Route::resource('cars', 'Backend\CarController');
    Route::get('/statisRepair', 'Backend\StatisController@statisRepair')->name('statis.repair');
    Route::get('/statisComponent', 'Backend\StatisController@statisComponent')->name('statis.component');
    Route::group(['prefix' => 'import', 'middleware' => 'auth'], function () {
        Route::get('/', 'ImportController@index')->name('imports.index');
        Route::get('service', 'ImportController@exportService')->name('exports.service');
        Route::post('service', 'ImportController@importService')->name('imports.service');
        Route::get('component', 'ImportController@exportComponent')->name('exports.component');
        Route::post('component', 'ImportController@importComponent')->name('imports.component');

    });
});

Route::get('/', 'Client\ClientController@index')->name('customer.home');
Route::get('/appointment', 'Client\AppointmentController@index')->name('customer.appointment')->middleware('auth');
Route::get('/about', 'Client\ClientController@about')->name('customer.about');
Route::get('/components', 'Client\ClientController@component')->name('customer.component');
Route::get('/services', 'Client\ClientController@service')->name('customer.service');
Route::get('/contact', 'Client\ClientController@contact')->name('customer.contact');
Route::get('/news/{new}', 'Client\ClientController@news')->name('customer.new');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', 'Client\UsersController@index')->name('customer.profile');
    Route::put('/profile/{user}', 'Client\UsersController@update')->name('customer.updateProfile');
    Route::get('/repair', 'Client\UsersController@repair')->name('customer.viewRepair');
    Route::get('/appointments', 'Client\AppointmentController@history')->name('customer.viewAppointment');
    Route::post('/appointments', 'Client\AppointmentController@store')->name('customer.store');
});
Route::get('activity', 'ActivityController@index')->name('activity.index')
    ->middleware('permission:users.activity');

Route::get('/detailComponent/{id}', 'Client\ClientController@getDetailComponent')->name('detail.com');
Route::post('/getCar', 'Backend\RepairController@getCar')->name('getCar');


