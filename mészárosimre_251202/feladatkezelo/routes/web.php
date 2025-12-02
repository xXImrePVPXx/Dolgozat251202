<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/tasks', [App\Http\Controllers\TaskController::class, 'tasks'])->name('tasks');
Route::post('/tasks/add', [App\Http\Controllers\TaskController::class, 'addTask'])->name('tasks.add');
Route::post('/tasks/{id}/complete', [App\Http\Controllers\TaskController::class, 'completeTask'])->name('tasks.complete');
Route::post('/tasks/{id}/delete', [App\Http\Controllers\TaskController::class, 'deleteTask'])->name('tasks.delete');
Route::post('/tasks/{id}/update', [App\Http\Controllers\TaskController::class, 'updateTask'])->name('tasks.update');
