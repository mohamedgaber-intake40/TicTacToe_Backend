<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;

Route::group(['namespace'=>'Auth'],function(){
    Route::post('login','LoginController@login')->name('login');
    Route::post('register','RegisterController@register')->name('register');
    Route::delete('logout','LogoutController@logout')->middleware('auth:sanctum')->name('logout');
    Route::delete('logout-all','LogoutController@logoutAll')->middleware('auth:sanctum')->name('logout.all');
});
Broadcast::routes(['middleware'=>'auth:sanctum']);

Route::get('invite/{user}','InviteController@invite');
Route::get('invite/{user}/accept','InviteController@accept');

Route::get('/test',function (){
    return 'test';
});
