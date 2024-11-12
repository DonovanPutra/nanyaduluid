namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Method to check if the username exists
    public function checkUsername($username)
    {
        // Check if the username already exists in the database
        $exists = User::where('username', $username)->exists();

        // Return a JSON response with the result
        return response()->json(['exists' => $exists]);
    }
}
