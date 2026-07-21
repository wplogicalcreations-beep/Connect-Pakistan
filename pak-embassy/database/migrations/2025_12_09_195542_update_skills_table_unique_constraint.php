<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop the existing unique constraint on slug
        try {
            DB::statement('ALTER TABLE `skills` DROP INDEX `skills_slug_unique`');
        } catch (\Exception $e) {
            // Index might not exist, continue
        }
        
        // Add composite unique constraint on slug and type
        Schema::table('skills', function (Blueprint $table) {
            $table->unique(['slug', 'type'], 'skills_slug_type_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('skills', function (Blueprint $table) {
            // Drop composite unique constraint
            $table->dropUnique('skills_slug_type_unique');
        });
        
        // Restore unique constraint on slug
        DB::statement('ALTER TABLE `skills` ADD UNIQUE KEY `skills_slug_unique` (`slug`)');
    }
};
