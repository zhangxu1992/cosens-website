<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('group')->default('general'); // 设置分组
            $table->string('key');
            $table->json('value')->nullable(); // 支持多语言值
            $table->string('type')->default('text'); // text, textarea, image, boolean, json
            $table->json('label'); // 显示名称
            $table->json('description')->nullable(); // 说明
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            
            $table->unique(['group', 'key']);
            $table->index('group');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
