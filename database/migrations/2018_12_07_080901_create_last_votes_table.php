<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLastVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('last_votes', function (Blueprint $table) {
          $table->integer('id')->unsigned()->default(0)->unique('id');
          $table->string("title", 255);
          $table->integer("user_id")->unsigned();
          $table->integer("hits")->unsigned()->default(0);
          $table->date("end_date");
          $table->integer("complete_point")->unsigned()->default(0);
          $table->integer("voting_point")->unsigned()->default(0);
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
        Schema::dropIfExists('last_votes');
    }
}
