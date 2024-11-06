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
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('introduction');
            $table->bigInteger('category_id',false,true);
            $table->bigInteger('scope_id',false,true);
            $table->bigInteger('year_id',false,true);
            $table->bigInteger('scale_id',false,true);

            $table->text('description')->nullable();

            $table->string('owner')->nullable();

            $table->string('location')->nullable();
            $table->bigInteger('status_id',false,true);
            $table->boolean('is_active');
            $table->integer('sort_order')->default(0);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('status_id')->references('id')->on('status');
            $table->foreign('scope_id')->references('id')->on('scopes');
            $table->foreign('year_id')->references('id')->on('years');
            $table->foreign('scale_id')->references('id')->on('scales');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
