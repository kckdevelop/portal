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
        Schema::create('app_galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('student_name');
            $table->string('student_class')->nullable()->default('XII RPL');
            $table->string('category')->default('Web Application');
            $table->text('description');
            $table->string('thumbnail');
            $table->json('tech_stacks');
            $table->string('canva_url');
            $table->string('demo_url')->nullable();
            $table->string('github_url')->nullable();
            $table->boolean('featured')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_galleries');
    }
};
