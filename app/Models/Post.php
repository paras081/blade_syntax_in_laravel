<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; //new in laravel 8


class Post extends Model
{
    use HasFactory;
    use SoftDeletes;//new in laravel 8

    protected $date = ['deleted_at'];//for softdelete
    protected $fillable = [
        'title',
        'content'
    ];
    //one to one inverse
    public function user(){

//        return $this->belongsTo('\App\Models\User');
        return $this->belongsTo('\App\Models\User','id');
        //return the user which belongs to perticular post
    }
    public function photos(){
        return $this->morphMany('App\Models\Photo','imageable');
    }
    public function tags(){
        return $this->morphToMany('App\Models\Tag','taggable');
    }
}
