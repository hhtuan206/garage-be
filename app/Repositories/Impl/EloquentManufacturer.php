<?php


namespace Vanguard\Repositories\Impl;


use Vanguard\Models\Manufacturer;

class EloquentManufacturer extends \Vanguard\Repositories\BaseRepository implements \Vanguard\Repositories\IRepository\ManufacturerRepository
{

    /**
     * @inheritDoc
     */
    public function model()
    {
        return Manufacturer::class;
    }
}
