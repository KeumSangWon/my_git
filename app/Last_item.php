<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Last_item extends Model
{
  public $timestamps = false;

  public $fillable = ['id', 'content', 'last_vote_id', 'point'];

  public function createItem($msg){
    $items = Vote_item::where('vote_id', $msg)->get();
    for ($i=0; $i<count($items); $i++) {
      Last_item::create([
        'id'=>$items[$i]->id,
        'content'=>$items[$i]->content,
        'last_vote_id'=>$items[$i]->vote_id,
        'point'=>$items[$i]->point??"0",
      ]);
    }
  }
}
