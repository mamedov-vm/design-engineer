<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Captcha Routes
|--------------------------------------------------------------------------
|
| Данные маршруты обеспечивают функционал работы с captcha.
| 1. AJAX-запрос на обновление captcha
|
| Требуется:
| 1. middleware isAjax
|
*/

/** @noinspection PhpFullyQualifiedNameUsageInspection */
Route::post('/captcha/update', [\Ionium\Captcha\Http\Controllers\CaptchaController::class, 'update'])
    ->middleware(['web', 'ajax', 'throttle:captcha'])
    ->name('captcha.update');
