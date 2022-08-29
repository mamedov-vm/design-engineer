<?php

  namespace App\Modules\Account\Rules;

  use Illuminate\Contracts\Validation\InvokableRule;

  class PasswordRule implements InvokableRule
  {
    public function __invoke($attribute, $value, $fail): void
    {
      if (strlen($value) < 8) {
        $fail('Поле :attribute должно содержать минимум 8 символов');
      }

      if (strlen($value) > 20) {
        $fail('Поле :attribute должно содержать максимум 20 символов');
      }

      if (!preg_match('/(\p{Ll}+.*\p{Lu})|(\p{Lu}+.*\p{Ll})/u', $value)) {
        $fail('Поле :attribute должно содержать хотя бы один символ в нижнем и верхнем регистре');
      }

      if (!preg_match('/\pL/u', $value)) {
        $fail('Поле :attribute должно содержать хотя бы одну букву');
      }

      if (!preg_match('/\p{Z}|\p{S}|\p{P}/u', $value)) {
        $fail('Поле :attribute должно содержать хотя бы один специальный символ');
      }

      if (!preg_match('/\pN/u', $value)) {
        $fail('Поле :attribute должно содержать хотя бы одну цифру');
      }
    }
  }
