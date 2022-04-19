<?php


namespace Vanguard\Support\Plugins;


use Vanguard\Support\Sidebar\Item;

class History extends \Vanguard\Plugins\Plugin
{
    public function sidebar()
    {
        return Item::create(__('History'))
            ->route('histories.index')
            ->icon('fas fa-history')
            ->active("histories*");
    }
}
