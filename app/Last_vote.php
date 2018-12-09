<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Last_vote extends Model
{
  public $timestamps = false;
  public $fillable = ['id', 'title','user_id', 'end_date', 'complete_point', 'voting_point', 'created_at'];

  public function createVote( $msg, $voting_point){
    $board = Vote::where('id', $msg)->first();
    Last_vote::create([
      'id'=>$board->id,
      'title'=>$board->title,
      'user_id'=>$board->user_id,
      'end_date'=>$board->end_date,
      'complete_point'=>$board->complete_point,
      'voting_point'=>$voting_point,
      'created_at'=>$board->created_at
    ]);
  }
}
