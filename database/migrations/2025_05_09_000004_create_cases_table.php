<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
            $table->string('slug')->unique();
            $table->json('title'); // 多语言
            $table->json('client_name')->nullable(); // 多语言 - 客户名称
            $table->json('location')->nullable(); // 多语言 - 项目地点
            $table->json('summary')->nullable(); // 多语言 - 项目简介
            $table->json('content'); // 多语言 - 详细内容
            $table->json('challenge')->nullable(); // 多语言 - 挑战
            $table->json('solution')->nullable(); // 多语言 - 解决方案
            $table->json('results')->nullable(); // 多语言 - 成果
            $table->string('featured_image')->nullable();
            $table->json('gallery')->nullable(); // 图库
            $table->date('project_date')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->integer('view_count')->default(0);
            $table->json('meta_title')->nullable();
            $table->json('meta_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['is_active', 'is_featured', 'sort_order']);
            $table->index('slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cases');
    }
};
