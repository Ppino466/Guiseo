<?php

use App\Http\Livewire\Auth\ForgotPassword;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\ResetPassword;
use App\Http\Livewire\Billing;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\ExampleLaravel\UserManagement;
use App\Http\Livewire\ExampleLaravel\UserProfile;
use App\Http\Livewire\Log\Log as LogView;
use App\Http\Livewire\Notifications;
use App\Http\Livewire\Profile;
use App\Http\Livewire\RTL;
use App\Http\Livewire\Sale\ListSales;
use App\Http\Livewire\Sale\Sales;
use App\Http\Livewire\StaticSignIn;
use App\Http\Livewire\StaticSignUp;
use App\Http\Livewire\Tables;
use App\Http\Livewire\User\Users;
use App\Http\Livewire\Product\Product;
use App\Http\Livewire\User\UserView;
use App\Http\Livewire\VirtualReality;
use App\Http\Livewire\Suplier\Supliers;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');

});

Route::get('forgot-password', ForgotPassword::class)->middleware('guest')->name('password.forgot');
Route::get('reset-password/{id}', ResetPassword::class)->middleware('signed')->name('reset-password');



Route::get('sign-up', Register::class)->middleware('guest')->name('register');
Route::get('sign-in', Login::class)->middleware('guest')->name('login');

Route::get('user-profile', UserProfile::class)->middleware('auth')->name('user-profile');
Route::get('user-management', UserManagement::class)->middleware('auth')->name('user-management');

Route::group(['middleware' => 'auth'], function () {
    
    Route::group(['middleware' => ['role:Administrador|Master']], function () {
      
  // Ruta dashboard
  Route::get('dashboard', Dashboard::class)->name('dashboard');

        // Rutas users
        Route::get('users', Users::class)->name('usuarios');
      

        // Rutas Activity log
        Route::get('log', LogView::class)->name('activity log');

        // Rutas Suppliers
        Route::get('supliers', Supliers::class)->name('Proveedores');
    });

    Route::group(['middleware' => ['role:Administrador|Master|Vendedor']], function () {

          // Ruta perfil
        Route::get('user/{id}', UserView::class)->name('usuario');
        

        // Rutas Ventas
        Route::get('venta', Sales::class)->name('venta');
        Route::get('ventas', ListSales::class)->name('lista-ventas');

        // Ruta Products
        Route::get('products', Product::class)->name('productos');
    });
});

