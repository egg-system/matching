<?php

use Illuminate\Support\Facades\Route;

// トレーナーのルーティング
Route::group(['prefix' => 'trainers', 'as' => 'trainers.'], function () {
    // 認証
    Route::view('login', 'pages.trainers.login')->middleware('guest')->name('login.view');
    Route::post('login', 'Auth\LoginController@login')->middleware('guest')->name('login');

    Route::resource('', 'UsersController')->only(['create', 'store'])->middleware('signed');

    // トレーナーのみ
    Route::group(['middleware' => ['auth', 'can:trainer']], function () {
        Route::resource('', 'UsersController', ['parameters' => ['' => 'trainer']])
            ->only(['edit', 'update'])
            ->middleware(['can:update,trainer']);
    });
});

// ジムオーナー
Route::group(['prefix' => 'gyms', 'as' => 'gyms.'], function () {
    // 認証
    Route::view('login', 'pages.gyms.login')->middleware('guest')->name('login.view');
    Route::post('login', 'Auth\LoginController@login')->middleware('guest')->name('login');
    Route::middleware(['auth', 'can:gym'])->group(function () {
        Route::get('trainerList', 'GymsController@trainerList')->name('trainerList');
        Route::resource('', 'GymsController', ['parameters' => ['' => 'gym']])
            ->only(['index']);
        Route::resource('', 'UsersController', ['parameters' => ['' => 'gym']])
            ->only(['edit', 'update'])
            ->middleware(['can:update,gym']);
    });
});

Route::group(['middleware' => ['auth']], function () {
    Route::resource('offers', 'OffersController')->only(['index', 'show', 'update']);
    Route::resource('offers', 'OffersController')->only(['store'])->middleware('can:gym');
});

// メール送信済
Route::view('/send-email', 'pages.send-verify-email')->name('sendVerifyEmail');

// 利用規約
Route::view('/service-term', 'pages.service-term')->name('serviceTerm');

// TopのLP
Route::view('/', 'pages.landing')->name('top');

Route::post('register', 'Auth\RegisterController@register')->name('register');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
