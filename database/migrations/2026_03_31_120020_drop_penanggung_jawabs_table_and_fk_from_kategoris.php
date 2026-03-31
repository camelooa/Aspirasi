<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kategoris', function (Blueprint $table) {
            if (Schema::hasColumn('kategoris', 'penanggung_jawab_id')) {
                $table->dropForeign(['penanggung_jawab_id']);
                $table->dropColumn('penanggung_jawab_id');
            }
        });

        Schema::dropIfExists('penanggung_jawabs');
    }

    public function down(): void
    {
        Schema::create('penanggung_jawabs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->nullable()->unique();
            $table->string('jabatan')->nullable();
            $table->timestamps();
        });

        Schema::table('kategoris', function (Blueprint $table) {
            if (!Schema::hasColumn('kategoris', 'penanggung_jawab_id')) {
                $table->foreignId('penanggung_jawab_id')
                    ->nullable()
                    ->after('details')
                    ->constrained('penanggung_jawabs')
                    ->nullOnDelete();
            }
        });
    }
};
