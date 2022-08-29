<?php

  namespace App\Modules\User\Models\ENUM;

  enum RolesEnum: int
  {
    /** Создатель */
    case CREATOR = 1;
    /** Администратор */
    case ADMINISTRATOR = 2;
    /** Модератор */
    case MODERATOR = 3;
    /** Редактор */
    case REDACTOR = 4;
    /** Исполнитель */
    case WORKER = 5;
    /** Привилегированный пользователь */
    case VIP_USER = 6;
    /** Пользователь */
    case USER = 7;
    /** Гость */
    case GUEST = 8;


    public function group(): string
    {
      return match ($this) {
        self::CREATOR => 'Ведущий специалист',
        self::ADMINISTRATOR => 'Администратор',
        self::MODERATOR => 'Модератор',
        self::REDACTOR => 'Редактор',
        self::WORKER => 'Исполнитель',
        self::VIP_USER => 'VIP Пользователь',
        self::USER => 'Пользователь',
        self::GUEST => 'Гость',
      };
    }
  }
