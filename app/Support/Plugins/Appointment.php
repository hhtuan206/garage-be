<?php


namespace Vanguard\Support\Plugins;


use Vanguard\Support\Sidebar\Item;

class Appointment extends \Vanguard\Plugins\Plugin
{
    public function sidebar()
    {
        return Item::create(__('Appointment'))
            ->route('appointments.index')
            ->icon('fas fa-book-open')
            ->active("appointments*");
    }
}
