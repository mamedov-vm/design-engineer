<?php

  namespace Ionium\Captcha\Providers;

  use Illuminate\Support\Facades\Hash;
  use Illuminate\Support\Facades\Session;
  use Illuminate\Support\Facades\Validator;
  use Illuminate\Support\ServiceProvider;
  use Ionium\Captcha\Services\CaptchaService;
  use Illuminate\Support\Facades\RateLimiter;
  use Illuminate\Cache\RateLimiting\Limit;

  class CaptchaServiceProvider extends ServiceProvider
  {
    /**
     * Register services.
     * app('captcha')->getCaptcha()
     *
     * @return void
     */
    public function register(): void
    {
      $this->app->singleton(CaptchaService::class, function () {
        return new CaptchaService();
      });
      $this->app->alias(CaptchaService::class, 'captcha');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
      $this->configureRateLimiting();

      $this->loadRoutesFrom(__DIR__ . '/../routes/captcha.php');

      Validator::extend('captcha', function ($attribute, $value) {
        if (is_null($value)) {
          return false;
        } elseif (is_string($value) && trim($value) === '') {
          return false;
        }

        if (!Session::has('_captchaKey.hashType') || !Session::has('_captchaKey.hash')) {
          return false;
        }
        if (Session::get('_captchaKey.hashType') === 'md5') {
          return md5('Captcha_' . $value . '_md5') === Session::get('_captchaKey.hash');
        } else {
          return Hash::check($value, Session::get('_captchaKey.hash'));
        }
      }, 'Комбинация блоков выбрана неверно');
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting(): void
    {
      RateLimiter::for('captcha', function () {
        return Limit::perMinute(10)->response(function () {
          return response()->json(['error' => 'Слишком много попыток, попробуйте через минуту.']);
        });
      });
    }
  }
