<?PHP
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Usuarios extends Model implements JWTSubject{

    protected $table = 'usuarios';

    protected $fillable = ['email', 'password'];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

}
