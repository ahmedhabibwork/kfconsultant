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
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email');
            $table->string('mobile');
            $table->string(column: 'address');
            $table->string(column: 'youtube_link')->nullable();
            $table->string(column: 'facebook_link')->nullable();
            $table->string(column: 'instagram_link')->nullable();
            $table->string(column: 'linkedin_link')->nullable();
            $table->boolean('is_default')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting');
    }
};
