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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('missing_report_id'); // Refers to MissingReport
            $table->text('content');
            $table->morphs('commentable'); // Adds 'commentable_id' and 'commentable_type' columns
            $table->timestamps();
        
            $table->foreign('missing_report_id')->references('id')->on('missing_people')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
