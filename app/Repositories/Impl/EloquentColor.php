<?php


namespace Vanguard\Repositories\Impl;


use Vanguard\Models\Color;

class EloquentColor extends \Vanguard\Repositories\BaseRepository implements \Vanguard\Repositories\IRepository\ColorRepository
{

    /**
     * @inheritDoc
     */
    public function model()
    {
        return Color::class;
    }
}
