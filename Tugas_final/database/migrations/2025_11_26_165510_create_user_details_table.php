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
        Schema::create('user_details', function (Blueprint $table) {
        $table->id();
        // Foreign Key One-to-One
        $table->foreignId('user_id')
              ->unique()
              ->constrained('users')
              ->onDelete('cascade');
              
        $table->unsignedSmallInteger('annual_leave_quota')->default(12); // Default 12 hari
        $table->unsignedSmallInteger('used_leave_days')->default(0);
        $table->string('phone_number')->nullable();
        $table->text('address')->nullable();
        $table->string('photo_path')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};
