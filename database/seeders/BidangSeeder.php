<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BidangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bidangs = [
            'Dak\'wah / Tabligh',
            'Ekonomi & Pembangunan SDM',
            'Sosial & Budaya',
            'Pendidikan',
        ];

        foreach ($bidangs as $bidang) {
            \Illuminate\Support\Facades\DB::table('bidangs')->insert([
                'name' => $bidang,
                'slug' => \Illuminate\Support\Str::slug($bidang),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
