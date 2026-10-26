<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('app_galleries', function (Blueprint $table) {
            if (!Schema::hasColumn('app_galleries', 'jurusan')) {
                $table->string('jurusan')->default('PPLG')->after('student_class');
            }
            if (!Schema::hasColumn('app_galleries', 'images')) {
                $table->json('images')->nullable()->after('thumbnail');
            }
        });

        // Sync existing data if category exists: if category had data, map or set default
        if (Schema::hasColumn('app_galleries', 'category')) {
            DB::table('app_galleries')->whereNull('jurusan')->orWhere('jurusan', '')->update(['jurusan' => 'PPLG']);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('app_galleries', function (Blueprint $table) {
            if (Schema::hasColumn('app_galleries', 'images')) {
                $table->dropColumn('images');
            }
            if (Schema::hasColumn('app_galleries', 'jurusan')) {
                $table->dropColumn('jurusan');
            }
        });
    }
};
