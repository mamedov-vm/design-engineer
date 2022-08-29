<?php

  namespace App\Modules\Comment\database\seeders;

  use Faker\Generator;
  use Illuminate\Container\Container;
  use Illuminate\Database\Seeder;
  use Illuminate\Database\Console\Seeds\WithoutModelEvents;
  use App\Modules\Comment\Models\Comment;
  use Illuminate\Contracts\Container\BindingResolutionException;

  class CommentsSeeder extends Seeder
  {
    use WithoutModelEvents;

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
      /* Мне было лень писать фабрику */
      for ($i = 0; $i < 100; $i++) {
        Comment::create([
          'user_id' => mt_rand(1, 10),
          'content' => $this->faker->text(150),
        ]);
      }
    }
  }
