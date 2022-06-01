<?php


namespace Vanguard\Support\Plugins;


use Vanguard\Support\Sidebar\Item;

class Car extends \Vanguard\Plugins\Plugin
{
    public function sidebar()
    {
        return Item::create(__('Quản lý xe'))
            ->route('cars.index')
            ->icon('fa fa-car')
            ->active("admin/cars*");
    }
}
