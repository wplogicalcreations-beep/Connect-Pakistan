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
        // Delete all existing attendees since we can't map name/profile_url to user_id
        DB::table('attendees')->delete();
        
        Schema::table('attendees', function (Blueprint $table) {
            // Drop old columns
            $table->dropColumn(['name', 'profile_url']);
            
            // Add new user_id column
            $table->foreignId('user_id')->after('event_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendees', function (Blueprint $table) {
            // Drop foreign key and user_id
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
            
            // Restore old columns
            $table->string('name')->after('event_id');
            $table->string('profile_url')->after('name');
        });
    }
};
