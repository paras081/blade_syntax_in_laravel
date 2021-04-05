<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    /********************************************************* */
// ELOQUENT-relationships- as per book-simplified
    /********************************************************* */
    //many to many relationship
    public function students(){
        return $this->belongsToMany('App\Models\Student','course_students');
    }
}
