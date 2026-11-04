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
        Schema::create('curricula', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->string('year', 10);
            $table->unsignedSmallInteger('total_sks')->default(144);
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('curriculum_id')->constrained('curricula')->cascadeOnDelete();
            $table->string('code');
            $table->string('name');
            $table->unsignedTinyInteger('semester'); // 1 - 8
            $table->unsignedTinyInteger('sks');
            $table->unsignedTinyInteger('theory_sks')->default(0);
            $table->unsignedTinyInteger('practical_sks')->default(0);
            $table->string('type')->default('Wajib'); // Wajib, Pilihan
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('academic_calendars', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('academic_year'); // e.g. 2026/2027
            $table->string('semester')->default('semua'); // ganjil, genap, semua
            $table->string('file_url')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('cpls', function (Blueprint $table) {
            $table->id();
            $table->string('code'); // CPL-01
            $table->string('category'); // sikap, pengetahuan, keterampilan_umum, keterampilan_khusus
            $table->text('description');
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        Schema::create('graduate_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('career_roles')->nullable();
            $table->string('icon')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('graduate_profiles');
        Schema::dropIfExists('cpls');
        Schema::dropIfExists('academic_calendars');
        Schema::dropIfExists('courses');
        Schema::dropIfExists('curricula');
    }
};
