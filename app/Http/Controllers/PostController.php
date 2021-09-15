<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    protected string $model = Post::class;

    public function showPostWithTags($id)
    {
        $resource = $this->model::with('tags')->findOrFail($id);;

        return response()->json($resource, 200);
    }
}
