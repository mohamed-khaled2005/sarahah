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
        Schema::create('messages', function (Blueprint $table) {
        $table->id(); // Primary Key
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->text('content'); // نص الرسالة
        $table->boolean('is_read')->default(false); // تم قراءة الرسالة أم لا (اختياري)
        $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
