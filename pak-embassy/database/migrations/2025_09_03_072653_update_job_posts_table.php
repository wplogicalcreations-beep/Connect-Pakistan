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
        Schema::table('job_posts', function (Blueprint $table) {
            $table->foreignId('domain_id')->nullable()->constrained('lovs')->onDelete('restrict')->after('title');
            $table->string('currency')->nullable()->after('max_salary');
            $table->text('embed_map')->nullable()->after('currency');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_posts', function (Blueprint $table) {
            $table->dropForeign(['domain_id']);
            $table->dropColumn('domain_id');
            $table->dropColumn('currency');
            $table->dropColumn('embed_map');
        });
    }
};
