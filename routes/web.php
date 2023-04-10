<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HrController;
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

Auth::routes();

Route::middleware(['admin'])->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/pendingleave', [HrController::class, 'pendingLeave'])->name('pendingleave');
    Route::get('/approveleave', [HrController::class, 'approveLeave'])->name('approveleave');
    Route::get('/rejectedleave', [HrController::class, 'rejectedLeave'])->name('rejectedleave');
    Route::get('/editstatus/{id}', [HrController::class, 'editstatus'])->name('editstatus');
    Route::post('/statusupdate/{id}', [HrController::class, 'update'])->name('statusupdate');
  });

Route::middleware(['employee'])->group(function(){

    Route::resource('employee', EmployeeController::class);
    Route::get('/remainLeave', [EmployeeController::class, 'remainLeave'])->name('remainLeave');
});


