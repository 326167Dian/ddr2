<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('alamat')->nullable()->after('email'); // alamat lengkap
            $table->string('nm_institusi')->nullable()->after('alamat'); // nama institusi
            $table->string('kampus')->nullable()->after('nm_institusi'); // kampus
            $table->string('foto')->nullable()->after('kampus'); // path foto profil
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['no_tlp', 'alamat', 'nm_institusi', 'kampus', 'foto']);
        });
    }
};
