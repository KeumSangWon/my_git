<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLastItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('last_items', function (Blueprint $table) {
          $table->integer('id')->unsigned()->default(0)->unique('id');
          $table->text("content");
          $table->integer("last_vote_id")->unsigned()->default(0);
          $table->integer("point")->unsigned()->default(0);
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
        Schema::dropIfExists('last_items');
    }
}
