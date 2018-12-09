<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vote;
use App\Vote_item;
use App\Vote_check;
use App\Last_vote;
use App\Last_item;
use App\Last_check;
use App\Hit_check;
use App\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class VotesController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
    //$this->middleware('owner')->only(['update', 'delete']);
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $toDay = Carbon::today()->toDateString();
      $page= $request->page??"1";

      $msgs = Vote::orderBy('id', 'desc')->paginate(10);
      foreach ($msgs as $value) {
        $end_date=$value->end_date;
        if ($end_date < $toDay) {
          $msg = $value->id;
          $voting_point = (int)$request->counts??"0";
          return  redirect()->route('endVote',[
            'page'=>$page,
            'board'=>$msg,
            'counts'=>$voting_point,
          ]);
        }//end if
      }//end for
      return view('bbs.index')->with([
        'msgs'=>$msgs,
        'page'=>$page
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $page = $request->page??"1";
      return view("bbs.write")->with('page', $page);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $toDay = Carbon::today()->toDateString();
        $end_date = $request->end_date;
        if ($toDay>$end_date) {
          flash('Check the date again')->error();
          return back();
        }

        $title = $request->title;
        $user_id = Auth::user()->id;


        $complete_point = $request->complete_point;

        $vote = new Vote();
        $vote->createVote($title, $user_id, $end_date, $complete_point);

        $content = $request->item;
        $vote_id = Vote::max('id');

        $vote_item = new Vote_item();
        $vote_item->createVote_item($content, $vote_id);

        return redirect(route('votes.index'))->with('message',"작성이 완료 되었습니다");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $user_id = Auth::user()->id;
      $hit_check = new Hit_check();

      $board = Vote::where('id', $id)->first();


      if (!$hit_user_check = Hit_check::where('vote_id', $id)->where('user_id', $user_id)->first()) {
        $board->hits++;
        $board->save();
        $hit_check->createHit_check($id, $user_id);
      }


      $item = Vote_item::where('vote_id', $id)->get();
      $page = $request->page??"1";

      return view('bbs.view')->with([
        'board'=>$board,
        'item'=>$item,
        'page'=>$page,

      ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $page = $request->page;
      Vote::find($id)->delete();
    }

    public function voting(Request $request){

      $items = $request->item??"";
      if(!$items){
        flash('doing vote')->error();
        return back();
      }

      $msg = $request->board;
      $page = $request->page??"1";
      $user_id = Auth::user()->id;
      $vote_check = new Vote_check();

      $check_user=$vote_check->voting_user_check($msg, $user_id);
      if (!$check_user) {
        $vote_check->voteCheck_create($user_id, $items);
      }else{
        flash('you can not voting')->error();
        return back();
      }

      $board = Vote::where('id', $msg)->first();

      $complete_point=$board->complete_point;

      $check_point = $vote_check->checkPoint($msg);

      if ($check_point==$complete_point) {

        return redirect(route('endVote',[
          'page'=>$page,
          'board'=>$board,
          'counts'=>$check_point,
          'item'=>$items,
        ]));
      }else{
        return redirect(route('votes.index'))->with([
          'page'=>$page,
          'counts'=>$check_point,
          'message'=>"투표완료",
        ]);
      }
    }

//----------------------------------------------------------------------------------------------------------------------
    public function endVote(Request $request){

        $msg = $request->board;
        $page = $request->page;
        $item = $request->item??"";

        $voting_point = (int)$request->counts;

        $last_vote = new Last_vote();
        $last_vote->createVote($msg, $voting_point);

        $last_item = new Last_item();
        $last_item->createItem($msg);

        $vote_check = new Vote_check();
        $items=$vote_check->selectCheck($msg);
        for ($i=0; $i <count($items); $i++) {
          $item_id=$items[$i]->item_id;
          $user_id = $items[$i]->user_id;
          $id = $items[$i]->id;
          Last_check::create([
            'id'=>$id,
            'user_id'=>$user_id,
            'last_item_id'=>$item_id,
          ]);
        }

        /*$last_check = new Last_check();
        $last_check->createCehck($item);*/

        return redirect()->route('delete',[
          'page'=>$page,
          'id'=>$msg
        ]);
      }

      public function delete(Request $request){

        $id = $request->id;
        $page = $request->page??"1";
        Vote::find($id)->delete();

        return redirect(route('votes.index'))->with([
          'page'=>$page,
        ]);
      }

}
