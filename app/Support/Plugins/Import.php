<?php


namespace Vanguard\Support\Plugins;


use Vanguard\Support\Sidebar\Item;

class Import extends \Vanguard\Plugins\Plugin
{
    public function sidebar()
    {
        return Item::create(__('vn.Import'))
            ->route('imports.index')
            ->icon('fas fa-rainbow')
            ->active("imports*")->permissions('admin');
    }
}
