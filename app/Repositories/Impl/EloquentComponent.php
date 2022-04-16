<?php


namespace Vanguard\Repositories\Impl;


use Vanguard\Models\Component;

class EloquentComponent extends \Vanguard\Repositories\BaseRepository implements \Vanguard\Repositories\IRepository\ComponentRepository
{

    /**
     * @inheritDoc
     */
    public function model()
    {
        return Component::class;
    }
}
