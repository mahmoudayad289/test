<?php

use Illuminate\Support\Facades\Route;




    Route::group(['prefix' => 'admin', 'middleware' => 'role:super_admin|admin'], function () {
        Route::get('/', 'WelcomeController@index')->name('admin.home');
        // users routs
        Route::resource('users', 'UserController');
        // categories routes
        Route::resource('categories', 'CategoryController');
        // roles routes
        Route::resource('roles', 'RoleController');

        Route::get('/setting/social_login', 'SettingController@social_login')->name('setting.social.login');
        Route::get('/setting/social_links', 'SettingController@social_links')->name('setting.social.links');
        Route::post('/settings', 'SettingController@store')->name('setting.store');
    });





