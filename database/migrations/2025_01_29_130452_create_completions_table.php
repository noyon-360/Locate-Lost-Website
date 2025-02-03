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
        Schema::create('completions', function (Blueprint $table) {
            $table->id();
            $table->date('found_date');
            // Use foreignId for better readability and maintainability
            $table->foreignId('missing_person_id')->constrained('missing_people')->onDelete('cascade');
            $table->string('found_location');
            $table->text('recovery_details');
            $table->json('documents')->nullable(); // Store multiple file paths
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('completions');
    }
};
