<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('email_otps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('adminuser_id');
            $table->string('otp', 10);
            $table->timestamp('expires_at');
            $table->tinyInteger('is_used')->default(0);
            $table->timestamps(); // created_at + updated_at

            // Foreign key constraint
            $table->foreign('adminuser_id')->references('id')->on('adminusers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_otps');
    }
};
