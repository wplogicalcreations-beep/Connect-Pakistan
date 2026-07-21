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
        Schema::create('coworking_spaces', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('starting_price')->nullable();
            $table->integer('month_rentals')->nullable();
            $table->integer('people')->nullable();
            $table->string('space_type')->nullable();
            $table->string('location')->nullable();
            $table->boolean('is_active')->default(true);
            $table->text('space_overview')->nullable();
            $table->longText('space_description')->nullable();
            $table->text('space_amenities')->nullable();
            $table->text('embed_map_url')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coworking_spaces');
    }
};
