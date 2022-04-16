<?php


namespace Vanguard\Repositories\Impl;


use Vanguard\Models\Insurance;

class EloquentInsurance extends \Vanguard\Repositories\BaseRepository implements \Vanguard\Repositories\IRepository\InsuranceRepository
{

    /**
     * @inheritDoc
     */
    public function model()
    {
        return Insurance::class;
    }
}
