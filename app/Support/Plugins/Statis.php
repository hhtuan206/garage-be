<?php


namespace Vanguard\Support\Plugins;


use Vanguard\Support\Sidebar\Item;

class Statis extends \Vanguard\Plugins\Plugin
{
    public function sidebar()
    {
        $repair = Item::create(__('Thống kê sửa chữa'))
            ->route('statis.repair')
            ->active("admin/statisRepair*")
            ;

        $component = Item::create(__('Thống kê linh kiện tồn kho'))
            ->route('statis.component')
            ->active("admin/statisComponent*")
           ;

        return Item::create(__('Thống kê'))
            ->href('#statis-dropdown')
            ->icon('fa fa-balance-scale')
            ->addChildren([
                $repair,
                $component
            ])->permissions('admin');
    }
}
