<?php

  use Illuminate\Http\RedirectResponse;

  if (!function_exists('routeUrl')) {
    /**
     * Возвращает url маршрута в относительном виде
     *
     * @param array|string $name       Имя маршрута
     * @param array        $parameters Массив с параметрами
     * @return string Относительный путь маршрута
     */
    function routeUrl(array|string $name, array $parameters = []): string
    {
      return route($name, $parameters, false);
    }
  }

  if (!function_exists('routeWith')) {
    /**
     * Возвращает url маршрута в относительном виде при это
     * записывает сообщение в поле "noty" Session
     *
     * @param array|string $name         Имя маршрута
     * @param string       $notification Устанавливаемое сообщение в noty
     * @return string - относительный путь маршрута
     */
    function routeWith(array|string $name, string $notification = '', int $type = 2): string
    {
      Session::flash('notification', $notification);
      Session::flash('notificationType', $type);
      return route($name, [], false);
    }
  }

  if (!function_exists('routeNameWith')) {
    /**
     * Возвращает url маршрута в относительном виде при это
     * записывает сообщение в поле "noty" Session
     *
     * @param array|string $name         Имя маршрута
     * @param string       $notification Устанавливаемое сообщение в noty
     * @return string - относительный путь маршрута
     */
    function routeNameWith(array|string $name, string $notification = '', int $type = 2): string
    {
      Session::flash('notification', $notification);
      Session::flash('notificationType', $type);
      return $name;
    }
  }

  if (!function_exists('redirectBackWith')) {
    /**
     * Возвращает url маршрута в относительном виде при это
     * записывает сообщение в поле "noty" Session
     *
     * @param string $notification Устанавливаемое сообщение в noty
     * @param int    $type
     * @return RedirectResponse Redirect
     */
    function redirectBackWith(string $notification = '', int $type = 2): RedirectResponse
    {
      Session::flash('notification', $notification);
      Session::flash('notificationType', $type);

      return redirect()->back()->withInput();
    }
  }