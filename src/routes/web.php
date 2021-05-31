<?php

//Rota de tema personalizado

use Codificar\Themes\Http\Controllers\ThemeController;

//Rota de tema personalizado
Route::get('/css/theme.css', function () {

    header('Content-Type: text/css');

    require __DIR__ . '/../resources/css/theme.php';

    exit();
});

//Rota de tema personalizado da área pública
Route::get('/css/public.css', function () {

    header('Content-Type: text/css');

    require __DIR__ . '/../resources/css/public.php';

    exit();
});

Route::group(['prefix' => 'admin/settings', 'middleware' => 'auth.admin'], function () {
    Route::get('/themes', ThemeController::class . '@index')->name('themeIndex');
    Route::get('/themes/list', ThemeController::class . '@list');
    Route::post('/theme/save', ThemeController::class . '@save')->name('themeSave');
    Route::post('/theme/images', ThemeController::class . '@saveImages')->name('themeImageSave');
    Route::post('/theme/apply', ThemeController::class . '@apply')->name('themeApply');
    Route::delete('/theme', ThemeController::class . '@delete')->name('themeDelete');
});


Route::get('/js/lang/theme', function(){
    header('Content-Type: text/javascript');
    $theme = require __DIR__ . '/../translations/'.config('app.locale').'/themes.php';
    $trans = ['themes' => $theme];
    return ('window.lang = ' . json_encode($trans) . ';');
    exit();
});