<?php

  namespace App\Modules\Account\Actions;

  use Illuminate\Support\Facades\Auth;

  class LogoutAction
  {
    /**
     * Выполняет выход пользователя из аккаунта
     *
     * @return void
     */
    public function handle(): void
    {
      Auth::logout();

      request()->session()->invalidate();
      request()->session()->regenerateToken();
    }
  }