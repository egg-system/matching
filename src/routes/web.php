<?php

use Illuminate\Support\Facades\Route;

// TopのLP ※ ログイン後は遷移できないようにする
Route::view('/', 'pages.landing')
    ->name('top')
    ->middleware('guest');

// 利用規約
Route::view('/service-term', 'pages.terms.service-term')
    ->name('serviceTerm');

// 個人情報保護
Route::view('/privacy-policy', 'pages.terms.privacy-policy')
    ->name('privacyPolicy');

// 特定商取引法に基づく表記
Route::view('/commercial-transactions', 'pages.terms.commercial-transactions')
    ->name('commercialTransactions');

// トレーナーの登録
Route::group(['middleware' => 'released:register'], function () {
    // メールアドレス入力
    Route::view('/input-email', 'pages.email.input-email')
        ->name('inputEmail');

    // メールアドレスの登録処理
    Route::post('register', 'Auth\RegisterController@register')
        ->name('register');

    // メールアドレス入力後のサンクスページ
    Route::view('/send-email', 'pages.email.send-email')
        ->name('sendEmail');

    // 会員登録画面
    Route::resource('trainers', 'UsersController')
        ->only(['create', 'store'])
        ->middleware('signed');
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
        ->only(['index', 'show', 'store']);

    // ログアウト
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');
});
