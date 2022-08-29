<?php

  namespace App\Modules\Account\Actions;

  use App\Modules\User\Models\User;
  use Illuminate\Support\Facades\Auth;

  class RegistrationAction
  {
    /**
     * Выполняет регистрацию нового пользователя
     *
     * @param array $userData
     * @return bool
     */
    public function handle(array $userData): bool
    {
      $user = User::create([
        'login'    => $userData['login'],
        'email'    => $userData['email'],
        'password' => $userData['password'],
      ]);

      if ($user) {
        Auth::login($user, true);

        return true;
      }

      return false;
    }
  }