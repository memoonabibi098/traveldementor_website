<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('hero_repeater_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hero_repeater_id')
                  ->constrained('hero_repeaters')
                  ->cascadeOnDelete();

            $table->string('field_key');   // value, label, rating, picture, etc.
            $table->text('field_value')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hero_repeater_fields');
    }
};
