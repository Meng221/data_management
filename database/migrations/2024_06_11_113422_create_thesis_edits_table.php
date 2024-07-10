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
        Schema::create('thesis_edits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('thesis_topic_id');
            $table->unsignedBigInteger('accept_edit_id');
            $table->timestamps();

            // Referenses PK
            $table->foreign('thesis_topic_id')->references('id')->on('thesis_topics');
            $table->foreign('accept_edit_id')->references('id')->on('accept_edits');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thesis_edits');
    }
};
