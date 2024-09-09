<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ScheduleExceptionController;
use App\Http\Controllers\KuinOrdersController;

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

Route::get('/', function () {return view('welcome');});

Route::post('/login', [AccountController::class, 'login']);
Route::post('/logout', [AccountController::class, 'logout']);
Route::post('/register', [AccountController::class, 'register']);
Route::post('/checkauth', [AccountController::class, 'checkauth']);

Route::middleware('auth.token:2,3')->get('/roles/get', [RoleController::class, 'index']);

Route::get('/accounts/get', [AccountController::class, 'index']);
Route::middleware('auth.token:1,2,3')->get('/accounts/get/{id}', [AccountController::class, 'show']);
Route::middleware('auth.token:1,2,3')->get('/accounts/getFromToken/{token}', [AccountController::class, 'getFromToken']);
Route::middleware('auth.token:3')->post('/accounts/create', [AccountController::class, 'store']);
Route::middleware('auth.token:3')->post('/accounts/delete/{id}', [AccountController::class, 'destroy']);
Route::middleware('auth.token:1,2,3')->post('/accounts/update/{id}', [AccountController::class, 'update']);

Route::get('/products/get', [ProductController::class, 'index']);
Route::get('/products/get/{id}', [ProductController::class, 'show']);
Route::post('/products/removestock', [ProductController::class, 'removeStock']);
Route::middleware('auth.token:2,3')->post('/products/create', [ProductController::class, 'store']);
Route::middleware('auth.token:2,3')->post('/products/delete/{id}', [ProductController::class, 'destroy']);
Route::middleware('auth.token:2,3')->post('/products/update/{id}', [ProductController::class, 'update']);

Route::middleware('auth.token:2,3')->get('/orders/get', [OrderController::class, 'index']);
Route::middleware('auth.token:2,3')->get('/orders/get/{id}', [OrderController::class, 'show']);
Route::post('/orders/create', [OrderController::class, 'store']);
Route::middleware('auth.token:2,3')->post('/orders/delete/{id}', [OrderController::class, 'destroy']);
Route::middleware('auth.token:2,3')->post('/orders/update/{id}', [OrderController::class, 'update']);

Route::middleware('auth.token:2,3')->get('/schedule/get', [ScheduleController::class, 'index']);
Route::middleware('auth.token:2,3')->get('/schedule/get/{id}', [ScheduleController::class, 'show']);
Route::middleware('auth.token:3')->post('/schedule/create', [ScheduleController::class, 'store']);
Route::middleware('auth.token:3')->post('/schedule/delete/{id}', [ScheduleController::class, 'destroy']);
Route::middleware('auth.token:3')->post('/schedule/update/{id}', [ScheduleController::class, 'update']);

Route::middleware('auth.token:2,3')->get('/scheduleexception/get', [ScheduleExceptionController::class, 'index']);
Route::middleware('auth.token:2,3')->get('/scheduleexception/get/{id}', [ScheduleExceptionController::class, 'show']);
Route::middleware('auth.token:2,3')->post('/scheduleexception/create', [ScheduleExceptionController::class, 'store']);
Route::middleware('auth.token:2,3')->post('/scheduleexception/delete/{id}', [ScheduleExceptionController::class, 'destroy']);
Route::middleware('auth.token:2,3')->post('/scheduleexception/update/{id}', [ScheduleExceptionController::class, 'update']);

Route::middleware('auth.token:3')->get('/kuin/get', [KuinOrdersController::class, 'index']);
Route::middleware('auth.token:3')->get('/kuin/get/{id}', [KuinOrdersController::class, 'show']);
Route::middleware('auth.token:3')->post('/kuin/create', [KuinOrdersController::class, 'store']);
Route::middleware('auth.token:3')->post('/kuin/delete/{id}', [KuinOrdersController::class, 'destroy']);
Route::middleware('auth.token:3')->post('/kuin/update/{id}', [KuinOrdersController::class, 'update']);
