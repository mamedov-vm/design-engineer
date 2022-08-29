<?php

  namespace App\Modules\Account\Controllers;

  use Illuminate\Contracts\View\View;
  use Illuminate\Contracts\View\Factory;
  use Illuminate\Contracts\Foundation\Application;
  use App\Modules\Account\Data\AccountData;
  use App\Modules\Account\Requests\RegistrationRequest;
  use App\Modules\Account\Actions\LogoutAction;
  use Illuminate\Http\RedirectResponse;
  use App\Modules\Account\Actions\RegistrationAction;
  use App\Modules\Account\Requests\LoginRequest;
  use App\Modules\Account\Actions\LoginAction;

  class AccountController extends Controller
  {
    // Login

    public function getLogin(): Application|Factory|View
    {
      return view('pages.account.login', [
        'fields' => json_encode(AccountData::fields, JSON_UNESCAPED_UNICODE),
      ]);
    }

    public function postLogin(LoginRequest $request, LoginAction $action): RedirectResponse
    {
      if ($action->handle($request->validated())) {
        return redirect()->route('getComments');
      }

      return redirectBackWith('Уведомление|Некорректные данные', 3);
    }

    // Registration

    public function getRegistration(): Application|Factory|View
    {
      return view('pages.account.registration', [
        'fields' => json_encode(AccountData::fields, JSON_UNESCAPED_UNICODE),
      ]);
    }

    public function postRegistration(RegistrationRequest $request, RegistrationAction $action): RedirectResponse
    {
      if ($action->handle($request->validated())) {
        return redirect()->route('profile.index');
      }

      return redirectBackWith('Уведомление|Некорректные данные', 3);
    }

    // Logout

    public function getLogout(LogoutAction $action): RedirectResponse
    {
      $action->handle();

      return redirect()->route('getComments');
    }
  }