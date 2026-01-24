<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('hero_sections', function (Blueprint $table) {
            $table->id();
            $table->string('page_key'); // home, about, services, etc.
            $table->string('tag')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('primary_image')->nullable();
            $table->string('secondary_image')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->unique('page_key');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hero_sections');
    }
};
