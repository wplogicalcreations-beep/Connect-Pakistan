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
        // Change company_type from enum to string using raw SQL
        // MySQL doesn't support direct ALTER COLUMN for enum to string, so we use MODIFY
        DB::statement("ALTER TABLE organizations MODIFY COLUMN company_type VARCHAR(255) NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to enum
        // First, ensure all values are valid enum values
        DB::statement("UPDATE organizations SET company_type = NULL WHERE company_type NOT IN ('product', 'services')");
        
        // Change back to enum
        DB::statement("ALTER TABLE organizations MODIFY COLUMN company_type ENUM('product', 'services') NULL");
    }
};
