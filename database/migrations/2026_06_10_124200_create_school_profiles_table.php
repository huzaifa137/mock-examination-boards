<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('school_profiles')) {
            Schema::create('school_profiles', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('school_id')->unique();
                $table->string('school_type')->nullable();
                $table->string('email')->nullable();
                $table->string('gender')->nullable();
                $table->string('boarding_status')->nullable();
                $table->string('name')->nullable();
                $table->string('registration_code')->nullable();
                $table->string('phone')->nullable();
                $table->string('population')->nullable();
                $table->string('motto')->nullable();
                $table->string('vision')->nullable();
                $table->string('admission_prefix')->nullable();
                $table->string('admission_start')->nullable();
                $table->string('admission_suffix')->nullable();
                $table->string('logo')->nullable();
                $table->timestamps();

                $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('school_profiles');
    }
};
