<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
      protected $fillable = ['title','user_id', 'end_date', 'complete_point'];

      public function user(){
        return $this->belongsTo(User::class);
      }

      public function vote_items(){
        return $this->hasMany(Vote_item::class);
      }

    //1대N의 관계의 아래에 있는 컬럼에게 정보를 넘겨줄때
      public function vote_checks() {
        return $this->hasManyThrough(Vote_check::class, Vote_item::class, 'vote_id', 'item_id');
      }

      public function createVote($title, $user_id, $end_date, $complete_point){
        Vote::create([
          'title'=>$title,
          'user_id'=>$user_id,
          'end_date'=>$end_date,
          'complete_point'=>$complete_point
        ]);
      }
}
