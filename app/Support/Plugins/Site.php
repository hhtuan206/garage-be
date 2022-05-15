<?php


namespace Vanguard\Support\Plugins;


use Vanguard\Support\Sidebar\Item;

class Site extends \Vanguard\Plugins\Plugin
{
    public function sidebar()
    {
        return Item::create(__('vn.Site'))
            ->route('site.index')
            ->icon('fa fa-sitemap')
            ->active("site*");
    }
}
