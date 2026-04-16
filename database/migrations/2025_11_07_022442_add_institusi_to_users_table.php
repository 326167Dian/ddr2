<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('institusi_id')->nullable()->after('id');

            $table->foreign('institusi_id')
                ->references('id_institusi')
                ->on('institusis')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['institusi_id']);
            $table->dropColumn('institusi_id');
        });
    }
};
