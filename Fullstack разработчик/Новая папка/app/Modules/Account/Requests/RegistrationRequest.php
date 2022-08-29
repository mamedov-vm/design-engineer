<?php

  namespace App\Modules\Account\Requests;

  use Illuminate\Foundation\Http\FormRequest;
  use JetBrains\PhpStorm\ArrayShape;
  use App\Modules\Account\Rules\LoginRule;
  use App\Modules\Account\Rules\PasswordRule;

  class RegistrationRequest extends FormRequest
  {
    public function authorize(): bool
    {
      return true;
    }

    #[ArrayShape(['email' => "string[]", 'login' => "array", 'password' => "array"])]
    public function rules(): array
    {
      return [
        'email'    => ['required', 'string', 'email', 'unique:Users,email'],
        'login'    => ['required', 'string', new LoginRule(), 'unique:Users,login'],
        'password' => ['required', 'string', new PasswordRule(), 'confirmed'],
      ];
    }

    public function messages(): array
    {
      return [
        'email.unique'       => 'Аккаунт с таким email-адресом уже существует',
        'login.unique'       => 'Выбранный логин уже используется',
        //
        'email.required'     => 'Поле :attribute обязательно для заполнения',
        'login.required'     => 'Поле :attribute обязательно для заполнения',
        'password.required'  => 'Поле :attribute обязательно для заполнения',
        //
        'email.email'        => 'Поле :attribute не соответствует требуемому формату',
        //
        'password.confirmed' => 'Значения в поле :attribute и подтверждение не совпадают',
      ];
    }
  }
