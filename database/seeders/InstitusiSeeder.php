<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstitusiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('institusis')->insert([
            [
                'nm_institusi' => 'Apotek',
                'keterangan' => 'Apotek',
            ],
            [
                'nm_institusi' => 'Klinik',
                'keterangan' => 'Klinik',
            ],
            [
                'nm_institusi' => 'Rumah Sakit',
                'keterangan' => 'Rumah Sakit',
            ],
            [
                'nm_institusi' => 'Industri',
                'keterangan' => 'Industri',
            ],
            [
                'nm_institusi' => 'Pemerintah',
                'keterangan' => 'Puskesmas, BPOM, Dinas Kesehatan',
            ],
        ]);
    }
}
