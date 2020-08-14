<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Course;

class CourseController extends Controller
{
    public function getCourses(Request $request)
    {
        $courses = Course::with('plans', 'tests', 'attachments', 'subjects.chapters.videos')->get();

        return response(['courses' => $courses], 200);
    }
}
