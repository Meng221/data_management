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
        Schema::create('score_and_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('thesis_topic_id')->nullable();
            $table->unsignedBigInteger('student_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('lesson_4')->nullable();
            $table->integer('lesson_5')->nullable();
            $table->integer('thesis')->nullable();
            $table->integer('poster')->nullable();
            $table->integer('project')->nullable();
            $table->integer('q_and_a')->nullable();
            $table->integer('presentation')->nullable();
            $table->integer('average')->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();

            $table->foreign('thesis_topic_id')->references('id')->on('thesis_topics')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('score_and_comments');
    }
};
