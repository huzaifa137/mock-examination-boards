<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('school_type')->nullable();
            $table->string('email')->nullable();
            $table->string('gender')->nullable();
            $table->string('regional_level')->nullable();
            $table->string('school_ownership')->nullable();
            $table->string('boarding_status')->nullable();
            $table->string('name')->nullable();
            $table->string('school_product')->nullable();
            $table->string('registration_code')->nullable()->unique();
            $table->string('phone')->nullable();
            $table->string('population')->nullable();
            $table->unsignedBigInteger('added_by')->nullable();
            $table->timestamp('date_added')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};
