<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request){

        // Creacion del usuario
        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request-> password);

        $user->save();
        return view('login');
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        //dd($request->email, $request->password);

        $credentials = [
            "email" => $request->email,
            "password" => $request->password,
        ];
    
        if(Auth::attempt($credentials)){
            //dd("Login Correcto");
            return redirect()->intended(route('tasks.index'));
        } else {
            Session::flash('error', 'Credenciales incorrectas');
            return redirect()->route('login');
        }
    }
    
    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate(); 
        $request->session()->regenerateToken(); 

        return redirect(route('login'));
    }
}
