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
        Schema::table('nav_items', function (Blueprint $table) {
            $table->text('icon')->nullable()->after('url'); 
            // بعد عمود url أو في أي مكان تريده
        });
    }

    public function down(): void
    {
        Schema::table('nav_items', function (Blueprint $table) {
            $table->dropColumn('icon');
        });
    }
};
