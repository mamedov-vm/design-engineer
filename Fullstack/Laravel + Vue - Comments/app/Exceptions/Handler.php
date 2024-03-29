<?php

  namespace App\Exceptions;

  use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
  use Throwable;
  use Illuminate\Http\RedirectResponse;
  use Symfony\Component\HttpFoundation\Response;
  use Illuminate\Http\JsonResponse;
  use Illuminate\Auth\AuthenticationException;

  class Handler extends ExceptionHandler
  {
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
      //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
      'current_password',
      'password',
      'password_confirmation',
    ];


    protected function unauthenticated($request, AuthenticationException $exception): JsonResponse|Response|RedirectResponse
    {
      return $request->expectsJson()
        ? response()->json(['message' => $exception->getMessage()], 401)
        : redirect()->guest($exception->redirectTo() ?? route(routeNameWith('account.getLogin', 'Доступ запрещен|Выполните вход в аккаунт')));
    }

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register(): void
    {
      $this->reportable(function (Throwable $e) {
        //
      });
    }
  }
