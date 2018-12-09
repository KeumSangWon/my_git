<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Vote_check extends Model
{
  public function user(){
    return $this->belongsTo(User::class, 'user_id');
  }

  public function vote_item(){
    return $this->belongsTo(Vote_item::class, 'item_id');
  }

  public $fillable = ['user_id', 'item_id'];

  public function voteCheck_create($user_id, $items){
      $check_item = Vote_item::where('id', $items)->first();
      $check_item->point++;
      $check_item->save();

      Vote_check::create([
        'user_id'=>$user_id,
        'item_id'=>$items,
      ]);
      $item=$items;
    }//end for

  public function checkPoint($msg){
    $check_point=DB::table('vote_checks')
    ->select(DB::raw('COUNT(DISTINCT vote_checks.user_id) as count'))
    ->leftJoin('vote_items','vote_checks.item_id', '=', 'vote_items.id')
    ->where('vote_items.vote_id',$msg)
    ->first()->count;
    return $check_point;
  }

  public function voting_user_check($msg, $user_id){
      $check_user=DB::table('vote_checks')
      ->select(DB::raw('user_id'))
      ->leftJoin('vote_items','vote_checks.item_id', '=', 'vote_items.id')
      ->where('vote_items.vote_id',$msg)->where('vote_checks.user_id', $user_id)
      ->first()->user_id??"";
      //return $check_user; exit();
    return $check_user;
  }

  public function selectCheck($msg){
    $items=DB::table('vote_checks')
    ->select(DB::raw('vote_checks.*'))
    ->leftJoin('vote_items','vote_checks.item_id', '=', 'vote_items.id')
    ->where('vote_items.vote_id',$msg)
    ->get();
    return $items;
  }

}
