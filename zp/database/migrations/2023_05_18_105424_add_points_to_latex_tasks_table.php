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
        Schema::table('latex_tasks', function (Blueprint $table) {
            $table->integer('points')->after('images');  // or you can use float or decimal depending on your needs
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('latex_tasks', function (Blueprint $table) {
            //
        });
    }
};
