<?PHP
namespace App\Http\Controllers;

use App\Models\Tags;
use App\Models\Videos;
use Illuminate\Http\Request;

class VideosController{

    public function store(Request $request)
{
    $tagIds = $request->input('tag_ids', []);

    $validTagIds = Tags::whereIn('id', $tagIds)->pluck('id')->all();

    if (count($tagIds) !== count($validTagIds)) {
        return response()->json(['error' => 'ID de tag inválido. Verifique os IDs das tags.'], 400);
    }

    $video = Videos::create($request->only(['name', 'url']));

    $video->tags()->sync($validTagIds);

    $video->load('tags');

    return response()->json($video, 201);
}

public function index()
{
    $videos = Videos::with('tags')->get();

    return response()->json($videos, 200);
}

public function update(Request $request, $id)
{
    $video = Videos::find($id);

    if (!$video) {
        return response()->json(['error' => 'Video not found'], 404);
    }

    $data = $request->only(['name', 'url']);

    $video->fill($data);
    $video->save();

    $tagIds = $request->input('tag_ids', []);
    $validTagIds = Tags::whereIn('id', $tagIds)->pluck('id')->all();

    if (count($tagIds) !== count($validTagIds)) {
        return response()->json(['error' => 'ID de tag inválido. Verifique os IDs das tags.'], 400);
    }

    $video->tags()->sync($validTagIds);

    $video->load('tags');

    return response()->json($video, 200);
}

public function destroy($id)
    {
        $video = Videos::find($id);

        if (!$video) {
            return response()->json(['error' => 'Video not found'], 404);
        }

        $video->delete();

        return response()->json(['message' => 'Video deleted']);
    }

}
