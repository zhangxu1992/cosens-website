<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('inquiry_number')->unique(); // 询盘编号
            $table->string('name'); // 联系人姓名
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('company_name')->nullable();
            $table->string('country')->nullable();
            $table->text('message'); // 询盘内容
            $table->json('product_ids')->nullable(); // 关联产品ID
            $table->enum('status', ['pending', 'processing', 'replied', 'completed', 'closed'])->default('pending');
            $table->text('admin_notes')->nullable(); // 管理员备注
            $table->timestamp('replied_at')->nullable();
            $table->foreignId('replied_by')->nullable()->constrained('users')->onDelete('set null');
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();
            
            $table->index('status');
            $table->index('email');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
