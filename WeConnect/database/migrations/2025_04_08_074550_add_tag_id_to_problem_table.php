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
    Schema::table('problems', function (Blueprint $table) {
        $table->unsignedBigInteger('tag_id')->nullable();  // เพิ่มคอลัมน์ tag_id
    });
}


    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('problems', function (Blueprint $table) {
        $table->dropColumn('tag_id');
    });
}
};
