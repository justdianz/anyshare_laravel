<?php

use App\Models\FileCategory;
use App\Models\User;
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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->unsigned()->constrained()->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(FileCategory::class)->unsigned()->constrained()->restrictOnDelete()->cascadeOnUpdate();
            $table->string('path')->unique();
            $table->string('hashid')->unique();
            $table->string('display_name');
            $table->string('description')->nullable();
            $table->string('password')->nullable();
            $table->integer('size')->unsigned()->default(0);
            $table->timestamp('schedule_delete_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
