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
Route::get('login')->uses('Auth\LoginController@showLoginForm');

Route::group(['prefix' => 'administration', 'namespace' => 'Administration'], function() {
    Route::get('')->uses('Dashboard\DashboardController@index')->name('administration.dashboard');

    Route::group(['prefix' => 'version'], function() {
        Route::get('')->uses('VersionController@index')->name('administration.version');
        Route::get('create')->uses('VersionController@create')->name('administration.version.create');
        Route::post('store')->uses('VersionController@store')->name('administration.version.store');
        Route::get('edit/{version}')->uses('VersionController@edit')->name('administration.version.edit');
        Route::post('update/{version}')->uses('VersionController@update')->name('administration.version.update');
        Route::get('manage/{version}')->uses('VersionController@manage')->name('administration.version.manage');
        Route::get('destroy/{version}')->uses('VersionController@destroy')->name('administration.version.destroy');
    });

    // Documentation
    Route::group(['prefix' => 'documentation'], function() {
        Route::get('listing/{version}')->uses('DocumentationController@listing')->name('administration.documentation.listing');

        Route::get('create/{version}/{navigation?}')->uses('DocumentationController@create')->name('administration.documentation.create');
        Route::post('store')->uses('DocumentationController@store')->name('administration.documentation.store');

        Route::get('edit/{document}')->uses('DocumentationController@edit')->name('administration.documentation.edit');
        Route::post('update/{document}')->uses('DocumentationController@update')->name('administration.documentation.update');


        // destroy
        Route::get('destroy/{document}')->uses('DocumentationController@destroy')->name('administration.documentation.destroy');

        // version must be last, order of routes
        Route::get('/{version}')->uses('DocumentationController@index')->name('administration.documentation');
        // import


    });

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

    // Import
    Route::group(['prefix' => 'import', 'namespace' => 'Imports'], function() {
        Route::get('import/github')->uses('GithubController@index')->name('administration.import.github');
        Route::post('import/github/store')->uses('GithubController@store')->name('administration.import.github.store');
    });

});

Route::group(['prefix' => 'auth'], function(){
    // Authentication Routes...
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
