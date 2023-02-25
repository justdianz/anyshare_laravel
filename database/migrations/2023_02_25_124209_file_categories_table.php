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
        Schema::create('file_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('No Name');
            $table->tinyText('file_extension')->unique();
            $table->string('icon_path')->default('/assets/icons/file.png');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_categories');
    }
};
