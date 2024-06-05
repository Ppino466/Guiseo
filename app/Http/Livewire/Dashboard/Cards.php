<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Sale;
use App\Models\SaleDetail;
use Carbon\Carbon;
use Livewire\Component;

class Cards extends Component
{

    public $day;
    public $month;
    public $year;
    public $salesDay;
    public $salesMonth;
    public $salesYear;
    public $averageTicket;
    public $productsTicket;
    public $dayDifference;
    public $monthDifference;

    public function mount()
    {
        $this->day = date('d/m/y');
        $this->month = date('M');
        $this->getSaleDay();
        $this->getSaleMonth();
        $this->getAverageTicket();
        $this->getDayDifference();
        $this->getMonthDifference();
    }

    public function getSaleDay()
    {
        $today = Carbon::today();
        $this->salesDay = Sale::whereDate('created_at', $today)->sum('total');
    }

    public function getSaleMonth()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $this->salesMonth = Sale::whereMonth('created_at', $currentMonth)
                                 ->whereYear('created_at', $currentYear)
                                 ->sum('total');
    }

    public function getAverageTicket()
    {
        $totalSales = Sale::sum('total');
        $totalTransactions = Sale::count();
        $this->averageTicket = $totalTransactions ? $totalSales / $totalTransactions : 0;
        $totalProducts = SaleDetail::sum('quantity');
        $totalTransactions = Sale::count();

        $this->productsTicket = $totalTransactions ? floor($totalProducts / $totalTransactions) : 0;
    }

    public function getDayDifference()
    {
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();

        $salesToday = Sale::whereDate('created_at', $today)->sum('total');
        $salesYesterday = Sale::whereDate('created_at', $yesterday)->sum('total');

        $this->dayDifference = $salesYesterday > 0 ? (($salesToday - $salesYesterday) / $salesYesterday) * 100 : 0;
    }

    public function getMonthDifference()
    {
        $currentMonth = Carbon::now()->month;
        $lastMonth = Carbon::now()->subMonth()->month;
        $currentYear = Carbon::now()->year;
        $lastMonthYear = Carbon::now()->subMonth()->year;

        $salesCurrentMonth = Sale::whereMonth('created_at', $currentMonth)
                                 ->whereYear('created_at', $currentYear)
                                 ->sum('total');

        $salesLastMonth = Sale::whereMonth('created_at', $lastMonth)
                              ->whereYear('created_at', $lastMonthYear)
                              ->sum('total');

        $this->monthDifference = $salesLastMonth > 0 ? (($salesCurrentMonth - $salesLastMonth) / $salesLastMonth) * 100 : 0;
    }

    public function render()
    {
        return view('livewire.dashboard.cards');
    }
}
