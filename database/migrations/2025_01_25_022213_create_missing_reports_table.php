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
        Schema::create('missing_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('missing_person_id');
            $table->text('description');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('station_id')->nullable();
            $table->string('submitted_by')->nullable();
            $table->string('station_name')->nullable();
            $table->string('role');
            $table->dateTime('seen_at')->nullable();
            $table->timestamps();
        
            $table->foreign('missing_person_id')->references('id')->on('missing_people')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('station_id')->references('id')->on('stations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('missing_reports');
    }
};
