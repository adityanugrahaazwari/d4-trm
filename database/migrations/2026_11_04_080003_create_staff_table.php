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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type')->default('dosen'); // dosen, tendik
            $table->string('nip_nidn')->nullable();
            $table->string('position')->nullable(); // e.g. Koordinator Program Studi, Dosen Ahli 3D, Pranata Lab
            $table->string('expertise')->nullable(); // Game Programming, 3D Modeling, VFX, dll
            $table->string('education')->nullable(); // S2 Teknik Informatika, S2 Seni Rupa & Desain, dll
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('photo')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
