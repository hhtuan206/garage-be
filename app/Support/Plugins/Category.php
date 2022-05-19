<?php


namespace Vanguard\Support\Plugins;


use Vanguard\Support\Sidebar\Item;

class Category extends \Vanguard\Plugins\Plugin
{
    public function sidebar()
    {
        return Item::create(__('Thể loại'))
            ->route('categories.index')
            ->icon('fa fa-american-sign-language-interpreting')
            ->active("categories*");
    }
}
