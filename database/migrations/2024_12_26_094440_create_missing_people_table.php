<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('missing_people', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->date('date_of_birth');
            $table->string('gender');
            $table->string('permanent_address');
            $table->text('last_seen_location_description');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('contact_number')->unique();
            $table->string('email')->unique();
            $table->string('front_image');
            $table->json('additional_pictures')->nullable();
            $table->date('missing_date')->nullable();
            $table->enum('status', ['pending', 'completed'])->default('pending');
            $table->string('submitted_by');
            // $table->unsignedBigInteger('reported_by');
            $table->timestamps();

            // $table->foreign('reported_by')->references('id')->on('stations');
            // $table->foreignId('reported_by')->constrained('stations')->onDelete('cascade');
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
