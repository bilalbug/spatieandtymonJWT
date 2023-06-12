<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    public function index()
    {
        return BlogPost::all();
    }

    public function store(Request $request)
    {
        $BlogPost = BlogPost::create($request->all());

        return response()->json($BlogPost, 201);
    }

    public function show($id)
    {
        $BlogPost = BlogPost::find($id);

        if (!$BlogPost) {
            return response()->json(['message' => 'BlogPost not found'], 404);
        }

        return $BlogPost;
    }

    public function update(Request $request, $id)
    {
        $BlogPost = BlogPost::find($id);

        if (!$BlogPost) {
            return response()->json(['message' => 'BlogPost not found'], 404);
        }

        $BlogPost->update($request->all());

        return response()->json($BlogPost, 200);
    }

    public function destroy($id)
    {
        $BlogPost = BlogPost::find($id);

        if (!$BlogPost) {
            return response()->json(['message' => 'BlogPost not found'], 404);
        }

        $BlogPost->delete();

        return response()->json(['message' => 'BlogPost deleted'], 204);
    }
}

