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

        $subject_id = $course->videos->pluck('subject_id');
        $chapter_id = $course->videos->pluck('chapter_id');
        $video_id = $course->videos->pluck('id');

        return response([
            'subjects' => Subject::whereIn('id', $subject_id)->get(),
            'chapters' => Chapter::whereIn('id', $chapter_id)->get(),
            'videos' => Video::whereIn('id', $video_id)->get(),
        ], 200);
    }
}
