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
        Schema::table('educations', function (Blueprint $table) {
            $table->foreignId('country_id')->nullable()->constrained()->onDelete('set null')->after('educationable_id');
            $table->renameColumn('program', 'degree_type');
            $table->renameColumn('course', 'degree_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('educations', function (Blueprint $table) {
            $table->dropForeign(['country_id']);
            $table->dropColumn('country_id');
            $table->renameColumn('degree_type', 'program');
            $table->renameColumn('degree_name', 'course');
        });
    }
};
