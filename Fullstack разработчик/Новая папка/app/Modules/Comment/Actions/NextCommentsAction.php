<?php

  namespace App\Modules\Comment\Actions;

  use App\Modules\Comment\Models\Comment;
  use Illuminate\Support\Facades\Validator;
  use Illuminate\Http\Request;

  class NextCommentsAction
  {
    public function handle(Request $request, int $commentsPerPage): array
    {
      /**
       * Я не выношу request post-запросов в FormRequest,
       * чтобы контролировать вывод ошибок на фронт
       */

      $validator = Validator::make(
        $request->all(),
        [
          'offset' => ['required', 'int'],
        ]
      );

      if ($validator->fails()) {
        return [
          'status'     => false,
          'textStatus' => 'Уведомление|Ошибка валидации данных',
        ];
      }

      $validatedData = $validator->validate();

      return [
        'status'     => true,
        'textStatus' => 'OK',
        'page'       => Comment::query()
          ->with('user')
          ->orderBy('id', 'DESC')
          ->offset($validatedData['offset'])
          ->limit($commentsPerPage)
          ->get()
          ->keyBy('id'),
      ];
    }
  }