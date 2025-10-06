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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained('maju_career_applications')->onDelete('cascade');
            $table->enum('gender', ['male','female']);
            $table->string('post_applied')->nullable();
            $table->date('join_date')->nullable();
            $table->enum('highest_degree', ['phd','masters18','masters16','bachelors','other']);
            $table->string('specialization')->nullable();
            $table->string('institute')->nullable();
            $table->year('passing_year')->nullable();
            $table->string('org_recent')->nullable();
            $table->string('designation_recent')->nullable();
            $table->date('date_of_joining')->nullable();
            $table->integer('years_experience')->nullable();
            $table->string('resume')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
