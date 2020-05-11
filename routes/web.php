<?php

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

\Illuminate\Support\Facades\Auth::routes();

Route::get('/referral_code/{code}', 'UserController@referralForm');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/update-profile', 'UserController@viewUpdateProfile');
Route::post('/update', 'UserController@updateProfile');
Route::post('/approve-user/{id}', 'UserController@approveUser');
Route::post('/suspend-control/{id}', 'UserController@suspendControl');

Route::get('/profile', 'UserController@profile')->name('profile');
Route::get('/child/{id}', 'UserController@child')->name('child');
Route::get('/summary/{id}', 'UserController@summary')->name('summary');

Route::get('/advertisement/{id}', 'AdvertisementController@read')->name('advertisement');
Route::post('/advertisement/create', 'AdvertisementController@create')->name('advertisement');
Route::post('/advertisement/update/{id}', 'AdvertisementController@update')->name('advertisement');
Route::post('/advertisement/delete/{id}', 'AdvertisementController@delete')->name('advertisement');

Route::get('/wallet/direct/{id}', 'UserController@directView')->name('direct');
Route::get('/wallet/jackpot/{id}', 'UserController@jackpotView')->name('jackpot');
Route::get('/wallet/pairing/{id}', 'UserController@pairingView')->name('pairing');

//Route::get('/wallet/withdraw/{id}', 'UserController@withdrawView')->name('withdraw_view');
//Route::post('/wallet/withdraw', 'UserController@withdraw')->name('withdraw');

Route::post('/wallet/withdraw/direct', 'WalletController@directWithdraw');
Route::post('/wallet/withdraw/pairing', 'WalletController@pairingWithdraw');
Route::post('/wallet/withdraw/jackpot', 'WalletController@jackpotWithdraw');

Route::post('/wallet/upgrade-package', 'UserController@upgradePackage');

Route::post('/wallet/pairing/add-deposit', 'UserController@addDeposit');

Route::post('/add-member', 'UserController@addMember');

Route::group(['middleware','admin'], function (){
    Route::get('/package', 'UserController@viewPackage');
    Route::get('/manage-user', 'UserController@manageUser');
});
