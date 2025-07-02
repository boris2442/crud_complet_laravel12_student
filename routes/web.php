<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
Route::get('/', function () {
    return view('welcome');
});
Route::get('/list', [StudentController::class, 'index'])->name('student.index');
Route::get('/create', [StudentController::class, 'create'])->name('student.create');
Route::post('/create', [StudentController::class, 'store'])->name('student.store');
Route::delete('/delete/{id}', [StudentController::class, 'delete'])->name('student.delete');
Route::get('/edit/{id}', [StudentController::class, 'edit'])->name('student.edit');
Route::patch('/edit/{id}', [StudentController::class, 'update'])->name('student.update');