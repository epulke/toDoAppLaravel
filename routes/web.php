<?php

use App\Http\Controllers\TasksController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

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

Route::get("/registration", [UsersController::class, "registrationForm"]);

Route::get("/tasks", [TasksController::class, "showTasks"]);
Route::post("/tasks", [TasksController::class, "addNewTask"]);
//Route::get("/tasks/{number}", [TasksController::class, "showSelectedTask"]);
Route::get("/tasks/searchResults", [TasksController::class, "searchTask"]);
Route::post("/tasks/searchResults", [TasksController::class, "deleteTask"]);


