<?php /** @noinspection PhpFullyQualifiedNameUsageInspection */

  use Illuminate\Support\Facades\Route;

  /* Comment */
  Route::controller(\App\Modules\Comment\Controllers\CommentController::class)
    ->group(function () {

      /* Page with comments */
      Route::get('', 'getComments')->name('getComments');

      Route::controller(\App\Modules\Comment\Controllers\CommentController::class)
        ->name('comment.')
        ->prefix('comment')
        ->group(function () {

          /* Next page */
          Route::post('nextComments', 'postNextComments')->name('postNextComments');

          /* Login Variants */
          Route::post('loginVariants', 'postLoginVariants')->name('postLoginVariants');

          Route::middleware('auth')->group(function () {
            /* New */
            Route::post('newComment', 'postNewComment')->name('postNewComment');
          });
        });
    });

  /* Account */
  Route::controller(\App\Modules\Account\Controllers\AccountController::class)
    ->name('account.')
    ->prefix('account')
    ->group(function () {

      Route::middleware('guest')->group(function () {
        /* Login */
        Route::get('login', 'getLogin')->name('getLogin');
        Route::middleware('throttle:account')->post('login', 'postLogin')->name('postLogin');
        /* Registration */
        Route::get('registration', 'getRegistration')->name('getRegistration');
        Route::middleware('throttle:account')->post('registration', 'postRegistration')->name('postRegistration');
      });

      Route::middleware('auth')->group(function () {
        /* Logout */
        Route::get('logout', 'getLogout')->name('getLogout');
      });
    });