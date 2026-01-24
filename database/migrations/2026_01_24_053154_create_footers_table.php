<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('footers', function (Blueprint $table) {
            $table->id();

            // Branding
            $table->string('logo')->nullable();

            // Content
            $table->text('intro_text')->nullable();
            $table->string('newsletter_text')->nullable();

            // Company links (FAQs, Privacy, Terms etc.)
            $table->json('company_links')->nullable();

            // Contact info
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();

            // Social links
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('mail')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('youtube')->nullable();

            // Footer bottom text
            $table->string('copyright_text')->nullable();

            // Status
            $table->boolean('status')->default(1);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('footers');
    }
};
