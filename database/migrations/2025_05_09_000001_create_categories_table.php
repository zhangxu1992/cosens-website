<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('categories')->onDelete('cascade');
            $table->string('type')->default('product'); // product, post, case
            $table->string('slug')->unique();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->string('icon')->nullable();
            $table->string('image')->nullable();
            $table->json('name'); // 多语言
            $table->json('description')->nullable(); // 多语言
            $table->json('meta_title')->nullable();
            $table->json('meta_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['type', 'is_active', 'sort_order']);
            $table->index('parent_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
