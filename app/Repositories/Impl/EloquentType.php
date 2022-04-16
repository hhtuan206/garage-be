<?php


namespace Vanguard\Repositories\Impl;


use Vanguard\Models\Type;

class EloquentType extends \Vanguard\Repositories\BaseRepository implements \Vanguard\Repositories\IRepository\TypeRepository
{

    /**
     * @inheritDoc
     */
    public function model()
    {
        return Type::class;
    }
}
