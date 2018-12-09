<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoteItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vote_items', function (Blueprint $table) {
          $table->increments('id');
          $table->text("content");
          $table->integer("vote_id")->unsigned();
          $table->integer("point")->unsigned()->default(0);
          $table->foreign("vote_id")->references("id")->on("votes")->onDelete("cascade")->onUpdate("cascade");
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
        Schema::dropIfExists('vote_items');
    }
}
