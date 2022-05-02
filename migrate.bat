@REM php artisan make:model Models\Car -m
@REM php artisan make:model Models\Category -m
@REM php artisan make:model Models\Appointment -m
@REM php artisan make:model Models\News -m
@REM php artisan make:model Models\Service -m
@REM php artisan make:model Models\Component -m
@REM php artisan make:model Models\Attribute -m
@REM php artisan make:migrate Models\Value -m
php artisan make:migration   Car_Value
php artisan make:migration   Car_Attribute
@REM php artisan make:model Models\Repair -m
php artisan make:migration   Repair_Component
php artisan make:migration   Repair_Service
@REM php artisan make:model Models\Site -m

