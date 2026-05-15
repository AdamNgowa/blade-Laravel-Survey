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
        Schema::create('survey_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('access_code_id')->constrained();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->decimal('percentage',5,2)->nullable();
            $table->string('recommendation')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey_attempts');
    }
};
