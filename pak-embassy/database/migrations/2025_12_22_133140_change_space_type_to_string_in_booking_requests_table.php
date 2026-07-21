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
        // Change space_type from enum to string using raw SQL
        // MySQL doesn't support direct ALTER COLUMN for enum to string, so we use MODIFY
        DB::statement("ALTER TABLE booking_requests MODIFY COLUMN space_type VARCHAR(255) NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to enum
        // First, ensure all values are valid enum values
        DB::statement("UPDATE booking_requests SET space_type = NULL WHERE space_type NOT IN ('co_workspace', 'private_office')");
        
        // Change back to enum
        DB::statement("ALTER TABLE booking_requests MODIFY COLUMN space_type ENUM('co_workspace', 'private_office') NULL");
    }
};
