<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('nav_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');                      // عنوان العنصر
            $table->string('url');                        // الرابط
            $table->unsignedInteger('order')->default(0); // ترتيب
            $table->foreignId('parent_id')->nullable()->constrained('nav_items')->onDelete('cascade'); 
            $table->boolean('active')->default(true);     // تفعيل أو تعطيل
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nav_items');
    }
};
