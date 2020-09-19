<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;

Route::group(['namespace'=>'Auth'],function(){
    Route::post('login','LoginController@login')->name('login');
    Route::post('register','RegisterController@register')->name('register');
    Route::delete('logout','LogoutController@logout')->middleware('auth:sanctum')->name('logout');
    Route::delete('logout-all','LogoutController@logoutAll')->middleware('auth:sanctum')->name('logout.all');
});
Broadcast::routes(['middleware'=>'auth:sanctum']);



Route::group(['middleware'=>['auth:sanctum']],function (){

    Route::get('user',function (){
        return Auth::user();
    });

    Route::get('invite/{user}','InviteController@invite');
    Route::get('invite/{user}/accept','InviteController@accept');

    Route::post('games','GameController@store')->name('games.store');
});

Route::get('/test',function (){
    return 'test';
});
