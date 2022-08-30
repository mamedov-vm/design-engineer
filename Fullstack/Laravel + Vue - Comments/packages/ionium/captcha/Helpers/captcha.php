<?php

if (!function_exists('setCaptcha')) {
    /**
     * @return string - относительный путь роутера
     */
    function setCaptcha(): string
    {
        return app('captcha')->captcha();
    }
}