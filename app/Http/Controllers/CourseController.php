<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Course;

class CourseController extends Controller
{
    public function getCourses(Request $request)
    {
        $courses = Course::with('plans', 'tests', 'attachments')->get();

        return response(['courses' => $courses], 200);
    }

    public function getMaterials(Request $request)
    {
        $course = Course::with('videos')->find($request->course_id);

        $subjects = $course->videos->pluck('subject_id');

        return response(['subjects' => $subjects], 200);
    }
}
