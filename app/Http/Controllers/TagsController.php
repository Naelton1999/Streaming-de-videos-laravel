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
        return response()->json(['error' => 'User not found'], 404);
    }

    return $tag;
  }

  public function store(Request $request)
  {
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

    return response()->json(['Success' => 'Tag Atualizada'], 201);
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
