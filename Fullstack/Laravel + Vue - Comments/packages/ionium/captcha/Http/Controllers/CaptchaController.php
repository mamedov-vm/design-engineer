<?php

  namespace Ionium\Captcha\Http\Controllers;

  use App\Modules\Tmm\Controllers\Controller;
  use Illuminate\Http\JsonResponse;

  class CaptchaController extends Controller
  {
    /**
     * Страница добавления нового контента на сайт
     *
     * @return JsonResponse
     */
    public function update(): JsonResponse
    {
      return response()->json(['captcha' => app('captcha')->getCaptcha()]);
    }
  }
                                                                                                     