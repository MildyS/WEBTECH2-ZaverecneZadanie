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
        Schema::table('latex_files', function (Blueprint $table) {
            $table->dateTime('publish_at')->nullable()->after('file_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('latex_files', function (Blueprint $table) {
            $table->dropColumn('publish_at');
        });
    }
};
