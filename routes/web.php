<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TodoController::class, 'homepage'])->name('homepage');
Route::get('/allTodos', [TodoController::class, 'allTodos'])->name('allTodos');
Route::post('/store', [TodoController::class, 'storeTodo'])->name('store');
Route::get('/delete/{id}', [TodoController::class, 'deleteTodo'])->name('delete');


Route::get('/edit/{id}', [TodoController::class, 'editTodo'])->name('edit');
Route::post('/update/{id}', [TodoController::class, 'updateTodo'])->name('update');
