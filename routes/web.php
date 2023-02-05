<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
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
Route::get('/', function () { return redirect('login');})->middleware('auth');


Route::get('/register', [RegisterController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [RegisterController::class, 'store'])
    ->middleware('guest')
    ->name('register');

Route::get('/login', [LoginController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [LoginController::class, 'authenticate'])
    ->middleware('guest')
    ->name('login');

Route::get('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

    
Route::get('/dashboard', [TaskController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

Route::post('/{task}/mark-as-complete', [TaskController::class, 'markAsComplete'])
    ->name('complete');

Route::post('/{task}/delete', [TaskController::class, 'delete'])
    ->name('delete');

Route::post('save', [TaskController::class, 'save'])
    ->name('save');


Route::get('tasks/{user}', [UserController::class, 'show'])
    ->middleware('can:view-task')
    ->name('usersTask');

Route::post('delete/{user}', [UserController::class, 'delete'])
    ->name('deleteUser');

Route::get('givepermission/{user}', [UserController::class, 'create'])
    ->name('givePermission');

Route::post('give/{user}/{permission}', [UserController::class, 'give'])
    ->name('give');

Route::post('withdraw/{user}/{permission}', [UserController::class, 'withdraw'])
    ->name('withdraw');