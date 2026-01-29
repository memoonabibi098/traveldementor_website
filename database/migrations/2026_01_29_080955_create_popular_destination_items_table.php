<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('popular_destination_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->constrained('popular_destination_sections')->onDelete('cascade');
            $table->string('image');
            $table->string('text')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('order')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('popular_destination_items');
    }
};
