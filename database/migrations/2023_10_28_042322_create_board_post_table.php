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
        Schema::create('board_post', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject', '255')->comment('게시판 제목명');
            $table->mediumText('content')->comment('글내용');
            $table->mediumText('strip_content')->comment('글내용(태그삭제)');
            $table->json('file_data')->nullable()->comment('파일 데이터');
            $table->integer('board_id')->comment('게시판 아이디');
            $table->string('writer')->comment('글 작성자');
            $table->tinyInteger('use')->default(0)->comment('글 사용여부');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('board_post');
    }
};
