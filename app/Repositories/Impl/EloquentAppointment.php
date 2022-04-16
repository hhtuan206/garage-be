<?php


namespace Vanguard\Repositories\Impl;


use Vanguard\Models\Appointment;

class EloquentAppointment extends \Vanguard\Repositories\BaseRepository implements \Vanguard\Repositories\IRepository\AppointmentRepository
{

    /**
     * @inheritDoc
     */
    public function model()
    {
        return Appointment::class;
    }
}
