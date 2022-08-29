<?php

  namespace App\Modules\Account\Providers;

  use Illuminate\Support\Facades\RateLimiter;
  use Illuminate\Cache\RateLimiting\Limit;
  use Illuminate\Support\ServiceProvider;

  class AccountServiceProvider extends ServiceProvider
  {
    public function register(): void
    {

    }

    public function boot(): void
    {
      $this->configureRateLimiting();
    }

    protected function configureRateLimiting(): void
    {
      RateLimiter::for('account', function () {
        return Limit::perHour(12)->response(function () {
          if (request()->ajax()) {
            return response()->json([
              'status'     => false,
              'textStatus' => 'Слишком много попыток|Доступно не более 12 действий в час',
            ]);
          }
          return redirect()->back()->withInput()->with('notification', 'Слишком много попыток|Доступно не более 12 действий в час');
        });
      });
    }
  }
