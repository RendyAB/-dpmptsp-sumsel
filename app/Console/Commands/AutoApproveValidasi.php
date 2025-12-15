<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Validasi;
use App\Models\ValidasiLog;
use Carbon\Carbon;

class AutoApproveValidasi extends Command
{
    protected $signature = 'validasi:auto-approve';
    protected $description = 'Auto-approve untuk madya_1 dan madya_2 setelah 1 jam tanpa aksi';

    public function handle()
    {
        $now = Carbon::now();

        // Hanya level 1 & 2 yang auto approve
        $items = Validasi::whereIn('current_level', [1, 2])
            ->where('status', 'menunggu')
            ->whereNotNull('last_action_at')
            ->get();

        foreach ($items as $item) {

            // Sudah lebih dari 1 jam?
            if ($item->last_action_at->diffInMinutes($now) >= 60) {

                $role = $item->current_level == 1 ? "madya_1" : "madya_2";
                $nextLevel = $item->current_level + 1;

                // buat log
                ValidasiLog::create([
                    'validasi_id' => $item->id,
                    'admin_id' => null, // auto system
                    'role' => $role,
                    'status' => 'disetujui',
                    'catatan' => 'Otomatis disetujui (timeout 1 jam)',
                    'validated_at' => $now,
                ]);

                // naik ke level berikutnya
                $item->update([
                    'current_level' => $nextLevel,
                    'last_action_at' => $now,
                ]);
            }
        }

        $this->info("Auto-approve run selesai");
    }
}

