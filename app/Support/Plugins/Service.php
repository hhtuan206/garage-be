<?php


namespace Vanguard\Support\Plugins;


use Vanguard\Plugins\Plugin;
use Vanguard\Support\Sidebar\Item;

class Service extends Plugin
{
    public function sidebar()
    {
        return Item::create(__('vn.Services'))
            ->route('services.index')
            ->icon('fab fa-servicestack')
            ->active("services*");
    }
}
