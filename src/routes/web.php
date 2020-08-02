<?php

use Illuminate\Support\Facades\Route;

// トレーナーの登録
Route::group(['middleware' => 'released:register'], function () {
    Route::resource('trainers', 'UsersController')
        ->only(['create', 'store'])
        ->middleware('signed');
    Route::post('register', 'Auth\RegisterController@register')
        ->name('register');
});

// ログイン
Route::group([
    'prefix' => 'login', 'as' => 'login.',
    'middleware' => ['guest', 'released:login'],
], function () {
    Route::view('/{userType}', 'pages.users.login')
        ->where('userType', '(gym|trainer)')
        ->name('view');
    Route::post('', 'Auth\LoginController@login')
        ->name('post');
});

// トレーナーのみがアクセル可能なルート
// 　TODO: #166 プロフィール編集のルートをまとめる
Route::group([
    'prefix' => 'trainers',
    'as' => 'trainers.',
    'middleware' => ['auth', 'can:trainer']
], function () {
    Route::resource('', 'UsersController', ['parameters' => ['' => 'trainer']])
        ->only(['edit', 'update'])
        ->middleware(['can:update,trainer']);
});

// ジムオーナーのみがアクセス可能なルート
// 　TODO: #166 プロフィール編集のルートをまとめる
Route::group([
    'prefix' => 'gyms',
    'as' => 'gyms.',
    'middleware' => ['auth', 'can:gym']
], function () {
    Route::resource('', 'UsersController', ['parameters' => ['' => 'gym']])
        ->only(['edit', 'update'])
        ->middleware(['can:update,gym']);
});

// ログイン時のみアクセス可能
Route::group(['middleware' => ['auth']], function () {
    // トレーナー一覧 ※ 個人情報のため、ジムのみ閲覧可能
    Route::resource('trainers', 'TrainersController')
        ->only(['index'])
        ->middleware('can:gym');

    // ジム一覧 ※ 公開情報がほとんどのため、制限しない
    Route::resource('gyms', 'GymsController')
        ->only(['index']);

    // オファー
    Route::resource('offers', 'OffersController')
        ->only(['index', 'show', 'update']);
    Route::resource('offers', 'OffersController')
        ->only(['store'])
        ->middleware('can:gym');
});

// メール送信済
Route::view('/send-email', 'pages.send-verify-email')->name('sendVerifyEmail');

// 利用規約
Route::view('/service-term', 'pages.service-term')->name('serviceTerm');

// TopのLP
Route::view('/', 'pages.landing')->name('top')->middleware('guest');

Route::post('logout', 'Auth\LoginController@logout')->name('logout');
