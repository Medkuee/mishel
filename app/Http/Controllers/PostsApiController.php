<?php

namespace App\Http\Controllers;

use App\Models\Post;


use Illuminate\Http\Request;

class PostsApiController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['exclude' => []]);
    }

    public function index() {
        $user = auth()->user();
        // return Post::where('userId', $user->id)->get();

        return response()->json([
            'status' => 'success',
            "data" => Post::where('userId', $user->id)->get()
        ]); 
    }

    public function store()
    {
        request()->validate([
            'day' => 'required',
            'period' => 'required',
            'course_name' => 'required',
            'course_professor' => 'required',
            'color' => 'required',
        ]);

        $user = auth()->user();

        $postCreate =  Post::create([
            'day' => request('day'),
            'period' => request('period'),
            'course_name' => request('course_name'),
            'course_professor' => request('course_professor'),
            'color' => request('color'),
            'userId'=> $user->id
        ]);
        
        return response()->json([
            'status' => 'success',
            'data' => [
                'postCreated' => $postCreate
            ]
            ]);

        
    }

    public function update(Post $post)
    {
        request()->validate([
            'content' => 'required',
        ]);

        $user = auth()->user();

        $success = $post->update([
            'content' => request('content'),
            'userId'=> $user->id
        ]);

        return [
            'success' => $success
        ];
    }

    public function destroy(Post $post)

    {
        $user = auth()->user();

        $success = $post->delete([
            'userId'=> $user->id
        ]);

        return [
            'success' => $success
        ];
    }
}
