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
        Schema::create('leave_requests', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->enum('leave_type', ['Tahunan', 'Sakit']);
        $table->date('start_date');
        $table->date('end_date');
        $table->unsignedSmallInteger('total_days');
        $table->text('reason');
        $table->string('emergency_contact');
        $table->string('leave_address');
        $table->string('doctor_letter_path')->nullable();
        
        // Status dan Approval
        $table->enum('status', ['Pending', 'Approved by Leader', 'Approved', 'Rejected', 'Cancelled'])->default('Pending');
        
        $table->foreignId('leader_approver_id')->nullable()->constrained('users')->onDelete('set null');
        $table->timestamp('leader_approved_at')->nullable();
        $table->text('leader_note')->nullable();
        
        $table->foreignId('hrd_approver_id')->nullable()->constrained('users')->onDelete('set null');
        $table->timestamp('hrd_approved_at')->nullable();
        $table->text('hrd_note')->nullable();

        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_requests');
    }
};
