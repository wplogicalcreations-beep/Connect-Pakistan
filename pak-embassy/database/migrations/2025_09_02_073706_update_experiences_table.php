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
        Schema::table('experiences', function (Blueprint $table) {
            // Rename existing columns
            $table->renameColumn('title', 'department');
            $table->renameColumn('company', 'company_name');
            $table->renameColumn('location', 'your_location');

            // Add new column
            $table->string('company_location')->after('your_location')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('experiences', function (Blueprint $table) {
            // Revert back
            $table->renameColumn('department', 'title');
            $table->renameColumn('company_name', 'company');
            $table->renameColumn('your_location', 'location');

            $table->dropColumn('company_location');
        });
    }
};
