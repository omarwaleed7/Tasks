<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use App\Models\Task;

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
    return redirect()->route('tasks.index');
});

Route::controller(TaskController::class)->group(function(){
    Route::get('tasks','index')->name('tasks.index');
    Route::get('tasks/create','create')->name('tasks.create');
    Route::get('tasks/{id}','show')->name('tasks.show');
    Route::get('tasks/edit/{id}','edit')->name('tasks.edit');
    Route::post('tasks/insert','insert')->name('tasks.insert');
    Route::put('tasks/update/{id}','update')->name('tasks.update');
    Route::put('tasks/mark/{id}','mark')->name('tasks.mark');
    Route::delete('tasks/delete/{id}','delete')->name('tasks.delete');
});
