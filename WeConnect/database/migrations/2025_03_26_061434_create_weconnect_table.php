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
        Schema::create('problems', function (Blueprint $table) {
            $table->id('prob_id');
            $table->string('community_name');
            $table->mediumText('detail');
            $table->string('province');
            $table->string('district');
            $table->string('sub_district');
            $table->string('post_code');
            $table->float('latitude');
            $table->float('longitude');
            $table->timestamps();

            $table->unsignedBigInteger('usr_id')->nullable();
            $table->foreign('usr_id')->references('usr_id')->on('users')->onDelete('set null');
        });

        Schema::create('tags', function (Blueprint $table) {
            $table->id('tag_id');
            $table->string('tag_name');
        });

        Schema::create('problems_has_tags', function (Blueprint $table) {
            $table->unsignedBigInteger('prob_id')->nullable();
            $table->unsignedBigInteger('tag_id')->nullable();
            
            $table->foreign('prob_id')->references('prob_id')->on('problems')->onDelete('set null');
            $table->foreign('tag_id')->references('tag_id')->on('tags')->onDelete('set null');
        });

        Schema::create('images', function (Blueprint $table) {
            $table->id('img_id')->nullable();
            $table->longText('img_path')->nullable();

            $table->unsignedBigInteger('prob_id')->nullable();
            $table->foreign('prob_id')->references('prob_id')->on('problems')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('problems');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('problems_has_tags');
        Schema::dropIfExists('images');
    }
};

?>
