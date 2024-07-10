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
        Schema::create('student_groups', function (Blueprint $table) {
            $table->id(); // This will be the group number
            $table->foreignId('thesis_topic_id')->constrained('thesis_topics')->onDelete('cascade')->onUpdate('cascade');
            $table->string('year')->nullable();
            $table->string('room')->nullable();
            $table->string('academic_year')->nullable();
            $table->boolean('degree')->default(false);
            $table->string('level')->nullable();
            $table->string('major')->nullable();
            $table->string('system')->nullable();
            $table->string('study_time')->nullable();
            $table->string('advisor')->nullable();
            $table->timestamps();
        });

        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained('student_groups')->onDelete('cascade')->onUpdate('cascade');
            $table->string('student_id')->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
        Schema::dropIfExists('student_groups');
    }
};
