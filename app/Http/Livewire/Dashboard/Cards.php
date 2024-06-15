<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Sale;
use App\Models\SaleDetail;
use Carbon\Carbon;
use Livewire\Component;

class Cards extends Component
{
    public $selectedDate;
    public $selectedMonth;
    public $selectedYear;
    public $salesDay;
    public $salesMonth;
    public $averageTicket;
    public $productsTicket;
    public $dayDifferencePercentage;
    public $monthDifferencePercentage;

    public function mount()
    {
        $this->selectedDate = Carbon::today()->format('Y-m-d');
        $this->selectedMonth = Carbon::today()->format('m');
        $this->selectedYear = Carbon::today()->format('Y'); 
        $this->updateSalesDay();
        $this->updateSalesMonth();
        $this->getAverageTicket();
        $this->getDayDifference();
        $this->getMonthDifference();
    }

    public function updateSalesDay()
    {
        try {
            $this->salesDay = Sale::whereDate('created_at', $this->selectedDate)->sum('total');
        } catch (\Exception $e) {
            $this->salesDay = 0;
            
        }
    }

    public function updateSalesMonth()
    {
        try {
            $this->salesMonth = Sale::whereMonth('created_at', $this->selectedMonth)
                                    ->whereYear('created_at', $this->selectedYear)
                                    ->sum('total');
        } catch (\Exception $e) {
            $this->salesMonth = 0;
            
        }
    }

    public function updatedSelectedDate($value)
    {
        $date = Carbon::parse($value);
        $this->selectedDate = $date->format('Y-m-d');
        $this->selectedMonth = $date->format('m');
        $this->selectedYear = $date->format('Y');
        $this->updateSalesDay();
        $this->updateSalesMonth();
        $this->getDayDifference();      
        $this->getMonthDifference();
    }

    public function getDayDifference()
    {
        try {
            $selectedDate = Carbon::parse($this->selectedDate);
            $yesterday = $selectedDate->copy()->subDay();
            
            $salesToday = Sale::whereDate('created_at', $selectedDate)->sum('total');
            $salesYesterday = Sale::whereDate('created_at', $yesterday)->sum('total');
    
            $this->dayDifferencePercentage = $salesYesterday > 0 ? (($salesToday - $salesYesterday) / $salesYesterday) * 100 : 0;
        } catch (\Exception $e) {
            $this->dayDifferencePercentage = 0;
        }
    }
    


    public function getMonthDifference()
    {
        try {
            $selectedDate = Carbon::parse($this->selectedDate);
            
            $currentMonth = $selectedDate->month;
            $currentYear = $selectedDate->year;
            
            $lastMonth = $selectedDate->copy()->subMonth()->month;
            $lastMonthYear = $selectedDate->copy()->subMonth()->year;
            
            $salesCurrentMonth = Sale::whereMonth('created_at', $currentMonth)
                                    ->whereYear('created_at', $currentYear)
                                    ->sum('total');
            
            $salesLastMonth = Sale::whereMonth('created_at', $lastMonth)
                                  ->whereYear('created_at', $lastMonthYear)
                                  ->sum('total');
            
            $this->monthDifferencePercentage = $salesLastMonth > 0 ? (($salesCurrentMonth - $salesLastMonth) / $salesLastMonth) * 100 : 0;
        } catch (\Exception $e) {
            $this->monthDifferencePercentage = 0;
        }
    }
    

    public function getAverageTicket()
    {
        try {
            $totalSales = Sale::sum('total');
            $totalTransactions = Sale::count();
            $this->averageTicket = $totalTransactions ? $totalSales / $totalTransactions : 0;

            $totalProducts = SaleDetail::sum('quantity');
            $this->productsTicket = $totalTransactions ? floor($totalProducts / $totalTransactions) : 0;
        } catch (\Exception $e) {
            $this->averageTicket = 0;
            $this->productsTicket = 0;
            
        }
    }

    public function getMonthName($month)
    {
        $monthNames = [
            '01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril',
            '05' => 'Mayo', '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto',
            '09' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre',
        ];

        return $monthNames[$month];
    }

    public function render()
    {
        return view('livewire.dashboard.cards');
    }
}
