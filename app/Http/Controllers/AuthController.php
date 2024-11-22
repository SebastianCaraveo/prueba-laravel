<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    public function welcome(){
        /* $categories = Category::all(); */
        $products = Product::with('category')->get();
        return view('welcome', compact('products'));
    }

    public function dashboard(){
        return view('dashboard');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Auth::login($user);

        if($user->is_admin){
            return redirect()->route('dashboard')->with('success', 'Registro exitoso, te encuentras en el Panel de Administrador');
        }else{
            return redirect()->route('welcome')->with('success', 'Te has registrado correctamente, bienvenido al welcome');
        }

    }

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        /* dd(Auth::attempt($credentials)); */

        if (Auth::attempt($credentials)) {
            session()->flash('success', '¡Has iniciado sesión correctamente!');

            return redirect()->route('welcome');
        }

        return response()->json(['error' => 'Credenciales inválidas'], 401);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('welcome');
    }
}
