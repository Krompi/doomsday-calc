<?php

use Illuminate\Support\Facades\Route;

// use Krompi\Services\DoomsdayServiceProvider;
use App\Providers\DoomsdayServiceProvider;
use App\Http\Controllers\QuizController;

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
$doomsday = new DoomsdayServiceProvider('');
// dd($doomsday->getWeekday(2012, 11, 29));
// dd('test');

Route::get('/', function () {
    return view('welcome');
});

Route::post( '/', [QuizController::class, 'getRandom'])->name('random');
Route::get( '/date/{date}', [QuizController::class, 'start'])->name('start');
// Route::get('/start', function () {
//     return view('welcome');
// });

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
