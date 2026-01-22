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
        Schema::create('adminusers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('full_name', 255);
            $table->string('email', 255)->unique();
            $table->string('phone', 50);
            $table->string('picture', 255)->nullable();
            $table->string('address', 500)->nullable();
            $table->string('password', 255);
            $table->enum('role', ['admin', 'editor', 'manager'])->default('admin');
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('email_verified')->default(0)->comment('0 = not verified, 1 = verified');
            $table->timestamp('last_login_at')->nullable();
            $table->timestamps(); // created_at and updated_at
            $table->softDeletes(); // deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adminusers');
    }
};
