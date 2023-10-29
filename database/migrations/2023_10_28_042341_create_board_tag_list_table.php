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
        Schema::create('board_tag_list', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', '255')->unique()->comment('태그 영문명');
            $table->string('name_ko', '255')->unique()->comment('태그 한글명');
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
        Schema::dropIfExists('board_tag_list');
    }
};
