<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Vote;
class CheckOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      $user = Auth::user();
        $id = $request->route('id');
        $vote = Vote::find($id);
        if (!$vote || $user->id != $vote->user_id) {
          flash('권환이 없습니다')->error();
          return back();
        }
        return $next($request);
    }
}
