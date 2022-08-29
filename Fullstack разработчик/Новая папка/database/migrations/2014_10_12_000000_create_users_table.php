<?php

  use Illuminate\Database\Migrations\Migration;
  use Illuminate\Database\Schema\Blueprint;
  use Illuminate\Support\Facades\Schema;
  use App\Modules\User\Models\ENUM\RolesEnum;

  return new class extends Migration {

    public function up(): void
    {
      Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('login')
          ->unique()
          ->comment('Имя или логин');
        $table
          ->string('email')
          ->unique()
          ->comment('Email');
        $table
          ->timestamp('email_verified_at')
          ->nullable()
          ->comment('Дата и время подтверждения email');
        $table
          ->string('password', 100)
          ->comment('Пароль');
        $table
          ->timestamp('password_changed_at')
          ->useCurrent()
          ->comment('Дата и время последнего изменения пароля');
        $table
          ->rememberToken()
          ->comment('Токен сессии аккаунта');
        $table
          ->boolean('is_active')
          ->default(true)
          ->comment('Статус аккаунта');
        $table
          ->unsignedTinyInteger('group')
          ->default(RolesEnum::USER->value)
          ->comment('Группа аккаунта');
        $table
          ->timestamp('registered_at')
          ->useCurrent()
          ->comment('Дата и время создания аккаунта');
        $table->softDeletes();
      });
    }

    public function down(): void
    {
      Schema::dropIfExists('users');
    }
  };
