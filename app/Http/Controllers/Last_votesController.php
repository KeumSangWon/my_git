<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vote;
use App\User;
use App\Vote_item;
use App\Vote_check;
use App\Last_vote;
use App\Last_item;
use App\Last_check;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

class Last_votesController extends Controller
{
  public function __construct(){
      $this->middleware('auth');
      //$this->middleware('owner')->only(['show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $page = $request->page??"1";
      $last_msgs = Last_vote::orderBy('id', 'desc')->paginate(10);
      return view('bbs.last_index')->with([
        'last_msgs'=>$last_msgs,
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
      $board = Last_vote::where('id', $id)->first();
      $item = Last_item::where('last_vote_id', $id)->get();

      $page = $request->page;
    // $content_vote = $content_vote->toArray();
    //return count($item);

      for ($i=0; $i <count($item); $i++) {
        $content_vote_arr[$i] = array(
          "y"=> $item[$i]->point,
          "name"=> $item[$i]->content,
        );
      }


        //return $content_vote_arr;
      return view('bbs.lastView')->with([
        'board'=>$board,
        'item'=>$item,
        'page'=>$page,
        'content_vote_arr'=>$content_vote_arr,
      ]);
    }

    /* this is change chart method
    *  gender and age
    *  call json and back json
    *
    *
    *
    *
    *
    */
    public function data(Request $request){
      $msg =$request->id;
      $gender = $request->gender??"";
      $age = $request->age??"";
      $item = Last_item::where('last_vote_id', $msg)->get();

      if ($gender&&$age) {
        for($i=0; $i < count($item) ; $i++) {
        $item_id = $item[$i]->id;
        $count = DB::select(DB::raw("select COUNT(DISTINCT last_checks.user_id) as count from last_checks
        left JOIN users ON last_checks.user_id = users.id
        where Floor((YEAR(now())-users.age)/10)='$age' AND users.gender = '$gender'
        GROUP BY(last_checks.last_item_id)
        having(last_checks.last_item_id)='$item_id'"));
        $content_vote_arr[$i] = array(
          "y"=> $count[$i]->count??0,
          "name"=> $item[$i]->content,
        );
      }

      }else if($gender){
        for ($i=0; $i < count($item) ; $i++) {
          $count=DB::table('last_checks')
          ->select(DB::raw('COUNT(DISTINCT last_checks.user_id) as count'))
          ->leftJoin('users','last_checks.user_id', '=', 'users.id')
          ->where('users.gender',$gender)->where('last_checks.last_item_id', $item[$i]->id)
          ->first()->count;
          $content_vote_arr[$i] = array(
            "y"=> $count,
            "name"=> $item[$i]->content,
          );
        }//end gender for

      }else if ($age) {

        for ($i=0; $i < count($item) ; $i++) {
          $item_id = $item[$i]->id;
          $count = DB::select(DB::raw("select COUNT(DISTINCT last_checks.user_id) as count from last_checks
          left JOIN users ON last_checks.user_id = users.id
          where Floor((YEAR(now())-age)/10)='$age'
          GROUP BY(last_checks.last_item_id)
          having(last_checks.last_item_id)='$item_id'"));

          $content_vote_arr[$i] = array(
            "y"=> $count[$i]->count??0,
            "name"=> $item[$i]->content,
          );
        }
      }
    return response()->json($content_vote_arr);
  }//end data

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    public function myIndex(Request $request){
      $page= $request->page??"1";
      $msgs = Vote::orderBy('id', 'desc')->paginate(5);
      $user_id = Auth::user()->id;
      $last_vote = Last_check::where('user_id', $user_id)->get();

      for ($i=0; $i < count($last_vote); $i++) {
        $last_item_id = $last_vote[$i]->last_item_id;
        $last_vote_id = Last_item::where('id', $last_item_id)->first()->last_vote_id;
        $last_msgs = Last_vote::where('id', $last_vote_id)->orderBy('id', 'desc')->paginate(5);
      }

      $my_msgs = Last_Vote::where('user_id', $user_id)->orderBy('id', 'desc')->paginate(5);

      return view('bbs.myPage')->with([
        'msgs'=>$msgs,
        'page'=>$page,
        'last_msgs'=>$last_msgs,
        'my_msgs'=>$my_msgs,
      ]);
    }
}
