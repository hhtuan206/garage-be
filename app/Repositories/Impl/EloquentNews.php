<?php


namespace Vanguard\Repositories\Impl;


use Vanguard\Models\News;

class EloquentNews extends \Vanguard\Repositories\BaseRepository implements \Vanguard\Repositories\IRepository\NewsRepository
{

    /**
     * @inheritDoc
     */
    public function model()
    {
        return News::class;
    }
}
