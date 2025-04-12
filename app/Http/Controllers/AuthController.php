<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    // List all users (example)
    public function index()
    {
        $users = DB::table('users')->get();
        return view('home', ['users' => $users]);
    }

    // Delete a user by ID
    public function delete($id)
    {
        $deleted = DB::table('users')->where('id', $id)->delete();

        if ($deleted) {
            return response()->json(['message' => 'User deleted successfully.'], 200);
        } else {
            return response()->json(['message' => 'User not found or could not be deleted.'], 404);
        }
    }

    // Register a new user
    public function register(Request $request)
    {
        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // Ensure email is unique
            'password' => 'required|string|min:6|max:20|confirmed', // Limit password to max 20 characters
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Hash the password
        $hashedPassword = Hash::make($request->password);

        // Insert user into the database
        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $hashedPassword,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['message' => 'User registered successfully.'], 201);
    }

    // Login user
    public function login(Request $request)
    {
        // Validate login credentials
        $credentials = $request->only('email', 'password');

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            // Authentication successful, get user details
            $user = Auth::user();
            return response()->json(['message' => 'Login successful', 'user' => $user]);
        } else {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }
}
