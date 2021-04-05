<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Models\Post;
use App\Models\User;
use App\Models\Student;
use App\Models\Course;
use App\Models\Tag;
use App\Models\Team;

Route::get('/', function () {
    return view('welcome');
});

//Route::view('/','welcome');

// Route::get('/contact','PostsController@contact');
 Route::get('contact', [PostsController::class, 'contact']);
 Route::get('contact/{id}', [PostsController::class, 'contact']);
 Route::get('/posts/{id}',[PostsController::class,'index']);

/********************************************************* */
//CRUD operation using migrations
/********************************************************* */
 Route::get('/insert',function(){

     DB::insert('insert into posts(title,content) values(?,?)',['PHP with Laravel','Laravel and Paras is best combination']);
 });

 Route::get('/read',function(){
     $results = DB::select('select * from posts where id=?',[1]);

     foreach($results as $post){
         return $post->title;
     }
 });

 Route::get('/update',function(){
     $results = DB::update('update posts set title = "Update title" where id=?',[1]);


     return $results;

 });

 Route::get('/delete',function(){

     $deleted = DB::delete('delete from posts where id=?',[1]);

     return $deleted;
 });
/********************************************************* */
// ELOQUENT-ORM
/********************************************************* */
 Route::get('/read',function(){

//     $posts =Post::find(2);
//     return $posts->title;
     $posts =Post::all();
     foreach($posts as $post){
         echo $post->title.'<br>';
     }
     return view('contact');
 });

 Route::get('/find',function(){

     $post = Post::find(1);

     echo $post->title;

     return view('contact');
 });
 Route::get('/findwhere',function(){
     // $posts = Post::where('id',5)->orderBy('id','desc')->take(1)->get();
     $posts = Post::where('id',1)->get();

     echo $posts;

     return view('contact');
 });
 Route::get('/findmore',function(){
     //1
     // $posts =Post::findOrFail(1);
     // return $posts;

     //2
     $posts = Post::where('id','<',50)->firstOrFail();
     echo $posts;

     return view('contact');
 });

Route::get('/basicinsert',function(){
    $post = new Post;
    $post->title = 'New eloquent title';
    $post->content = 'New eloquent content';
    $post->save();

    return view('contact');
});

Route::get('/basicinsert2',function(){
    $post = Post::find(1);
    $post->title = 'New eloquent title 3';
    $post->content = 'New eloquent content 3';
    $post->save();
    return view('contact');
});

 Route::get('/readsoftdelete',function(){

     $post = Post::withTrashed()->where('id',11)->restore();
     return $post;
 });
// Route::get('/create',function(){
//     Post::create(['title'=>'the create method','content'=>'I\' am  learning a lot']);
//
//     return view('contact');
// });

Route::get('/create',[PostsController::class, 'create']);

Route::get('/update',function(){


     Post::where('id',1)->where('is_admin',0)->update(['title'=>'new PHP title','content'=>"i love laravel"]);

     return view('contact');
 });

 Route::get('/softdelete',function(){

     $post = Post::find(12);

     $post->delete();
     return view('contact');
 });
 Route::get( '/delete2  ',function(){

     Post::destroy([2,5]);
     return view('contact');
 });
 Route::get('/forcedelete',function(){

     Post::withTrashed()->where('id',3)->forceDelete();
     // Post::onlyTrashed()->forceDelete();
     // Post::onlyTrashed()->where('id',2)->forceDelete();
     return view('contact');
 });
/********************************************************* */
// ELOQUENT-relationship
/********************************************************* */
// one to one relationship- hasOne relationship
 Route::get('/user/{id}/post',function($id){

     return User::find($id)->post->title;
     //find the user  with given id and return post of that user
 });
 //one to one inverse
 Route::get('/post/{id}/user',function($id){

     return Post::find($id)->user->name;
    //find post with given user id and return user_name of that post
 });
//one to many relationship
 Route::get('/posts',function(){

     $user = User::find(1);

     foreach($user->posts as $post){
         echo $post->title."<br>";
     }
 });
//many to many relationship
 Route::get('/user/{id}/role',function($id){


//          $user =  User::find($id)->roles()->orderBy('id','desc')->get();
//          return $user;
         $user =  User::find($id); //find user with mentioned id
         foreach($user->roles as $role){
             return $role->name;
         }
 });
//accessing the intermedate table / pivot
// Route::get('user/pivot',function(){

//     $user = User::find(1);

//     foreach($user->roles as $role){
//         echo $role->pivot;
//     }

// });
// Route::get('/user/country',function(){
//     $country =  Country::find(2);

//     foreach($country->posts as $post){
//         return $post->title;
//     }
// });

//polymorphic relations
// Route::get('user/photos',function(){

//     $user = User::find(1);

//     foreach($user->photos as $photo){
//         return $photo;
//     }

// });

// Route::get('photo/{id}/post',function($id){

//     $photo = Photo::findOrFail($id);

//     return  $photo->imageable_type;
// });

//polymorphic many to many
Route::get('/post/tag',function(){
    $post = Post::find(1);

    foreach($post->tags as $tag){
        echo $tag->name;
    }
});

Route::get('/tag/post',function(){

    $tag = Tag::find(2);

    foreach($tag->posts as $post){
        return $post;
    }

});

/********************************************************* */
// ELOQUENT-relationships- as per book-simplified
/********************************************************* */
//one to one relationship
Route::get('/user/{id}/passport',function($id){
    $user = User::find($id);

    return $user->passport->number;
});
//one to many relationship
Route::get('/team/{id}/players',function($id){
    $team = Team::find($id);

    foreach ($team->player as $player) {
        echo $player->name." is on ".$team->name."<br>";
    }
});
//many to many relationship-1
Route::get('/student/{id}/courses',function($id){
    $student = Student::find($id);

//    $course = $student->courses;
//    dd($student->courses);
    foreach ($student->courses as $course) {
        echo $student->name." is enrolled in ".$course->name."<br>";
    }
});
//many to many relationship-1
Route::get('/course/{id}/student',function($id){
    $course = Course::find($id);

//    $course = $student->courses;
//    dd($student->courses);
    foreach ($course->students as $student) {
        echo $student->name." is opted ".$course->name."<br>";
    }
});




