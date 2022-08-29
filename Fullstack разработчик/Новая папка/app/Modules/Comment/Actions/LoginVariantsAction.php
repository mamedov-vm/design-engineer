<?php

  namespace App\Modules\Comment\Actions;

  use Illuminate\Http\Request;
  use Validator;
  use App\Modules\User\Models\User;

  class LoginVariantsAction
  {
    public function handle(Request $request): array
    {
      /**
       * Я не выношу request post-запросов в FormRequest,
       * чтобы контролировать вывод ошибок на фронт
       */

      $validator = Validator::make(
        $request->all(),
        [
          'login' => ['required', 'string'],
        ]
      );

      if ($validator->fails()) {
        return [
          'status'     => false,
          'textStatus' => 'Уведомление|Ошибка валидации данных',
        ];
      }

      $validatedData = $validator->validate();

      /**
       * Можно сделать дополнительную обвязку,
       * чтобы разделить ответственность Action-а,
       * но, по мне, это избыточно в данном случае
       */
      $logins = User::query()->where('login', 'LIKE', '%' . $validatedData['login'] . '%')->get(['login']);

      return [
        'status'     => true,
        'textStatus' => 'OK',
        'logins'     => $logins,
      ];
    }
  }