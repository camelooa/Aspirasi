<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'nis')) {
                $table->string('nis')->nullable()->unique()->after('email');
            }

            if (!Schema::hasColumn('users', 'kelas')) {
                $table->string('kelas')->nullable()->after('nis');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'kelas')) {
                $table->dropColumn('kelas');
            }

            if (Schema::hasColumn('users', 'nis')) {
                $table->dropUnique(['nis']);
                $table->dropColumn('nis');
            }
        });
    }
};
