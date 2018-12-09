<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHitChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hit_checks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("vote_id")->unsigned();
            $table->integer("user_id")->unsigned();
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade")->onUpdate("cascade");
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
        Schema::dropIfExists('hit_checks');
    }
}
