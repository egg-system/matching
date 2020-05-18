<?php

use Illuminate\Support\Facades\Route;

// トレーナーのルーティング
Route::group(['prefix' => 'trainer', 'as' => 'trainer.'], function () {
    // 認証
    Route::view('login', 'trainer.login')->middleware('guest')->name('login');
    Route::post('login', 'TrainerController@login')->middleware('guest')->name('login');
    /**
     * createとstoreのみにsignedを適用するため、使用しないものと分離
     * Route::resource('', 'TrainerController')->except(['create', 'store']);
     */
    Route::resource('', 'TrainerController')->only(['create', 'store'])->middleware('signed');

    // トレーナーのみ
    Route::group(['middleware' => ['auth', 'can:trainer-only']], function () {
        Route::resource('', 'TrainerController', ['parameters' => ['' => 'trainer']])->only(['edit', 'update'])->middleware(['can:update,trainer']);
    });
});

// ジムオーナー
Route::group(['prefix' => 'gymowner', 'as' => 'gymowner.'], function () {
    // 認証
    Route::view('login', 'gymowner.login')->middleware('guest')->name('login');
    Route::post('login', 'GymController@login')->middleware('guest')->name('login');
    Route::get('trainerList', 'GymController@trainerList')->middleware(['auth', 'only.gymowner'])->name('trainerList');
    Route::resource('', 'GymController')->only(['index'])->middleware(['auth', 'only.gymowner']);
});

// メール送信済
Route::view('/sendEmail', 'common.sendVerifyEmail')->name('sendVerifyEmail');
// 利用規約
Route::view('/serviceRule', 'common.serviceRule')->name('serviceRule');
// TopのLP
Route::view('/', 'landingPage')->name('top');
Route::post('register', 'Auth\RegisterController@register')->name('register');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
