<?php

  namespace App\Modules\User\database\seeders;

  use Illuminate\Database\Seeder;
  use App\Modules\User\Models\User;
  use Illuminate\Contracts\Container\BindingResolutionException;
  use Illuminate\Container\Container;
  use Faker\Generator;

  class UserSeeder extends Seeder
  {
    protected mixed $faker;

    /**
     * @throws BindingResolutionException
     */
    public function __construct()
    {
      $this->faker = $this->withFaker();
    }

    /**
     * @throws BindingResolutionException
     */
    protected function withFaker()
    {
      return Container::getInstance()->make(Generator::class);
    }

    public function run(): void
    {
      User::create([
        'login'    => 'admin',
        'email'    => 'admin@admin.ru',
        'password' => 'qQ@22222',
      ]);

      User::create([
        'login'    => 'admin2',
        'email'    => 'admin2@admin.ru',
        'password' => 'qQ@22222',
      ]);

      User::create([
        'login'    => 'admin3',
        'email'    => 'admin3@admin.ru',
        'password' => 'qQ@22222',
      ]);

      /* Мне было лень писать фабрику */
      for ($i = 2; $i < 11; $i++) {
        User::create([
          'login'    => $this->faker->userName,
          'email'    => $this->faker->unique()->email,
          'password' => 'qQ@22222',
        ]);
      }
    }
  }
