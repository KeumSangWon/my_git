<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Last_check extends Model
{
  public $timestamps = false;

  protected $fillable = ['id', 'user_id', 'last_item_id'];

  /*public function createCehck($item){
return "oj"; exit();
    $item=Vote_check::where('item_id', $item)->get();


    for ($i=0; $i <count($item); $i++) {
      $item_id=$item[$i]->item_id;
      $user_id = $item[$i]->user_id;
      $id = $item[$i]->id;

      Last_check::create([
        'id'=>$id,
        'user_id'=>$user_id,
        'last_item_id'=>$item_id,
      ]);
    }//endfor
  }//createCheck*/

}
