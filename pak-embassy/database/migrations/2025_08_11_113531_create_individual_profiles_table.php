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
        Schema::create('individual_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('passport_no')->nullable();
            $table->string('current_employer')->nullable();
            $table->string('previous_employer')->nullable();
            $table->string('current_designation')->nullable();
            $table->string('iqama_id')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->text('additional_skills')->nullable(); // JSON or comma-separated string
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('individual_profiles');
    }
};
