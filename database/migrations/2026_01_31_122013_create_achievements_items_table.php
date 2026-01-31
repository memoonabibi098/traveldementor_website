<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('achievements_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')
                  ->constrained('achievements_sections')
                  ->onDelete('cascade');
            $table->string('icon');
            $table->string('number');
            $table->string('heading');
            $table->text('description')->nullable();
            $table->integer('order')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('achievements_items');
    }
};
