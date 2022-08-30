<?php

  namespace App\Console\Commands\Log;

  use Illuminate\Console\Command;

  class ClearLogFile extends Command
  {
    protected $signature = 'log:clear';

    protected $description = 'Clear Laravel log';

    public function handle()
    {
      exec('echo [' . now() . '] local.info: Logs have been cleared > ' . storage_path('logs/laravel.log'));
      $this->info('Logs have been cleared');
    }
  }
