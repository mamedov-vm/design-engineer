<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AllowOnlyAjaxRequests
{
    /**
     * Допускает только AJAX запрос
     *
     * @param Request $request
     * @param Closure $next
     * @return Response|RedirectResponse|JsonResponse
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse|JsonResponse
    {
        if (!$request->ajax()) {
            abort(403, 'Метод недоступен');
        }

        return $next($request);
    }
}