<?php
namespace App\Http\Controllers;
use App\Models\Tags;
use Illuminate\Http\Request;

class TagsController{

    public function index()
  {
    $tag = Tags::all();

    return $tag;
  }

  public function show($id)
  {
    $tag = Tags::find($id);

    if (!$tag) {
        return response()->json(['error' => 'Tag not found'], 404);
    }

    $videos = $tag->videos;

    return response()->json(['tag' => $tag, 'videos' => $videos]);
  }

  public function store(Request $request)
  {
    $name = $request->input('name');

    if (Tags::where('name', $name)->exists()) {
        return response()->json(['error' => 'Tag name already exists'], 422);
    }

    $tag = Tags::create($request->all());

    return response()->json($tag, 201);
  }

  public function update(Request $request, $id)
  {
    $tag = Tags::find($id);

    if (!$tag) {
        return response()->json(['error' => 'Tag not found'], 404);
    }
    $tag->name = $request->input('name');

    $tag->save();

    return response()->json(['Success' => 'Updated Tag'], 201);
  }

  public function destroy($id)
    {
        $tag = Tags::find($id);

        if (!$tag) {
            return response()->json(['error' => 'User not found'], 404);
        }
        $tag->delete();

        return response()->json(['message' => 'User deleted']);
    }
}

?>
