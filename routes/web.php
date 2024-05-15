<?php
//
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\QueueController as AdminQueueController;
use Illuminate\Support\Facades\Auth;
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


Auth::routes();

Route::get('/', 'HomeController@index')->name('welcome');
Route::post('/queue', 'QueueController@reserve')->name('queue.reserve');
Route::post('/notification', 'QueueController@notification')->name('notification.create');

Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'namespace' => 'Admin'], function () {
    Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');
    Route::get('queue', 'QueueController@index')->name('queue.index');
    Route::post('queue/{id}', 'QueueController@status')->name('queue.status');
    Route::post('publication/{id}', 'QueueController@publication')->name('queue.publication');

    Route::delete('queue/{id}', 'QueueController@destroy')->name('queue.destroy');
});







Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::post('/queue', [QueueController::class, 'reserve'])->name('queue.reserve');
Route::post('/notification', [QueueController::class, 'notification'])->name('notification.create');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('queue', [AdminQueueController::class, 'index'])->name('queue.index');
    Route::post('queue/{id}', [AdminQueueController::class, 'status'])->name('queue.status');
    Route::post('publication/{id}', [AdminQueueController::class, 'publication'])->name('queue.publication');
    Route::delete('queue/{id}', [AdminQueueController::class, 'destroy'])->name('queue.destroy');
});
