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
        Schema::create('maju_career_applications', function (Blueprint $table) {
                $table->id();
                $table->foreignId('career_job_id')->nullable()->constrained('career_jobs')->nullOnDelete();
                $table->enum('job_type', ['permanent_faculty','visiting_faculty','staff']);
                $table->string('name');
                $table->string('contact', 50);
                $table->string('email')->nullable();
                $table->date('dob');
                $table->string('salary_desired', 50)->nullable();
                $table->text('postal_address')->nullable();
                $table->string('city', 100)->nullable();
                $table->tinyInteger('is_shortlisted')->default(0);
                $table->tinyInteger('is_rejected')->default(0);
                $table->tinyInteger('is_archived')->default(0);  
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maju_career_applications');
    }
};
