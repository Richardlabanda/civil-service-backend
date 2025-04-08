<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  

class InsertQuestionController extends Controller
{
    
    public function store(Request $request)
    {
    
        $validated = $request->validate([
            'text' => 'required|string|max:255',
            'category' => 'required|string|max:255',  // Category is now a text field
            'option_a' => 'required|string|max:255',
            'option_b' => 'required|string|max:255',
            'option_c' => 'required|string|max:255',
            'option_d' => 'required|string|max:255',
            'correct_answer' => 'required|string|in:a,b,c,d',
        ]);

        
        $question = DB::table('questions')->insert([
            'text' => $validated['text'],
            'category' => $validated['category'],  
            'option_a' => $validated['option_a'],
            'option_b' => $validated['option_b'],
            'option_c' => $validated['option_c'],
            'option_d' => $validated['option_d'],
            'correct_answer' => $validated['correct_answer'],
            'created_at' => now(),
            'updated_at' => now()
        ]);

        
        if ($question) {
            return response()->json([
                'message' => 'Question added successfully!'
            ], 201); 
        } else {
            return response()->json([
                'message' => 'Failed to add question.'
            ], 500);  
        }
    }


    public function index()
    {
        
        $questions = DB::table('questions')->get();
    
        
        return response()->json($questions);
    }

    
    public function delete($id)
    {
        
        $question = DB::table('questions')->where('id', $id)->first();

        if ($question) {
            
            DB::table('questions')->where('id', $id)->delete();
            return response()->json([
                'message' => 'Question deleted successfully!'
            ], 200);  
        } else {
            
            return response()->json([
                'message' => 'Question not found.'
            ], 404);  
        }
    }
}
