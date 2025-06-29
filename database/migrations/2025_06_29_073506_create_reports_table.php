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
    Schema::create('reports', function (Blueprint $table) {
        $table->id(); // Primary Key
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('message_id')->constrained()->onDelete('cascade');
        $table->text('reason')->nullable(); // سبب البلاغ (اختياري)
        $table->timestamps(); // created_at & updated_at
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
