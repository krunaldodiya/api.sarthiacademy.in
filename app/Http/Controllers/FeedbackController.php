<?php

namespace App\Http\Controllers;

use App\Feedback;

use App\Http\Requests\SendFeedback;

class FeedbackController extends Controller
{
    public function send(SendFeedback $request)
    {
        $feedback = Feedback::create($request->all());

        return response(['status' => true], 200);
    }
}
