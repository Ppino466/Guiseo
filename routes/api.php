<?php

use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/sales/year', function () {
    $currentYear = Carbon::now()->year;
    $totalSalesYear = Sale::whereYear('created_at', $currentYear)->sum('total');
    return response()->json(['total_sales_year' => $totalSalesYear]);
});

Route::get('/sales/month/{month}', function ($month) {
    $salesByMonth = Sale::select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(total) as total'))
        ->whereMonth('created_at', $month)
        ->groupBy('month')
        ->first();

    return response()->json(['total_sales_month' => $salesByMonth ? $salesByMonth->total : 0]);
});

Route::get('/sales/week', function () {
    $currentWeek = Carbon::now()->startOfWeek()->subDay();
    $totalSalesWeek = Sale::whereDate('created_at', '>=', $currentWeek)->sum('total');
    return response()->json(['total_sales_week' => $totalSalesWeek]);
});

Route::get('/sales/day', function () {
    $currentDay = Carbon::now()->startOfDay();
    $totalSalesDay = Sale::whereDate('created_at', $currentDay)->sum('total');
    return response()->json(['total_sales_day' => $totalSalesDay]);
});
