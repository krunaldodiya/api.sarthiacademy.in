<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Course;
use App\Subject;
use App\Test;
use App\Attachment;

class CourseController extends Controller
{
    public function getCourses(Request $request)
    {
        $courses = Course::with('plans')->get();

        return response(['courses' => $courses], 200);
    }

    public function getCourseMaterials(Request $request)
    {
        $course = Course::with('videos')->find($request->course_id);

        $subject_id = $course->videos->pluck('subject_id');
        $chapter_id = $course->videos->pluck('chapter_id');
        $video_id = $course->videos->pluck('id');

        $subjects = Subject::with(['chapters' => function ($query) use ($subject_id, $chapter_id, $video_id) {
            return $query->with(['videos' => function ($query) use ($subject_id, $chapter_id, $video_id) {
                return $query->with('qualities')->whereIn('id', $video_id);
            }])->whereIn('id', $chapter_id);
        }])->whereIn('id', $subject_id)->get();

        return response(['subjects' => $subjects], 200);
    }

    public function getCourseTests(Request $request)
    {
        $tests = Test::with('questions', 'answers.question', 'participants.user')
        ->where(function ($query) use ($request) {
            if ($request->date) {
                return $query->whereDate('created_at', $request->date);
            }
        })
        ->where('course_id', $request->course_id)
        ->get();

        return response(['tests' => $tests], 200);
    }

    public function getCourseAttachments(Request $request)
    {
        $attachments = Attachment::where('course_id', $request->course_id)->get();

        return response(['attachments' => $attachments], 200);
    }
}
