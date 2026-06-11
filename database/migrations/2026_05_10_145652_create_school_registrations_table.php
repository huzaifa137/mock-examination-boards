<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolRegistrationsTable extends Migration
{
    public function up()
    {
        Schema::create('school_registrations', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('school_id');

            $table->string('school_name');
            $table->string('school_name_ar')->nullable();

            $table->string('location')->nullable();
            
            $table->date('registration_date')->nullable();
            
            $table->timestamps();

            $table->foreign('school_id')->references('ID')->on('houses')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('school_registrations');
    }
}