<?php


namespace Vanguard\Support\Plugins;


use Vanguard\Support\Sidebar\Item;

class Repair extends \Vanguard\Plugins\Plugin
{
    public function sidebar()
    {
        return Item::create(__('vn.Repair'))
            ->route('repairs.index')
            ->icon('fas fa-car')
            ->active("repairs*");
    }
}
