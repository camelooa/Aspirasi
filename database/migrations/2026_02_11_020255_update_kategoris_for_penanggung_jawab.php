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
        Schema::table('kategoris', function (Blueprint $table) {
            $table->foreignId('penanggung_jawab_id')
                ->nullable()
                ->after('details')
                ->constrained('penanggung_jawabs')
                ->onDelete('set null');
                
            $table->dropForeign(['admin_id']);
            $table->dropColumn('admin_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kategoris', function (Blueprint $table) {
            $table->dropForeign(['penanggung_jawab_id']);
            $table->dropColumn('penanggung_jawab_id');
            
            $table->foreignId('admin_id')
                ->nullable()
                ->after('details')
                ->constrained('users')
                ->onDelete('set null');
        });
    }
};
