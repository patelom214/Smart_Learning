<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\Post;
class ApiController extends Controller
{
    public function randomUsers()
    {
        $posts = Post::with('user')->latest()->get();

        return response()->json([
            'status' => true,
            'data' => $posts
        ]);
    }
    public function show($id)
    {
        $post = Post::find($id);

        return response()->json($post);
    }
    public function hello()
    {
        return response()->json([
            "message" => "Hello API working!"
        ]);
    }
}