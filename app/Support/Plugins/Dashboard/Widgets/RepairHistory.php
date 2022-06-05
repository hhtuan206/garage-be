<?php

namespace Vanguard\Support\Plugins\Dashboard\Widgets;

use Carbon\Carbon;
use Vanguard\Models\Repair;
use Vanguard\Plugins\Widget;
use Vanguard\Repositories\User\UserRepository;

class RepairHistory extends Widget
{
    /**
     * {@inheritdoc}
     */
    public $width = '8';

    /**
     * @var string
     */
    protected $permissions = 'users.manage';


    /**
     * @var array Count of new users per month.
     */
    protected $repairPerMonth;


    /**
     * {@inheritdoc}
     */
    public function render()
    {
        return view('plugins.dashboard.widgets.repair-history', [
            'repairsPerMonth' => $this->getRepairsPerMonth()
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function scripts()
    {
        return view('plugins.dashboard.widgets.repair-history-scripts', [
            'repairsPerMonth' => $this->getRepairsPerMonth()
        ]);
    }

    private function getRepairsPerMonth()
    {
//        dd($this->countOfNewRepairPerMonth(
//            Carbon::now()->subYear()->startOfMonth(),
//            Carbon::now()->endOfMonth()
//        ));
        if ($this->repairPerMonth) {
            return $this->repairPerMonth;
        }

        return $this->repairPerMonth = $this->countOfNewRepairPerMonth(
            Carbon::now()->subYear()->startOfMonth(),
            Carbon::now()->endOfMonth()
        );


    }

    public function countOfNewRepairPerMonth($from, $to)
    {
        $result = Repair::whereBetween('created_at', [$from, $to])
            ->orderBy('created_at')
            ->get(['created_at'])
            ->groupBy(function ($user) {
                return $user->created_at->format("Y_n");
            });

        $counts = [];

        while ($from->lt($to)) {
            $key = $from->format("Y_n");

            $counts[$this->parseDate($key)] = count($result->get($key, []));

            $from->addMonth();
        }

        return $counts;
    }

    private function parseDate($yearMonth)
    {
        list($year, $month) = explode("_", $yearMonth);

        $month = trans("app.months.{$month}");

        return "{$month} {$year}";
    }
}
