<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// Quick fix for Login

include('administration.php');

Route::group(['prefix' => 'administration', 'namespace' => 'Administration'], function() {




    // Navigation
    Route::group(['prefix' => 'navigation'], function() {
        Route::get('create/section/{version}')->uses('NavigationController@createSection')->name('administration.navigation.create.section');
        Route::post('store/section')->uses('NavigationController@storeSection')->name('administration.navigation.store.section');
        Route::get('edit/section/{navigation}')->uses('NavigationController@editSection')->name('administration.navigation.edit.section');
        Route::post('update/section')->uses('NavigationController@updateNavigation')->name('administration.navigation.update.section');

        Route::get('create/document/{navigation}')->uses('NavigationController@createDocument')->name('administration.navigation.create.document');
        Route::post('store/document')->uses('NavigationController@storeDocument')->name('administration.navigation.store.document');
        Route::get('edit/document/{navigation}')->uses('NavigationController@editDocument')->name('administration.navigation.edit.document');
        Route::post('update/document')->uses('NavigationController@updateNavigation')->name('administration.navigation.update.document');

        Route::get('destroy/{navigation}')->uses('NavigationController@destroy')->name('administration.navigation.destroy');

        Route::get('rank/up/{navigation}')->uses('NavigationController@rankUp')->name('administration.navigation.rank.up');
        Route::get('rank/down/{navigation}')->uses('NavigationController@rankDown')->name('administration.navigation.rank.down');

        Route::get('/{version}')->uses('NavigationController@index')->name('administration.navigation');
    });

    // Settings
    Route::group(['prefix' => 'settings'], function() {
        Route::get('')->uses('SettingsController@index')->name('administration.settings');
        Route::post('update')->uses('SettingsController@update')->name('administration.settings.save');
        Route::get('destroy/token')->uses('SettingsController@destroyToken')->name('administration.settings.destroy.token');
    });


});

// AUTHENTICATION
Route::get('login')->uses('Auth\LoginController@showLoginForm');
Route::group(['prefix' => 'auth'], function(){
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
    Route::post('login', 'Auth\LoginController@login')->name('auth.login.post');
    Route::get('logout', 'Auth\LoginController@logout')->name('auth.logout');
});

Route::group(['prefix' => '', 'namespace' => 'Front'], function(){
    Route::get('')->uses('DocumentController@index')->name('home');

    Route::get('set/{version_slug}')->uses('DocumentController@setVersion')->name('document.set');
    Route::get('{version_slug}')->uses('DocumentController@index')->name('document.view');

    Route::get('{version_slug}/{document_slug}')->uses('DocumentController@view')->name('document.view');
});






// Testing
Route::get('/setup', function() {
    \App\Models\Version::create([
        'tag' => '5.3',
        'slug' => str_slug('5.3')
    ]);

    $version = \App\Models\Version::create([
        'tag' => 'master',
        'slug' => str_slug('master'),
        'default' => true,
    ]);

    $document = \App\Models\Document::create([
        'version_id' => $version->id,
        'title' => 'Installation',
        'slug' => str_slug('Installation'),
        'markdown' => 'Will Replace',
        'html' => 'Will Replace'
    ]);
    $documentTwo = \App\Models\Document::create([
        'version_id' => $version->id,
        'title' => 'Configuration',
        'slug' => str_slug('Configuration'),
        'markdown' => 'Will Replace',
        'html' => 'Will Replace'
    ]);

    $navigation = \App\Models\Navigation::create([
        'version_id' => $version->id,
        'title'      => 'Getting Started',
        'is_heading' => true,
    ]);

    \App\Models\Navigation::create([
        'parent_id'   => $navigation->id,
        'version_id'  => $version->id,
        'document_id' => $document->id,
        'title'       => '',
        'is_heading'  => false,
        'sorting'     => 1,
    ]);

    \App\Models\Navigation::create([
        'parent_id'   => $navigation->id,
        'version_id'  => $version->id,
        'document_id' => $documentTwo->id,
        'title'       => '',
        'is_heading'  => false,
        'sorting'     => 2,
    ]);

    dd('all done!');
});

// Remove Later
Route::get('/home', 'HomeController@index');
