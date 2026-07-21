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
        Schema::create('lovs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lov_type_id')->constrained()->onDelete('cascade');
            $table->string("name");
            $table->string("slug");
            $table->boolean("is_active")->default(true);
            $table->timestamps();
            $table->softDeletes();

            // Composite unique index: slug is unique within each lov_type_id
            $table->unique(['lov_type_id', 'slug']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lovs');
    }
};
