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
        Schema::create('latex_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('latex_file_id')->constrained()->onDelete('cascade');
            $table->text('task')->nullable();
            $table->text('solution')->nullable();
            $table->json('images')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('latex_tasks');
    }
};
