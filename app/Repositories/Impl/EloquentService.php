<?php


namespace Vanguard\Repositories\Impl;


use Vanguard\Models\Service;

class EloquentService extends \Vanguard\Repositories\BaseRepository implements \Vanguard\Repositories\IRepository\ServiceRepository
{

    /**
     * @inheritDoc
     */
    public function model()
    {
        return Service::class;
    }
}
