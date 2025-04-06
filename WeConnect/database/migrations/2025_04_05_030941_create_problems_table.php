<?php
/*
 * @Author: Nattapong Kamma Icezazarun@gmail.com
 * @Date: 2025-04-05 10:09:41
 * @LastEditors: Nattapong Kamma Icezazarun@gmail.com
 * @LastEditTime: 2025-04-05 10:10:38
 * @FilePath: \cluster2\WeConnect\database\migrations\2025_04_05_030941_create_problems_table.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */

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
    Schema::create('problems', function (Blueprint $table) {
        $table->id();
        $table->string('user_name');
        $table->string('location');
        $table->string('category');
        $table->text('description');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('problems');
    }
};
