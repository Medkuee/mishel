<?php


use App\Http\Controllers\PostsApiController;
use App\Http\Controllers\UserAuthentication;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/posts', [PostsApiController::class, 'index']);
Route::post('/posts', [PostsApiController::class, 'store']);
Route::put('/posts/{post}', [PostsApiController::class, 'update']);
Route::delete('/posts/{post}', [PostsApiController::class, 'destroy']);



Route::get('/custom_users', [UserAuthentication::class, 'index']);
Route::get('/custom_users/profile', [UserAuthentication::class, 'me']);
Route::post('/custom_users/register', [UserAuthentication::class, 'register']);
Route::post('/custom_users/login', [UserAuthentication::class, 'login']);
Route::put('/custom_users/update', [UserAuthentication::class, 'update']);

// Route::get('/posts', function() {
//     return Post::all();
// }
// );


// Route::post('/posts', function() {

//     request()->validate([
//         'title'=>'required',
//         'content'=>'required'

//     ]);

//     return Post::create([
//         'title' => request('title'),
//         'content' => request('content'),
//     ]);
// }
// );

// Route::put('/posts/{post}', function(Post $post) {

//     request()->validate([
//         'title'=>'required',
//         'content'=>'required'

//     ]);
//     $success = $post->update([

//         'title' => request('title'),
//         'content' => request('content'),

//     ]);

//     return [
//         'success' => $success
//     ];
// }
// );
// Route::delete('/posts/{post}', function(Post $post) {

   
//     $success = $post->delete();

//     return [
//         'success' => $success
//     ];
// }
// );


// Route::get('/custom_users/user', [UserAuthentication::class, 'me']);
