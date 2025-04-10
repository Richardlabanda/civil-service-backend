<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
   
    public function index()
    {
       
        $users = DB::table('users')->get();

      
        return view('home', ['users' => $users]);
    }

    
    public function delete($id)
    {
       
        $deleted = DB::table('users')->where('id', $id)->delete();

      
        if ($deleted) {
            return response()->json(['message' => 'User deleted successfully.'], 200);
        } else {
            return response()->json(['message' => 'User not found or could not be deleted.'], 404);
        }
    }
}
