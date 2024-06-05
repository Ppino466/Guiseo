<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Charts extends Component
{

    public $salesByDay;
    public $salesByMonth;
    public $totalSalesYear;
    public $totalSalesWeek;

    public function mount()
    {
        $this->salesByDay = $this->getSalesByDay();
        $this->salesByMonth = $this->getSalesByMonth();
        $this->totalSalesYear = $this->getTotalSalesYear();
        $this->totalSalesWeek = $this->getTotalSalesWeek();
    }

    public function getSalesByDay()
    {
        $currentWeek = Carbon::now()->startOfWeek()->subDay();
        $sales = Sale::select(
            DB::raw('ELT(DAYOFWEEK(created_at), "Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado") as day'),
            DB::raw('SUM(total) as total')
        )
            ->whereDate('created_at', '>=', $currentWeek)
            ->groupBy('day')
            ->get();

        return $sales->pluck('total', 'day')->toArray();
    }

    public function getSalesByMonth()
    {
        $currentYear = Carbon::now()->year;
        $sales = Sale::select(
            DB::raw('ELT(MONTH(created_at), "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic") as month'),
            DB::raw('SUM(total) as total')
        )
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->get();

        return $sales->pluck('total', 'month')->toArray();
    }

    public function getTotalSalesYear()
    {
        $currentYear = Carbon::now()->year;
        $totalSalesYear = Sale::whereYear('created_at', $currentYear)->sum('total');
        return $totalSalesYear;
    }

    public function getTotalSalesWeek()
    {
        $currentWeek = Carbon::now()->startOfWeek()->subDay();
        $totalSalesWeek = Sale::whereDate('created_at', '>=', $currentWeek)->sum('total');
        return $totalSalesWeek;
    }


    public function render()
    {
        return view('livewire.dashboard.charts');
    }
}
