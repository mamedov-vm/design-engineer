<?php

  namespace App\Modules\Account\Requests;

  use Illuminate\Foundation\Http\FormRequest;
  use JetBrains\PhpStorm\ArrayShape;
  use App\Modules\Account\Rules\PasswordRule;

  class LoginRequest extends FormRequest
  {
    public function authorize(): bool
    {
      return true;
    }

    #[ArrayShape(['email' => "string[]", 'password' => "array"])]
    public function rules(): array
    {
      return [
        'email'    => ['required', 'string', 'email', 'exists:users,email'],
        'password' => ['required', 'string', new PasswordRule()],
      ];
    }

    public function messages(): array
    {
      return [
        'email.exists'       => 'Аккаунт с таким email-адресом не существует',
        //
        'email.required'     => 'Поле :attribute обязательно для заполнения',
        'password.required'  => 'Поле :attribute обязательно для заполнения',
        //
        'email.email'        => 'Поле :attribute не соответствует требуемому формату',
      ];
    }
  }
