<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // 页面标识: about, contact, home, etc.
            $table->string('slug')->unique();
            $table->json('title'); // 多语言
            $table->json('content')->nullable(); // 多语言 - 页面内容
            $table->json('meta_title')->nullable();
            $table->json('meta_description')->nullable();
            $table->json('meta_keywords')->nullable();
            $table->string('template')->default('default'); // 页面模板
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            
            $table->index('key');
            $table->index('slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
