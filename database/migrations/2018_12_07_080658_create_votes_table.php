<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
          $table->increments('id');
          $table->string("title", 255);
          $table->integer("user_id")->unsigned()->default(0);
          $table->integer("hits")->unsigned()->default(0);
          $table->date("end_date");
          $table->integer("complete_point")->unsigned()->default(0);
          $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade")->onUpdate("cascade");
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
        Schema::dropIfExists('votes');
    }
}
