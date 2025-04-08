<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash;  

class AuthController extends Controller
{
    
    public function registerForm()
    {
        return view('auth.register');  
    }

    
    public function register(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:8',
        ]);

    
        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),  
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        
        return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
    }

    
    public function loginForm()
    {
        return view('auth.login');  
    }

    

    
    public function logout()
    {
        
        session()->forget('user');
        return redirect()->route('login')->with('success', 'Logged out successfully!');
    }
    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        
        return redirect()->route('home')->with('success', 'Login successful!');
    }

    return redirect()->back()->with('error', 'Invalid credentials!');
}
public function index()
    {
        
        $users = User::all();

        
        return view('home', ['users' => $users]);
    }
}
