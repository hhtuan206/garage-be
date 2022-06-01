<?php

namespace Vanguard\Providers;

use Vanguard\Plugins\VanguardServiceProvider as BaseVanguardServiceProvider;
use Vanguard\Support\Plugins\Appointment;
use Vanguard\Support\Plugins\Car;
use Vanguard\Support\Plugins\Category;
use Vanguard\Support\Plugins\Component;
use Vanguard\Support\Plugins\Dashboard\Widgets\BannedUsers;
use Vanguard\Support\Plugins\Dashboard\Widgets\LatestRegistrations;
use Vanguard\Support\Plugins\Dashboard\Widgets\NewUsers;
use Vanguard\Support\Plugins\Dashboard\Widgets\RegistrationHistory;
use Vanguard\Support\Plugins\Dashboard\Widgets\TotalUsers;
use Vanguard\Support\Plugins\Dashboard\Widgets\UnconfirmedUsers;
use Vanguard\Support\Plugins\Dashboard\Widgets\UserActions;
use Vanguard\Support\Plugins\History;
use Vanguard\Support\Plugins\Import;
use Vanguard\Support\Plugins\Repair;
use Vanguard\Support\Plugins\Service;
use Vanguard\Support\Plugins\News;
use Vanguard\Support\Plugins\Site;
use Vanguard\Support\Plugins\Statis;
use \Vanguard\UserActivity\Widgets\ActivityWidget;

class VanguardServiceProvider extends BaseVanguardServiceProvider
{
    /**
     * List of registered plugins.
     *
     * @return array
     */
    protected function plugins()
    {
        return [
            \Vanguard\Support\Plugins\Dashboard\Dashboard::class,
            \Vanguard\Support\Plugins\Users::class,
            Appointment::class,
            Repair::class,
            Service::class,
            Component::class,
            Car::class,
            Import::class,
            News::class,
            Category::class,
            Statis::class,
            Site::class,
            \Vanguard\UserActivity\UserActivity::class,
//            \Vanguard\Support\Plugins\RolesAndPermissions::class,
//            \Vanguard\Support\Plugins\Settings::class,
//            \Vanguard\Announcements\Announcements::class,

        ];
    }

    /**
     * Dashboard widgets.
     *
     * @return array
     */
    protected function widgets()
    {
        return [
            UserActions::class,
            TotalUsers::class,
            NewUsers::class,
            BannedUsers::class,
            UnconfirmedUsers::class,
            RegistrationHistory::class,
            LatestRegistrations::class,
            ActivityWidget::class,
        ];
    }
}
