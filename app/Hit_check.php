<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hit_check extends Model
{
    protected $fillable=['vote_id', 'user_id'];

    public function createHit_check($id, $user_id){
      Hit_check::create([
        'user_id'=>$user_id,
        'vote_id'=>$id,
      ]);
    }
}
