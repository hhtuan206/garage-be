<?php


namespace Vanguard\Support\Plugins;


use Vanguard\Support\Sidebar\Item;

class Component extends \Vanguard\Plugins\Plugin
{
    public function sidebar()
    {
        return Item::create(__('vn.Component'))
            ->route('components.index')
            ->icon('fas fa-compass')
            ->active("components*");
    }
}
