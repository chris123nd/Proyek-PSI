<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Umkm;
use Carbon\Carbon;

class AutoCancelUMKM extends Command
{
    protected $signature = 'umkm:auto-cancel';
    protected $description = 'Cancel otomatis UMKM jika lebih dari 2 hari belum diverifikasi';

    public function handle()
    {
        $umkms = Umkm::where('status', 'open')
            ->whereDate('created_at', '<=', Carbon::now()->subDays(2))
            ->get();

        foreach ($umkms as $umkm) {
            $umkm->update(['status' => 'cancel']);
        }

        $this->info('UMKM status updated to cancel for entries older than 2 days.');
    }
}
