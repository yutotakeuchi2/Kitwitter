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

            $table->string("text", 120)->nullable();
            $table->bigInteger("user_id");
            $table->string("content_url", 1000)->nullable();
           // $table->foreign('user_id')
            //        ->references('id')
            //        ->on('users')
            //        ->onDelete('cascade');

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
        Schema::table('tweets', function (Blueprint $table) {
            Schema::dropIfExists('tweets');
           // $table->dropColumn('user_id');

        });

}
}
