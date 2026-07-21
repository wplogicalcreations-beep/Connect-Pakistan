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
            $table->foreignId('country_id')->nullable()->constrained()->onDelete('set null')->after('experienceable_id');
            $table->renameColumn('department', 'job_title');
            $table->string('job_type')->nullable()->after('job_title');
            $table->renameColumn('responsibilities', 'description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('experiences', function (Blueprint $table) {
            $table->dropForeign(['country_id']);
            $table->dropColumn('country_id');
            $table->renameColumn('job_title', 'department');
            $table->dropColumn('job_type');
            $table->renameColumn('description', 'responsibilities');
        });
    }
};
