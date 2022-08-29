<?php

  namespace Database\Seeders;

  use Illuminate\Database\Seeder;
  use Illuminate\Support\Facades\Artisan;
  use App\Modules\Comment\database\seeders\CommentsSeeder;
  use App\Modules\User\database\seeders\UserSeeder;

  class DatabaseSeeder extends Seeder
  {
    public function run(): void
    {
      /* Добавление пользователей */
      $this->call(UserSeeder::class);

      /* Добавление комментариев */
      $this->call(CommentsSeeder::class);

      Artisan::call('cache:clear');
    }
  }
