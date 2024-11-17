<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MascotaController;
use App\Http\Controllers\PropietarioController;

Route::get('/', function () { return view('welcome'); });

Route::get('/mascotas', [MascotaController::class, 'index'])->name('mascotas.index');
Route::get('/mascotas/create', [MascotaController::class, 'create'])->name('mascotas.create');
Route::post('/mascotas', [MascotaController::class, 'store'])->name('mascotas.store');

Route::get('/mascotas/{id}', [MascotaController::class, 'show'])->name('mascotas.show');
Route::get('/mascotas/{id}/edit', [MascotaController::class, 'edit'])->name('mascotas.edit');
Route::put('/mascotas/{id}', [MascotaController::class, 'update'])->name('mascotas.update');
Route::get('/mascotas/{id}/assign', [MascotaController::class, 'assign'])->name('mascotas.assign');
Route::post('/mascotas/{id}/assign', [PropietarioController::class, 'store'])->name('propietarios.store');

Route::delete('/mascotas/{id}', [MascotaController::class, 'destroy'])->name('mascotas.destroy');


