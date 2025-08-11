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
            $table->id();
            $table->integer('category_id')->nullable();
            $table->json('name');
            $table->json('slug');
            $table->json('description');
            $table->string('image',512);
            $table->json('slider_image')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('is_main')->default(0);
            $table->timestamps();
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
