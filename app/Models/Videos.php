<?PHP
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Videos extends Model{

    protected $fillable = ['name', 'url'];

    public function tags()
    {

    return $this->belongsToMany(tags::class, 'tags_videos', 'video_id', 'tag_id')->withTimestamps();

    }
}
