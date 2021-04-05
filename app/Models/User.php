<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //one to one relationship
    public function post(){
//        return $this->hasOne('App\Models\Post');
        return $this->hasOne('App\Models\Post','id'); // go to post table , look for column (by default)user_id
        //istead user_id column different column name than we need to specify as second argument of hasOne function.
    }
    //one to many relationship--> user has many posts
    public function posts(){

//        return $this->hasMany('App\Models\Post');
        return $this->hasMany('App\Models\Post','id');
        //return all the post belongs to mentioned user id
    }
    //many to many relationship--> finding user having the role.
    public function role(){
        return $this->belongsToMany('\App\Models\Role')->withPivot('created_at');
        //to customise tables name and columns follow formate below
        //return $this->belongsToMany('\App\Models\Role','user_roles','user_id','role_id');
    }

    public function photos(){
        return $this->morphMany('App\Models\Photo','imageable');
    }


    /********************************************************* */
    // ELOQUENT-relationships- as per book-simplified
    /********************************************************* */
    public function passport(){
        return $this->hasOne('App\Models\Passport');
    }

}
