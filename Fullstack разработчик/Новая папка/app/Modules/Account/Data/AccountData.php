<?php

  namespace App\Modules\Account\Data;

  class AccountData
  {
    const fields = [
      'email'    => [
        'type'    => 'email',
        'icon'    => 'fas fa-at',
        'label'   => 'Email',
        'pattern' => '([a-zA-Z0-9_.-]{1,20})@([a-zA-Z0-9_.-]+)\.([a-zA-Z\.]{2,10})',
        'info'    => 'Требования к email-адресу:<br>
									 - email-адрес должен <i>принадлежать Вам</i>;<br>
									 - email-адрес должен <i>быть рабочим</i>;<br>
									 - email-адрес изменить <i>нельзя</i>;<br>
									 - подтверждение адреса <i>обязательно</i>.',
      ],
      'login'    => [
        'type'    => 'text',
        'icon'    => 'fa fa-user',
        'label'   => 'Логин',
        'pattern' => '[a-zA-Z0-9]{5,12}',
        'info'    => 'Логин может содержать:<br>
									 - <i>латинские</i> и <i>кириллические</i> символы;<br>
									 - от <i>5</i> до <i>12</i> символов;<br>
									 - <i>одно</i> нижнее подчеркивание;<br>
									 - <i>одно</i> тире;<br>
									 - не более <i>трех</i> цифр.',
      ],
      'password' => [
        'type'    => 'password',
        'icon'    => 'fa fa-lock',
        'label'   => 'Пароль',
        'pattern' => '(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z!@#$%^&*]{8,20}',
        'info'    => 'Пароль должен содержать:<br>
									 - от <i>8</i> до <i>20</i> символов;<br>
									 - <i>цифры</i> и <i>буквы</i>;<br>
									 - хотя бы <i>одну</i> букву верхнего регистра;<br>
									 - хотя бы <i>одну</i> букву нижнего регистра;<br>
									 - хотя бы <i>один</i> символ [!@#$%^&*];',
      ],
    ];
  }