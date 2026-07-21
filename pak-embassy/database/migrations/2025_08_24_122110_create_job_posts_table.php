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
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('organization_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('status_id')->nullable()->constrained()->onDelete('restrict');    
            $table->longText('description')->nullable();
            $table->longText('responsibilities')->nullable();
            $table->longText('requirements')->nullable();
            $table->longText('benefits')->nullable();
            $table->integer('min_experience')->nullable();
            $table->integer('max_experience')->nullable();
            $table->decimal('min_salary', 10, 2)->nullable();
            $table->decimal('max_salary', 10, 2)->nullable();
            $table->integer('vacancies')->default(1); // number of openings
            $table->enum('job_type', ['full_time', 'part_time', 'contract', 'internship'])->default('full_time');
            $table->enum('work_mode', ['onsite', 'remote', 'hybrid'])->default('onsite');          
            $table->string('location')->nullable(); 
            $table->string('address')->nullable(); 
            $table->date('posted_date')->nullable();
            $table->date('expiry_date')->nullable(); 
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_posts');
    }
};
