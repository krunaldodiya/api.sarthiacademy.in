<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Test;

use App\TestAnswer;

use App\TestParticipant;

use Illuminate\Support\Str;

use Error;

class TestController extends Controller
{
    public function submit(Request $request)
    {
        $user = auth()->user();

        $test = Test::find($request->test_id);

        $exists = TestParticipant::where(['test_id' => $test->id,'user_id' => $user->id])->first();

        if ($exists) {
            throw new Error("Already Submitted");
        }

        $answers = collect($request->meta)
            ->map(function ($answer) use ($user, $test) {
                return [
                    'id' => Str::uuid(),
                    'user_id' => $user->id,
                    'test_id' => $test->id,
                    'question_id' => $answer['question_id'],
                    'point' => $answer['point'],
                    'current_answer' => $answer['current_answer'],
                    'correct_answer' => $answer['correct_answer'],
                ];
            });

        TestAnswer::insert($answers->toArray());

        TestParticipant::create([
            'test_id' => $test->id,
            'user_id' => $user->id,
            'points' => $answers->sum('point'),
            'status' => 'finished'
        ]);

        return response(['success' => true], 200);
    }
}
