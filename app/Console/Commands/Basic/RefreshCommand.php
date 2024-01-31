<?php

namespace App\Console\Commands\Basic;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class RefreshCommand extends Command
{
    protected $signature = 'app:refresh';

    protected $description = 'Refresh app';

    public function handle()
    {
        if (app()->isProduction()) {
            return self::FAILURE;
        }

        Storage::deleteDirectory('public');
        Storage::createDirectory('public');
//        $this->call('storage:link');

        $this->call('migrate:fresh', [
            '--seed' => true,
        ]);
    }
}
