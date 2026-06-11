<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('schools')) {
            Schema::table('schools', function (Blueprint $table) {
                if (!Schema::hasColumn('schools', 'school_type')) {
                    $table->string('school_type')->nullable()->after('id');
                }

                if (!Schema::hasColumn('schools', 'email')) {
                    $table->string('email')->nullable()->after('school_type');
                }

                if (!Schema::hasColumn('schools', 'phone')) {
                    $table->string('phone')->nullable()->after('email');
                }

                if (!Schema::hasColumn('schools', 'address')) {
                    $table->text('address')->nullable()->after('phone');
                }

                if (!Schema::hasColumn('schools', 'registration_code')) {
                    $table->string('registration_code')->nullable()->unique()->after('address');
                }

                if (!Schema::hasColumn('schools', 'registration_date')) {
                    $table->timestamp('registration_date')->useCurrent()->after('registration_code');
                }

                if (!Schema::hasColumn('schools', 'added_by')) {
                    $table->unsignedBigInteger('added_by')->nullable()->after('registration_date');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('schools')) {
            Schema::table('schools', function (Blueprint $table) {
                if (Schema::hasColumn('schools', 'address')) {
                    $table->dropColumn('address');
                }

                if (Schema::hasColumn('schools', 'phone')) {
                    $table->dropColumn('phone');
                }

                if (Schema::hasColumn('schools', 'email')) {
                    $table->dropColumn('email');
                }

                if (Schema::hasColumn('schools', 'school_type')) {
                    $table->dropColumn('school_type');
                }

                if (Schema::hasColumn('schools', 'registration_code')) {
                    $table->dropColumn('registration_code');
                }

                if (Schema::hasColumn('schools', 'registration_date')) {
                    $table->dropColumn('registration_date');
                }

                if (Schema::hasColumn('schools', 'added_by')) {
                    $table->dropColumn('added_by');
                }
            });
        }
    }
};
