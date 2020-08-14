<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function getCourses(Request $request)
    {
        $courses = Course::with('videos', 'tests')
            ->orderBy('order')
            ->get();

        return response(['courses' => $courses], 200);
    }
}
