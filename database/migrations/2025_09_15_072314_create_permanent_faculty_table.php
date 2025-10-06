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
        Schema::create('permanent_faculty', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained('maju_career_applications')->onDelete('cascade');
            $table->enum('highest_degree', ['phd','masters18','masters16','bachelors','other']);
            $table->string('specialization')->nullable();
            $table->string('institute')->nullable();
            $table->year('passing_year')->nullable();
            $table->set('post_applied', ['professor','associate_professor','assistant_professor','lecturer','instructor','lab_engineer'])->nullable();
            $table->string('org_recent')->nullable();
            $table->string('designation_recent')->nullable();
            $table->string('resume')->nullable();
            $table->string('degree_certificate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permanent_faculty');
    }
};
