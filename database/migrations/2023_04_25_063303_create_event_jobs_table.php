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
        Schema::create('event_jobs', function (Blueprint $table) {
            $table->integer('active')->default(1);
            
            $table->foreignId('event_id')->constrained('events');
            $table->foreignId('job_id')->constrained('jobs');

            $table->primary(['job_id', 'event_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_jobs');
    }
};
