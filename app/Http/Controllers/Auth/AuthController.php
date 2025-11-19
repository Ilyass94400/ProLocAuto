<?php 

    namespace App\Http\Controllers\Auth;
    
    use Illuminate\Http\Request;
    use App\Models\User;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Auth; 
    use App\Http\Controllers\Controller;
    
    class AuthController extends Controller {
        public function showRegisterForm() {
            return view('auth.register');
        }
        
        public function register(Request $request) {
            $request->validate([ 
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email', 
                'password' => 'required|min:9|confirmed'
            ]);

            $user = User::create([
                'name' => $request -> name, 
                'email' => $request -> email, 
                'password' => Hash::make($request->password), 
            ]);
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->route('clients.accueil')->with('success', 'Compte créé avec succès !');
        }
    }
?>