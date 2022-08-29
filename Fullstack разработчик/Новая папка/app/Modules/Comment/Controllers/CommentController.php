<?php

  namespace App\Modules\Comment\Controllers;

  use App\Http\Controllers\Controller;
  use Illuminate\Http\Request;
  use Illuminate\Contracts\Foundation\Application;
  use Illuminate\Contracts\View\View;
  use Illuminate\Contracts\View\Factory;
  use App\Modules\Comment\Actions\NextCommentsAction;
  use Illuminate\Support\Facades\Response;
  use Illuminate\Http\JsonResponse;
  use App\Modules\Comment\Actions\NewCommentAction;
  use Illuminate\Support\Facades\Auth;
  use App\Modules\Comment\Models\Comment;
  use App\Modules\Comment\Actions\LoginVariantsAction;

  class CommentController extends Controller
  {

    const COMMENTS_PER_PAGE = 3;

    public function getComments(): Factory|View|Application
    {
      return view('pages.index.index', [
        'data' => [
          'isAuth'   => Auth::check(),
          'user'     => Auth::check() ? Auth::user() : [],
          'comments' => Comment::query()
            ->with('user')
            ->orderBy('id', 'DESC')
            ->offset(0)
            ->limit(self::COMMENTS_PER_PAGE)
            ->get()
            ->keyBy('id'),
        ],
      ]);
    }

    public function postNextComments(Request $request, NextCommentsAction $action): JsonResponse
    {
      $result = $action->handle($request, self::COMMENTS_PER_PAGE);

      return Response::json([
        ...$result,
        'page' => $result['page'] ?? [],
      ]);
    }

    public function postNewComment(Request $request, NewCommentAction $action): JsonResponse
    {
      $result = $action->handle($request);

      return Response::json([
        ...$result,
        'comment' => $result['comment'] ?? [],
      ]);
    }

    public function postLoginVariants(Request $request, LoginVariantsAction $action): JsonResponse
    {
      $result = $action->handle($request);

      return Response::json([
        ...$result,
        'logins' => $result['logins'] ?? [],
      ]);
    }
  }
