<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTweetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tweets', function (Blueprint $table) {
            $table->bigIncrements('id');
<<<<<<< HEAD
            $table->string("text", 120)->nullable();
            $table->integer("user_id");
            $table->string("content_url", 1000)->nullable();
=======
            $table->string("text");
            $table->integer("user_id");
            $table->string("content_url");
>>>>>>> 4bef672 (tweetのテーブル、モデル、コントローラーと最低限の処理を追加)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tweets');
    }
}
