<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('schools') && !Schema::hasColumn('schools', 'school_status')) {
            Schema::table('schools', function (Blueprint $table) {
                $table->unsignedTinyInteger('school_status')->default(10)->after('registration_date');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('schools') && Schema::hasColumn('schools', 'school_status')) {
            Schema::table('schools', function (Blueprint $table) {
                $table->dropColumn('school_status');
            });
        }
    }
};
