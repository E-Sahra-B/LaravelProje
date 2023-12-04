<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\MailCronJob::class,
    ];
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('app:mail-cron')->dailyAt('18:30')->timezone('Europe/Istanbul');
    }

    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');
        require base_path('routes/console.php');
    }
}
