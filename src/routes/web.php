<?php

//Rota de tema personalizado

use Codificar\Themes\Http\Controllers\ThemeController;
use Codificar\Themes\Http\Controllers\AppChoiceThemeController;



Route::group(['prefix' => 'admin/settings', 'middleware' => 'auth.admin'], function () {
    Route::get('/themes', ThemeController::class . '@index')->name('themeIndex');
    Route::get('/themes/list', ThemeController::class . '@list')->name('themeList');
    Route::post('/themes/save', ThemeController::class . '@save')->name('themeSave');
    Route::post('/themes/apply', ThemeController::class . '@apply')->name('themeApply');
    Route::delete('/themes', ThemeController::class . '@delete')->name('themeDelete');
    Route::get('/themes/{theme_id}', ThemeController::class . '@show')->name('themeShow');
});

Route::group(['prefix' => 'api', 'middleware' => 'auth.admin'], function () {
    Route::get('/themes/settings',  AppChoiceThemeController::class . '@getSettings');
    Route::post('/themes/settings',  AppChoiceThemeController::class . '@saveSettings');
});

Route::group(['prefix' => 'api', 'middleware' => 'auth.provider_api:api'], function () {
    Route::post('/themes/save_provider',  AppChoiceThemeController::class . '@saveAppPreference');
});

Route::group(['prefix' => 'api', 'middleware' => 'auth.user_api:api'], function () {
    Route::post('/themes/save_user',  AppChoiceThemeController::class . '@saveAppPreference');
});

Route::get('/api/application/themes',  AppChoiceThemeController::class . '@getAppThemes');

//Rota de tema personalizado
Route::get('/css/theme.css', function () {

    $css = require __DIR__ . '/../resources/css/theme.php';

    return response($css)
            ->header('Content-Type', 'text/css');
});

//Rota de tema personalizado da área pública
Route::get('/css/public.css', function () {

    $css = require __DIR__ . '/../resources/css/public.php';

    return response($css)
            ->header('Content-Type', 'text/css');
});

Route::get('/js/lang/theme', function(){

    $theme = require __DIR__ . '/../translations/'.config('app.locale').'/themes.php';

    return response('window.lang.themes = ' . json_encode($theme) . ';')
            ->header('Content-Type', 'text/javascript');
});