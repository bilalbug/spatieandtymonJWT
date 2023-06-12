<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    public function index()
    {
        return BlogCategory::all();
    }

    public function store(Request $request)
    {
        $BlogCategory = BlogCategory::create($request->all());

        return response()->json($BlogCategory, 201);
    }

    public function show($id)
    {
        $BlogCategory = BlogCategory::find($id);

        if (!$BlogCategory) {
            return response()->json(['message' => 'BlogCategory not found'], 404);
        }

        return $BlogCategory;
    }

    public function update(Request $request, $id)
    {
        $BlogCategory = BlogCategory::find($id);

        if (!$BlogCategory) {
            return response()->json(['message' => 'BlogCategory not found'], 404);
        }

        $BlogCategory->update($request->all());

        return response()->json($BlogCategory, 200);
    }

    public function destroy($id)
    {
        $BlogCategory = BlogCategory::find($id);

        if (!$BlogCategory) {
            return response()->json(['message' => 'BlogCategory not found'], 404);
        }

        $BlogCategory->delete();

        return response()->json(['message' => 'BlogCategory deleted'], 204);
    }
}

