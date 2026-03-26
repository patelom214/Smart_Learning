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
        Schema::table('user_skills', function (Blueprint $table) {
            // ✅ Add roadmap_id column
            $table->unsignedBigInteger('roadmap_id')->nullable()->after('skill_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_skills', function (Blueprint $table) {
            // ✅ Drop column safely
            if (Schema::hasColumn('user_skills', 'roadmap_id')) {
                $table->dropColumn('roadmap_id');
            }
        });
    }
};
