<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('schools')) {
            Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('school_type')->nullable(); // single | mixed
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('registration_code')->unique();
            $table->timestamp('registration_date')->useCurrent();
            $table->unsignedBigInteger('added_by')->nullable();
            $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};
