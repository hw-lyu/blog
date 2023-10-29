<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('board', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', '255')->unique()->comment('게시판 영문명');
            $table->string('name_ko', '255')->unique()->comment('게시판 한글명');
            $table->integer('parent_id')->comment('게시판 뎁스가 있을 시 해당 없으면 현재 아이디 넣기');
            $table->integer('depth')->comment('게시판 하위뎁스 1-2-3 순');
            $table->integer('order')->default(1)->comment('게시판 순서 정렬');
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
        Schema::dropIfExists('board');
    }
};
