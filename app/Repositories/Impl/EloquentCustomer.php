<?php


namespace Vanguard\Repositories\Impl;


use Vanguard\Models\Customer;

class EloquentCustomer extends \Vanguard\Repositories\BaseRepository implements \Vanguard\Repositories\IRepository\CustomerRepository
{

    /**
     * @inheritDoc
     */
    public function model()
    {
        return Customer::class;
    }
}
