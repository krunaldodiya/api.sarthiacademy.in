<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Course;

class CourseController extends Controller
{
    public function getCourses(Request $request)
    {
        $courses = Course::with('plans', 'tests')->get();

        return response(['courses' => $courses], 200);
    }
}
