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
        Schema::create('board_post_tag', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tag_id')->comment('태그 아이디');
            $table->integer('board_id')->comment('태그 아이디');
            $table->tinyInteger('use')->default(0)->comment('태그 사용여부');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('board_post_tag');
    }
};
