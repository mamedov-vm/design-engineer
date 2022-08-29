<?php

  namespace App\Modules\Account\Actions;

  use Illuminate\Support\Facades\Auth;

  class LoginAction
  {
    /**
     * Выполняет вход пользователя
     *
     * @param array $userData
     * @return bool
     */
    public function handle(array $userData): bool
    {
      if (Auth::attempt(
        [
          'email'    => $userData['email'],
          'password' => $userData['password'],
        ],
        true)
      ) {
        request()->session()->regenerate();

        return true;
      }

      return false;
    }
  }