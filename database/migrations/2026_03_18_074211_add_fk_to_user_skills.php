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
    Schema::table('user_skills', function (Blueprint $table) {
        $table->foreign('roadmap_id')
              ->references('id')
              ->on('roadmaps')
              ->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('user_skills', function (Blueprint $table) {
        $table->dropForeign(['roadmap_id']);
    });
}
};
