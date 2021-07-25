<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follow_requests', function (Blueprint $table) {
            $table->unsignedInteger("follow_by");
            $table->unsignedInteger("following");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('follow_requests', function (Blueprint $table) {
            $table->dropIfExists("follow_requests");
        });
    }
}
