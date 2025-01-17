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
        Schema::create('missing_people', function (Blueprint $table) {
            $table->id();
            $table->string('fullname', 255);
            $table->date('date_of_birth');
            $table->string('gender');
            $table->string('permanent_address');
            $table->text('last_seen_location_description');
            $table->string('father_name', 255);
            $table->string('mother_name', 255);
            $table->string('contact_number', 15);
            $table->string('email', 255);
            $table->string('front_image');
            $table->json('additional_pictures')->nullable();
            $table->string('user_email');
            $table->unsignedBigInteger('user_id');
            $table->date('missing_date')->nullable();
            $table->timestamps();

            // Foreign key constraint (optional, if you have a users table)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('missing_people');
    }
};