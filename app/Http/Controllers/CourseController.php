<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Course;
use App\Subject;
use App\Chapter;
use App\Video;

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

    public function getSubjects(Request $request)
    {
        $course = Course::with('videos')->find($request->course_id);

        $subjects = Subject::whereIn('id', $course->videos->pluck('subject_id'))->get();

        return response(['subjects' => $subjects], 200);
    }

    public function getChapters(Request $request)
    {
        $chapters = Chapter::where('subject_id', $request->subject_id)->get();

        return response(['chapters' => $chapters], 200);
    }

    public function getVideos(Request $request)
    {
        $videos = Video::where('chapter_id', $request->chapter_id)->get();

        return response(['videos' => $videos], 200);
    }
}
