<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule; // ← WAJIB TAMBAH

// Command default Laravel
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Tambahkan scheduler auto-approve
Schedule::command('validasi:auto-approve')->everyMinute();
