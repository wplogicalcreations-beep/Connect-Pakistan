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
        Schema::rename('education', 'educations');

        Schema::table('educations', function (Blueprint $table) {
            $table->renameColumn('degree', 'program');
            $table->renameColumn('field_of_study', 'course');
            $table->string('location')->nullable()->after('course');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('educations', 'education');

        Schema::table('education', function (Blueprint $table) {
            $table->renameColumn('program', 'degree');
            $table->renameColumn('course', 'field_of_study');
            $table->dropColumn('location');
        });
    }
};
