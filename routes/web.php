<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyTaskController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AssignUserController;
use App\Http\Controllers\CourseMaterialController;

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

Route::get('/chartjs', function () {
    return view('contact.index');
});

Route::get('/', [MyTaskController::class, 'index']);
Route::post('/task', [MyTaskController::class, 'store']);
Route::patch('/task/{task}', [MyTaskController::class, 'update']);

// Route::get('/course', [CourseMaterialController::class, 'index']);
Route::get('/course', [CourseMaterialController::class, 'index']);
Route::post('/assign-users/store', [AssignUserController::class, 'store']);
Route::delete('/assign-users/destroy', [AssignUserController::class, 'delete']);





// Route::get('', function () {
//     return view('welcome');
//     // dump($paymnet->pay());
//     // dd(app());
// });


Route::get('/contact', [ContactController::class, 'index']);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
