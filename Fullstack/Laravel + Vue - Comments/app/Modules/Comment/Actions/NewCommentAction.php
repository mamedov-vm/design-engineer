<?php

  namespace App\Modules\Comment\Actions;

  use Illuminate\Http\Request;
  use Validator;
  use App\Modules\Comment\Models\Comment;
  use Illuminate\Support\Facades\Auth;

  class NewCommentAction
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
          'content' => ['required', 'string', 'max:200'],
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
      $comment          = new Comment();
      $comment->user_id = Auth::user()->id;
      $comment->content = $validatedData['content'];

      return [
        'status'     => $comment->save(),
        'textStatus' => 'OK',
        'comment'    => $comment,
      ];
    }
  }