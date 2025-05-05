<?php

namespace App\Console\Commands;

use App\Models\Perangkat;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class CheckPerangkatStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-perangkat-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ubah status perangkat jadi tidak aktif jika tidak ada heartbeat';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $cutoff = now()->subSeconds(30);

        $perangkatList = Perangkat::where('updated_at', '<', $cutoff)
            ->where('status', 'aktif')
            ->get();

        foreach ($perangkatList as $perangkat) {
            $perangkat->status = 'tidak aktif';
            $perangkat->save();

            $this->info("Perangkat ID {$perangkat->id} diubah menjadi tidak aktif pada " . now());
        }

        if ($perangkatList->isEmpty()) {
            $this->info("Tidak ada perangkat yang perlu diperbarui pada " . now());
        }
    }

}
