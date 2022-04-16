<?php


namespace Vanguard\Repositories\Impl;


use Vanguard\Models\Car;
use Vanguard\Repositories\BaseRepository;
use Vanguard\Repositories\IRepository\CarRepository;

class EloquentCar extends BaseRepository implements CarRepository
{

    public function model()
    {
        return Car::class;
    }
}
