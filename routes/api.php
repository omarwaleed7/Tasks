<?php

use App\Http\Controllers\api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(TaskController::class)->group(function(){
    Route::get('tasks','index')->name('tasks.index');
    Route::get('tasks/{id}','show')->name('tasks.show');
    Route::post('tasks/insert','insert')->name('tasks.insert');
    Route::put('tasks/update/{id}','update')->name('tasks.update');
    Route::put('tasks/mark/{id}','mark')->name('tasks.mark');
    Route::delete('tasks/delete/{id}','delete')->name('tasks.delete');
});
