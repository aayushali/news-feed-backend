<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades;
use App\Models\TagModel;
use phpDocumentor\Reflection\DocBlock\Tag;

class TagController extends Controller
{
    public function index()
    {
        $tags = TagModel::all();
        $results = [
            "data" => $tags,
            "code" => 200,
            "message" => "Listing tags successfully!"
        ];
        return response()->json($results);
    }

    public function store_tag(Request $request)
    {
        $validatedData = $request->validate([
            'tag_name' => 'required',
            'tag_type' => 'required',
        ]);
        if ($validatedData) {
            $tag_name = $request->tag_name;
            $tag_type = $request->tag_type;
            $tag = new TagModel;
            $tag->tag_name = $tag_name;
            $tag->tag_type = $tag_type;
            $tag->save();
        }
        $results = [
            "data" => $tag,
            "code" => 200,
            "message" => "New tag inserted successfully"
        ];
        return response()->json($results);
    }

    // tag updating
    public function updateTag(Request $request, $id)
    {
        if ($id) {
            $tagName = $request->tag_name;
            $tagType = $request->tag_type;
            $tag = TagModel::findOrFail($id);
            $tag->tag_name = $tagName;
            $tag->tag_type = $tagType;
            $tag->save();
            $results = [
                "data" => $tag,
                "code" => 200,
                "message" => "Tag updated successfully"
            ];
            return response()->json($results);
        }

    }

    public function destroy($id)
    {
        if ($id) {
            $tag = TagModel::findOrFail($id);
            $tag->delete();
            $tag = TagModel::all();
            return response()->json($tag);

        }
    }
}
