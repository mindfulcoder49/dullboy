<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\VirtueController;

use App\Http\Controllers\DashboardController;

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
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }

    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

/*
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
}); */

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});



Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::resource('virtues', VirtueController::class);
});


/*
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/virtues', [VirtueController::class, 'index'])->name('virtues.index');
    Route::get('/virtues/create', [VirtueController::class, 'create'])->name('virtues.create');
    Route::post('/virtues', [VirtueController::class, 'store'])->name('virtues.store');
    Route::get('/virtues/{virtue}', [VirtueController::class, 'show'])->name('virtues.show');
    // Define other routes as needed for edit, update, and delete actions
});

*/
