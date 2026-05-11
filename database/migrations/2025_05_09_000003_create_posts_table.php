<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('author_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('slug')->unique();
            $table->json('title'); // 多语言
            $table->json('excerpt')->nullable(); // 多语言
            $table->json('content'); // 多语言
            $table->string('featured_image')->nullable();
            $table->enum('type', ['company', 'industry'])->default('company'); // 公司新闻/行业新闻
            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->integer('view_count')->default(0);
            $table->json('meta_title')->nullable();
            $table->json('meta_description')->nullable();
            $table->json('meta_keywords')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['type', 'is_published', 'published_at']);
            $table->index('slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
