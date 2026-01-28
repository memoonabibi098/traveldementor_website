<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name');                // English name
            $table->string('urdu_name')->nullable(); // Urdu name
            $table->string('code', 10)->unique();  // Country code (PK, USA, etc.)
            $table->string('img')->nullable();     // Flag image path
            $table->timestamps();
            $table->softDeletes();                 // Soft delete column
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
