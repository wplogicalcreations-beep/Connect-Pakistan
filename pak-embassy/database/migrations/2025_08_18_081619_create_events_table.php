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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('event_id')->nullable();
            $table->string('name')->nullable();
            $table->foreignId('status_id')->constrained()->onDelete('restrict');
            $table->foreignId('domain_id')->constrained('lovs')->onDelete('restrict');
            $table->text('description')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->text('meeting_link')->nullable();
            $table->enum('event_type', ['public', 'private'])->nullable();
            $table->enum('event_mode', ['onsite', 'virtual'])->nullable();
            $table->string('location')->nullable();
            $table->string('city')->nullable();
            $table->boolean('event_mom')->nullable();
            $table->boolean('event_activities')->nullable();
            $table->text('event_overview')->nullable();
            $table->text('event_agenda')->nullable();
            $table->text('event_format')->nullable();
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
        Schema::dropIfExists('events');
    }
};
