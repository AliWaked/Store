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
        Schema::create('porduct_user', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('product_id')->constrained('products');
            // $table->enum('favourite', ['yes', 'no'])->default('no');
            $table->boolean('is_favourite')->default(0);
            $table->unsignedSmallInteger('reviews')->default(0);
            $table->text('comment')->nullable();
            $table->primary(['user_id', 'product_id']);
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('porduct_user');
    }
};
