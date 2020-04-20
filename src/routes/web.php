<?php

use Illuminate\Support\Facades\Route;

// Auth::routes(['verify' => true]);

Route::group(['prefix' => 'trainer', 'as' => 'trainer.'], function () {
    Route::get('regsiter/{id}', 'Trainer\RegisterController@showForm')->middleware('signed')->name('register');
    Route::post('regsiter/{id}', 'Trainer\RegisterController@register')->middleware('signed');
});

Auth::routes(['verify' => true]);

Route::view('/sendEmail', 'auth.sendVerifyEmail')->name('sendVerifyEmail');

Route::view('/', 'lp')->name('top');
