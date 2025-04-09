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
        Schema::create('employee_attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('staff_id');
            // Foreign key constraint linking to the staff table
            $table->foreign('staff_id')->references('id')->on('staff')->onDelete('cascade');
            
            $table->date('date');  // The specific date for attendance
            $table->timestamp('in')->nullable();  // In Time column (nullable)
            $table->timestamp('out')->nullable();  // Out Time column (nullable)
            $table->softDeletes(); // For soft deletes
            $table->timestamps();  // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the employee_attendances table
        Schema::dropIfExists('employee_attendances');
    }
};
