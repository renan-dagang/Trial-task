<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Course;
use App\Models\CourseEnrollment;
use Illuminate\Support\Facades\DB;

class CourseEnrollmentController extends Controller
{
    public function enrollWithCourse(Request $request)
{
    $request->validate([
        'student_id' => 'required',
        'course_id' => 'required',
    ]);

    $studentId = $request->student_id;
    $courseId = $request->course_id;

    $existingEnrollment = CourseEnrollment::where('student_id', $studentId)
        ->where('course_id', $courseId)
        ->first();

    if ($existingEnrollment) {
        return response()->json(['message' => 'Student is already enrolled in the course'], 200);
    }

    try {
        DB::beginTransaction();

        $course = Course::lockForUpdate()->findOrFail($courseId);
        
        if ($course->max_students > 0) {
            // Perform additional validation or operations here

            CourseEnrollment::create([
                'student_id' => $studentId,
                'course_id' => $courseId,
            ]);

            $course->max_students--;
            $course->save();

            DB::commit();

            return response()->json(['message' => 'Course Enrollment successful'], 200);
        } else {
            return response()->json(['message' => 'Course is already full'], 400);
        }
    } catch (\Exception $e) {
        DB::rollBack();
        
        // Handle the exception and provide an error message
        return response()->json(['message' => 'Course Enrollment failed'], 500);
    }
}
}
