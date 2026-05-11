<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->string('quotation_number')->unique(); // 报价单号
            $table->foreignId('inquiry_id')->nullable()->constrained()->onDelete('set null');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone')->nullable();
            $table->string('customer_company')->nullable();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->string('specifications')->nullable(); // 定制规格
            $table->decimal('unit_price', 15, 2)->nullable(); // 单价
            $table->decimal('total_price', 15, 2)->nullable(); // 总价
            $table->string('currency', 3)->default('CNY');
            $table->enum('status', ['draft', 'sent', 'accepted', 'rejected', 'expired'])->default('draft');
            $table->date('valid_until')->nullable(); // 有效期
            $table->text('notes')->nullable(); // 备注
            $table->text('terms')->nullable(); // 条款
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('accepted_at')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
            
            $table->index('status');
            $table->index('quotation_number');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quotations');
    }
};
