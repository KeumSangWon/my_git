<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'gender', 'age'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function votes(){
      return $this->hasMany(Vote::class);
    }

    public function vote_checks(){
      return $this->hasMany(Vote_check::class);
    }

    public function last_vote(){
      return $this->hasmany(Last_vote::class);
    }

    public function last_check(){
      return $this->hasmany(Last_check::class);
    }
}
