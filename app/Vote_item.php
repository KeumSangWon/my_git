<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote_item extends Model
{
  public function vote_checks(){
    return $this->hasMany(Vote_check::class);
  }

  public function vote(){
    return $this->belongsTo(Vote::class);
  }

    //public $timestamps =false;
  public $fillable = ['content', 'vote_id'];

  public function createVote_item($content, $vote_id){
    for ($i=0; $i<count($content); $i++) {
      Vote_item::create([
        'content'=>$content[$i],
        'vote_id'=>$vote_id
      ]);
    }
  }

}
