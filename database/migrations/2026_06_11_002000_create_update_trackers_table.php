<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpdateTrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('update_trackers')) {
            Schema::create('update_trackers', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('item_id')->nullable();
                $table->string('item_category')->nullable();
                $table->unsignedBigInteger('updated_by')->nullable();
                $table->timestamp('date_updated_on')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('update_trackers');
    }
}
