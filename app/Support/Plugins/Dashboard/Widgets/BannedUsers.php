<?php

namespace Vanguard\Support\Plugins\Dashboard\Widgets;

use Vanguard\Models\Component;
use Vanguard\Plugins\Widget;
use Vanguard\Repositories\User\UserRepository;
use Vanguard\Support\Enum\UserStatus;

class BannedUsers extends Widget
{
    /**
     * {@inheritdoc}
     */
    public $width = '3';

    /**
     * {@inheritdoc}
     */
    protected $permissions = 'users.manage';


    /**
     * {@inheritDoc}
     */
    public function render()
    {
        return view('plugins.dashboard.widgets.all-component', [
            'count' => Component::where('stock', '>', 0)->count()
        ]);
    }
}
