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
        Schema::create('event_users', function (Blueprint $table) {
            
            $table->integer('active')->default(1);
            $table->timestamps();

            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('event_id')->constrained('events');

            $table->primary(['user_id', 'event_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_users');
    }
};
