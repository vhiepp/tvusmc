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
        Schema::create('job_users', function (Blueprint $table) {
            $table->integer('active')->default(1);
            $table->timestamps();

            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('job_id')->constrained('jobs');

            $table->primary(['user_id', 'job_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_users');
    }
};
