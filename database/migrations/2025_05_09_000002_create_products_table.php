<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('slug')->unique();
            $table->string('sku')->nullable()->unique();
            $table->json('name'); // 多语言
            $table->json('description')->nullable(); // 多语言
            $table->json('content')->nullable(); // 多语言 - 富文本详情
            $table->json('specifications')->nullable(); // 多语言 - 规格参数
            $table->json('features')->nullable(); // 多语言 - 产品特点
            $table->json('applications')->nullable(); // 多语言 - 应用领域
            $table->decimal('base_price', 15, 2)->nullable(); // 基础价格
            $table->string('currency', 3)->default('CNY');
            $table->string('unit')->default('piece'); // 单位
            $table->string('main_image')->nullable();
            $table->json('gallery')->nullable(); // 图库
            $table->json('documents')->nullable(); // PDF文档
            $table->boolean('is_featured')->default(false); // 热门产品
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->integer('view_count')->default(0);
            $table->json('meta_title')->nullable();
            $table->json('meta_description')->nullable();
            $table->json('meta_keywords')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['category_id', 'is_active', 'is_featured']);
            $table->index(['is_active', 'sort_order']);
            $table->index('slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
