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
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->boolean('can_edit')->default(true);
            $table->foreignId('user_id'); 
            $table->foreignId('event_id');

           // $table->unique(['user_id', 'event_id']);
           //this is causing a error in my seeder and I am still trying to fix on the 
           //other branch
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
