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
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content');
            $table->string('file_attachment')->nullable();
            $table->string('status')->default('published'); // draft, published
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('description')->nullable();
            $table->string('location');
            $table->date('event_date');
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->string('speaker')->nullable();
            $table->string('registration_url')->nullable();
            $table->string('image')->nullable();
            $table->string('status')->default('published'); // draft, published
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
        Schema::dropIfExists('announcements');
    }
};
