<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // عمود الصورة (رابط الصورة أو اسم الملف)
            $table->string('avatar')->default('profile.png')->after('email'); 
            // عمود النبذة التعريفية
            $table->text('bio')->default('هذه نبذة تعريفية افتراضية للمستخدم.')->after('avatar');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['avatar', 'bio']);
        });
    }
};
