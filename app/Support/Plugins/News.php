<?php


namespace Vanguard\Support\Plugins;


use Vanguard\Plugins\Plugin;
use Vanguard\Support\Sidebar\Item;

class News extends Plugin
{
    public function sidebar()
    {
        return Item::create(__('vn.News'))
            ->route('news.index')
            ->icon('fas fa-newspaper')
            ->active("admin/news*");
    }
}
