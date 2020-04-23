<?php

use Illuminate\Support\Facades\Route;

Route::resource('trainer', 'TrainerController')->only(['create', 'store'])->middleware('signed');
// createとstoreのみにsignedを適用するため、使用しないものと分離
// Route::resource('trainer', 'TrainerController')->except(['create', 'store']);

Auth::routes(['verify' => true]);

Route::view('/sendEmail', 'auth.sendVerifyEmail')->name('sendVerifyEmail');
Route::view('/serviceRule', 'common.serviceRule')->name('serviceRule');

Route::view('/', 'landingPage')->name('top');
