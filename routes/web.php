<?php

use App\Http\Controllers\ProyectoPdfController;
use App\Http\Controllers\ReciboPdfController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ReportController;

use App\Http\Controllers\ProfesorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// ruta imprimir ContraRecibo a PDF
Route::get('/{record}/pdf', [ReciboPdfController::class, 'download'])->name('recibo.pdf');

// ruta imprimir información de un Proyecto a PDF
Route::get('/{record}/proyecto', [ProyectoPdfController::class, 'download'])->name('proyecto.pdf');

// Estado Presupuestal en PDF
Route::get('rptEdoPtal/{tipoReporte}/{cual}', [ReportController::class, 'rptEdoPtal'])->name('rptEdoPtal');

// Estado Presupuestal a Excel
Route::get('EdoPtalExcel/{tipoReporte}/{cual}', [ReportController::class, 'EdoPtalExcel'])->name('EdoPtalExcel');

// reportes de ContraRecibos en PDF
Route::get('rptRecibos/{tipoReporte}/{cual}', [ReportController::class, 'rptRecibos'])->name('rptRecibos');


