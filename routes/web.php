<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::view('/' , 'home');

Route::view('/contact', 'contact');

//Route::resource('jobs', JobController::class); ALTERNATİVE

Route::controller(JobController::class) ->group(function ()
{
    Route::get('/jobs', 'index');

    Route::get('/jobs/create', 'create');

    Route::get('/jobs/{job}', 'show');// '/jobs/{id}' id {} this means this is a wild card  and anything after will use this route

    Route::post('/jobs' , 'store')->middleware('auth');

    Route::get('/jobs/{job}/edit', 'edit')->middleware('auth')->can('edit-job','job');

    Route::patch('/jobs/{job}', 'update')->middleware('auth');

    Route::delete('/jobs/{job}', 'destroy')->middleware('auth');
});

//auth
Route::get('/register', [RegisteredUserController::class , 'create']);
Route::post('/register', [RegisteredUserController::class , 'store']);

Route::get('/login' , [SessionController::class , 'create'])->name('login');
Route::post('/login' , [SessionController::class , 'store']);
Route::post('/logout' , [SessionController::class , 'destroy']);





