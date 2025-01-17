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
        if (!Schema::hasTable('submitted_infos')) {
            Schema::create('submitted_infos', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('missing_person_id');
                $table->text('description');
                $table->timestamps();

                // Foreign key constraint
                $table->foreign('missing_person_id')->references('id')->on('missing_people')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submitted_infos');
    }
};