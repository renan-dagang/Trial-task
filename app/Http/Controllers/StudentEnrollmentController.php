<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentEnrollmentController extends Controller
{
    public function enroll(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'grade' => 'required|numeric|gte:75',
            'has_scholarship' => 'boolean',
        ]);

        Student::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'grade' => $request->grade,
            'has_scholarship' => $request->has_scholarship ?? false,
        ]);
        
       
        return response()->json(['message' => 'Enrollment successful'], 200);
        
          
    }

}
