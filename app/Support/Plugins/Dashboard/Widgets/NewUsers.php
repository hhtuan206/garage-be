<?php

namespace Vanguard\Support\Plugins\Dashboard\Widgets;


use Vanguard\Models\Appointment;
use Vanguard\Plugins\Widget;

class NewUsers extends Widget
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
        return view('plugins.dashboard.widgets.appointment', [
            'count' => Appointment::where('status','Waiting')->count()
        ]);
    }
}
