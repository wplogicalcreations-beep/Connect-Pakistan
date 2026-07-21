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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('website_url')->nullable();
            $table->string('secp_registration_number')->nullable();
            $table->string('pseb_registration_number')->nullable();
            $table->string('pasha_registration_number')->nullable();
            $table->string('ceo_name')->nullable();
            $table->string('ceo_contact')->nullable();
            $table->string('ceo_email')->nullable();
            $table->boolean('has_ksa_registered_company')->default(1)->nullable();
            $table->string('saudi_entity_name')->nullable();
            $table->string('representative_name')->nullable();
            $table->string('representative_contact')->nullable();
            $table->string('representative_email')->nullable();
            $table->enum('company_type', ['product', 'services'])->nullable();
            $table->unsignedInteger('years_of_experience')->nullable();
            $table->unsignedInteger('no_of_staff')->nullable();
            $table->boolean('has_company_certificate')->default(1)->nullable();
            $table->string('reference')->nullable();
            $table->unsignedInteger('no_of_projects')->nullable();
            $table->string('reference_project')->nullable();
            $table->string('staff_certification')->nullable();
            $table->string('ip')->nullable();
            $table->string('step')->nullable();
            $table->boolean('is_verified')->default(0)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
