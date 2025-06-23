<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\AutoCancelUMKM::class, // Tambahkan command kamu di sini
    ];

    protected function schedule(Schedule $schedule): void
    {
        // Jalankan setiap hari
        $schedule->command('umkm:auto-cancel')->daily();
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
