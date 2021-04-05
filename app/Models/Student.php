<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    /********************************************************* */
// ELOQUENT-relationships- as per book-simplified
    /********************************************************* */
    //many to many relationship
    public function courses(){
        return $this->belongsToMany('App\Models\Course','course_students');
    }
}
