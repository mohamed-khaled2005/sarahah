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
        Schema::create('footer_nav_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('url');
            $table->text('icon')->nullable(); // SVG كود الأيقونة
            $table->unsignedInteger('order')->default(0);
            $table->boolean('active')->default(true);
            $table->unsignedBigInteger('parent_id')->nullable(); // لو عايز تدعم عناصر فرعية
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('footer_nav_items');
    }
};
