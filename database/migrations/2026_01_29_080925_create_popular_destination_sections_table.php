<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('popular_destination_sections', function (Blueprint $table) {
            $table->id();
            $table->string('page_key')->nullable(); // home, about, etc.
            $table->string('sub_heading')->nullable();
            $table->string('heading');
            $table->tinyInteger('status')->default(1); // 1=active, 0=inactive
            $table->integer('order')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('popular_destination_sections');
    }
};
