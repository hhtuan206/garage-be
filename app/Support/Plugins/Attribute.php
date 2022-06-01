<?php


namespace Vanguard\Support\Plugins;


use Vanguard\Support\Sidebar\Item;

class Attribute extends \Vanguard\Plugins\Plugin
{
    public function sidebar()
    {
        return Item::create(__('Quản lý tuỳ chọn'))
            ->route('attributes.index')
            ->icon('fa fa-american-sign-language-interpreting')
            ->active("admin/attributes*")->permissions('admin');
    }
}
