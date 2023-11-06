<?PHP
namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;

class UsuariosController{

  public function index()
  {
    $user = Usuarios::all();
    return $user;
  }

  public function show($id)
  {
    $user = Usuarios::find($id);

    if (!$user) {
        return response()->json(['error' => 'User not found'], 404);
    }

    return $user;
  }

  public function store(Request $request)
  {
    $email = $request->input('email');

    if (strlen($email) < 6) {
        return response()->json(['error' => 'The email must have at least 6 characters'], 400);
    }

    $user = Usuarios::where('email', $email)->first();

    if ($user) {
        return response()->json(['error' => 'Email is already in use'], 400);
    }

    $user = new Usuarios();
    $user->email = $email;
    $user->password = $request->input('password');
    $user->save();

    return response()->json($user, 201);
  }

  public function update(Request $request, $id)
  {
    $user = Usuarios::find($id);

    if (!$user) {
        return response()->json(['error' => 'User not found'], 404);
    }

    $user->email = $request->input('email');
    $user->password = bcrypt($request->input('password'));
    $user->save();

    return response()->json(['Success' => 'Updated User'],201);
  }

  public function destroy($id)
    {
        $user = Usuarios::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted']);
    }

}
