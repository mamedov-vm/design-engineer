<?php

namespace App\Modules\Account\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Support\Str;

class LoginRule implements InvokableRule
{
    public function __invoke($attribute, $value, $fail): void
    {
      if (strlen($value) < 5) {
        $fail('Поле :attribute должно содержать минимум 5 символов');
      }

      if (strlen($value) > 15) {
        $fail('Поле :attribute должно содержать максимум 15 символов');
      }

      /* Не более одного "_" */
      if (Str::substrCount($value, '_') > 1) {
        $fail('Поле :attribute может содержать не более одного нижнего подчеркивания');
      }

      /* Не более одного "-" */
      if (Str::substrCount($value, '-') > 1) {
        $fail('Поле :attribute может содержать не более одного тире');
      }

      /* Не более трех цифр */
      if (Str::length(preg_replace('/\D/', '', $value)) > 3) {
        $fail('Поле :attribute может содержать не более трех цифр');
      }

      /* Не содержит спецсимволы */
      if (!Str($value)->test('/^[a-zA-Zа-яА-ЯёЁ0-9_\-]+$/')) {
        $fail('Поле :attribute не должно содержать специальные символы, кроме нижнего подчеркивания или тире');
      }
    }
}
