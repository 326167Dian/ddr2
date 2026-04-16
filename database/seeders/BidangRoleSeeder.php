<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BidangRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['id' => 1, 'name' => 'Ketua', 'slug' => 'ketua'],
            ['id' => 2, 'name' => 'Wakil Ketua', 'slug' => 'wakil'],
            ['id' => 3, 'name' => 'Sekretaris', 'slug' => 'sekretaris'],
            ['id' => 4, 'name' => 'Bendahara', 'slug' => 'bendahara'],
            ['id' => 5, 'name' => 'Anggota', 'slug' => 'anggota'],
        ];

        foreach ($roles as $role) {
            \Illuminate\Support\Facades\DB::table('bidang_roles')->insert([
                'id' => $role['id'],
                'name' => $role['name'],
                'slug' => $role['slug'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
