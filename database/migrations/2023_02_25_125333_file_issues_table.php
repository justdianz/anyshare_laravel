<?php

use App\Models\File;
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
        Schema::create('file_issues', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(File::class)->unsigned()->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->string('reason');
            $table->text('description');
            $table->timestamp('done_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_issues');
    }
};
