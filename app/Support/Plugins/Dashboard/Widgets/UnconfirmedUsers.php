<?php

namespace Vanguard\Support\Plugins\Dashboard\Widgets;

use Illuminate\Support\Carbon;
use Vanguard\Models\Repair;
use Vanguard\Plugins\Widget;
use Vanguard\Repositories\User\UserRepository;
use Vanguard\Support\Enum\UserStatus;

class UnconfirmedUsers extends Widget
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
     * {@inheritdoc}
     */
    public function render()
    {
        return view('plugins.dashboard.widgets.repair', [
            'count' => Repair::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count()
        ]);
    }
}
