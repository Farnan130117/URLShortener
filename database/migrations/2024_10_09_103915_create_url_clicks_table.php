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
        Schema::create('url_clicks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('short_url_id'); // Foreign key to short_urls
            $table->timestamp('clicked_at');
            $table->string('ip_address', 45);
            $table->string('location')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('short_url_id')->references('id')->on('short_urls')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('url_clicks');
    }
};
