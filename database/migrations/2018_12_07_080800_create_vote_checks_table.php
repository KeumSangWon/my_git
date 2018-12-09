<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoteChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vote_checks', function (Blueprint $table) {
        $table->increments('id');
        $table->integer("user_id")->unsigned();
        $table->integer("item_id")->unsigned();
        $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade")->onUpdate("cascade");
        $table->foreign("item_id")->references("id")->on("vote_items")->onDelete("cascade")->onUpdate("cascade");
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
        Schema::dropIfExists('vote_checks');
    }
}