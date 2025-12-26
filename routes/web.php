<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/',function(){
    if(Auth::check()){
        return redirect()->route('dashboard');
    }
    return view('login',[
        'title' => 'Kereta Api Indonesia',
        'host' => 'http://kai.go.id'
    ]);
});
Route::get('/login', function () {
      if(Auth::check()){
        return redirect()->route('dashboard');
    }
    return view('login', [
        'title' => 'Kereta Api Indonesia',
        'host' => 'http://kai.go.id'
    ]);
})->name('login');

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');
Route::get('/profile', [DashboardController::class, 'profile'])
    ->middleware('auth')
    ->name('profile');
Route::get('/tes',function(){
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('asset', AssetController::class);
});

