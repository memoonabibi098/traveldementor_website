<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('headers', function (Blueprint $table) {
            $table->id();

            // Logo
            $table->string('logo')->nullable();

            // Menus (JSON)
            // Example:
            // [
            //   {"title":"Home","url":"/"},
            //   {"title":"About","url":"/about"}
            // ]
            $table->json('menus')->nullable();

            // CTA Button
            $table->string('button_text')->nullable();
            $table->string('button_url')->nullable();

            // Status
            $table->boolean('status')->default(1);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('headers');
    }
};
