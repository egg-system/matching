<?php

use Illuminate\Support\Facades\Route;

Route::resource('trainer', 'TrainerController')->only(['create', 'store']);

Auth::routes(['verify' => true]);

Route::view('/sendEmail', 'auth.sendVerifyEmail')->name('sendVerifyEmail');
Route::view('/serviceRule', 'common.serviceRule')->name('serviceRule');

Route::view('/', 'landingPage')->name('top');
