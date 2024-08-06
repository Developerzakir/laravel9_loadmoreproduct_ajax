<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(5);
        return view('posts.index', compact('posts'));
    }

    public function loadMoreData(Request $request)
    {
        $start = $request->input('start');

        $data = Post::orderBy('id', 'ASC')
            ->offset($start)
            ->limit(5)
            ->get();

        return response()->json([
            'data' => $data,
            'next' => $start + 5
        ]);
    }
}
