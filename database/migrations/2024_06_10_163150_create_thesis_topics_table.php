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
        Schema::create('thesis_topics', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('teacher_id');
            $table->foreignId('result_id')->nullable()->constrained('result_ofdefenses')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('book_id')->nullable()->constrained('thesis_books')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('plan_id')->nullable()->constrained('tbplans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('allow_id')->nullable()->constrained('allows')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('type_id')->constrained('types')->onDelete('cascade')->onUpdate('cascade');
            $table->string('topic_name');
            $table->string('topic_name_eng');
            $table->timestamps();
            

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thesis_topics');
    }
};
