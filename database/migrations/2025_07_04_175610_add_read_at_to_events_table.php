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
    Schema::table('events', function (Blueprint $table) {
        $table->timestamp('read_at')->nullable()->after('user_id');
    });
}
public function down()
{
    Schema::table('events', function (Blueprint $table) {
        $table->dropColumn('read_at');
    });
}

};
