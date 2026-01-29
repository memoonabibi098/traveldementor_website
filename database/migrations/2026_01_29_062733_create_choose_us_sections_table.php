<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('choose_us_sections', function (Blueprint $table) {
            $table->id();
            $table->string('page_key', 50);          // page identifier
            $table->string('heading');               // main heading
            $table->text('description');             // main description
            $table->string('main_image')->nullable();// main image path
            $table->boolean('status')->default(1);   // active/inactive
            $table->timestamps();
            $table->softDeletes();                   // soft delete
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('choose_us_sections');
    }
};

