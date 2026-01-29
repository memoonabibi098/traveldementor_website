<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('visa_option_counters', function (Blueprint $table) {
            $table->id();

            $table->foreignId('item_id')
                ->constrained('visa_option_items')
                ->onDelete('cascade');

            $table->integer('value');                // 1250
            $table->string('suffix')->nullable();    // + / %
            $table->string('label')->nullable();     // Apply / Approved
            $table->integer('order')->default(1);    // Display order

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visa_option_counters');
    }
};
