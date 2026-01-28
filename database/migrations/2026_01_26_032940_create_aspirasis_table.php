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
        Schema::create('aspirasis', function (Blueprint $table) {
            $table->id('id')->primary();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('category_id')->constrained('kategoris');
            $table->string('feedback_title');
            $table->text('details');
            $table->string('location');
            $table->enum('status',['complete','on_progress']);
            $table->string('image')->nullable();
            $table->text('admin_response')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspirasis');
    }
};
