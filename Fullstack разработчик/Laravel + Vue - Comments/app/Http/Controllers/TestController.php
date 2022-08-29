<?php

  namespace App\Http\Controllers;

  use App\Modules\Profile\Services\Settings\Confidentials\ConfidentialsSetting;
  use App\Modules\Profile\Services\Settings\SettingsTypeEnum;
  use App\Modules\Profile\Services\Statistics\StatisticsTypeEnum;
  use App\Modules\Profile\Services\Notifications\Notifications;
  use App\Modules\User\Models\User\Ban;
  use App\Modules\Profile\Services\Socials\Socials;
  use App\Modules\User\Models\User\Balance;
  use App\Modules\User\Models\User\Bonus;

  class TestController extends Controller
  {
    public function test()
    {
//      $data = [
//        'z1'            => 11,
//        'z2'            => 14,
//        'm'             => 2.5,
//        'betta'         => 0,
//        'X1'            => 0.5,
//        'X2'            => 0.5,
//        'alpha'         => 20,
//        'ha'            => 1,
//        'hf'            => 1,
//        'c'             => 0.25,
//        'epsAlphaLimit' => 1.1,
//        'haLimit'       => 0.4,
//      ];
//
//
//      $gear = new TmmChartModule($data);
//      $gear->calculateConstantData();
//      $gear->calculateVariableData();
//      $gear->calculateLimitsOfQuality();
//      $gear->gearingAnalysis();
//
//      dump($gear->constRoundedData);
//      dump($gear->varData);
//      dump($gear->qualityData);
//      dump($gear->characteristicData);
//      dump($gear->recommendationData);
      //return $gear->constData;
//      Ban::create([
//        'admin_id' => 1,
//        'user_id' => 2,
//        'begin_at' => now(),
//        'ended_at' => now()->addDays(3),
//        'proof' => 'Плохой мальчик'
//      ]);

//      Notifications::good($user)->new('Привет!');

//      $user->profile->save();
//      dump($user->profile->bans_assigned);
//      dump(Ban::find(2)->admin);

//      Socials::newBan(
//        User::find(2),
//        3,
//        'Жопка'
//      );
//      $user = User::find(2);
//
//      dump(Socials::socialStatus($user));
//      return (new ConfidentialsSetting())->data();

      $balance          = new Bonus();
      $balance->user_id = 2;
      $balance->balance = 300;
      $balance->exp     = 100;
      $balance->type_id = 1;
      $balance->save();
      dump($balance->id);
//      $user = User::find(2);
//
//      dump($user->balances()->orderBy('id', 'DESC')->paginate(3));

    }
  }
