<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('choose_us_points', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')
                  ->constrained('choose_us_sections')
                  ->onDelete('cascade');             // points removed if section deleted
            $table->string('icon_image')->nullable(); // point icon/image
            $table->string('heading');               // point heading
            $table->text('description');             // point description
            $table->integer('order')->default(0);    // display order
            $table->boolean('status')->default(1);   // active/inactive
            $table->timestamps();
            $table->softDeletes();                   // soft delete
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('choose_us_points');
    }
};

