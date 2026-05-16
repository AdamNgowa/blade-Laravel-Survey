<?php

namespace App\Http\Controllers;

use App\Models\AccessCode;
use App\Models\Question;
use App\Models\SurveyAttempt;
use App\Models\SurveyResponse;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function landing()
    {
        return view('survey.welcome');
    }

    public function start(Request $request)
    {
        $request->validate([
            'access_code' => 'required'
        ]);

        $code = AccessCode::where('code', $request->access_code)->first();

        if (!$code || $code->is_used) {
            return back()->withErrors([
                'access_code' => 'Invalid or already used access code'
            ]);
        }

        $attempt = SurveyAttempt::create([
            'access_code_id' => $code->id
        ]);

        $code->update([
            'is_used' => true
        ]);

        return redirect()->route('survey.question', [
            'attempt' => $attempt->id,
            'index' => 1
        ]);
    }

    public function question($attempt, $index)
    {
        $questions = Question::with('answers')
            ->orderBy('topic_id')
            ->orderBy('sequence')
            ->get()
            ->values();

        $question = $questions->get($index - 1);

        if (!$question) {
            return redirect()->route('survey.result', $attempt);
        }

        return view('survey.question', [
            'attempt' => $attempt,
            'question' => $question,
            'index' => $index,
            'total' => $questions->count()
        ]);
    }

    public function saveAnswer(Request $request, $attempt)
    {
        $request->validate([
            'question_id' => 'required',
            'answer_id' => 'required|exists:answers,id',
            'index' => 'required'
        ]);

        SurveyResponse::updateOrCreate(
            [
                'survey_attempt_id' => $attempt,
                'question_id' => $request->question_id,
            ],
            [
                'answer_id' => $request->answer_id
            ]
        );

        return redirect()->route('survey.question', [
            'attempt' => $attempt,
            'index' => $request->index + 1
        ]);
    }

    public function result($attempt)
    {
        $attempt = SurveyAttempt::with('responses.answer')
            ->findOrFail($attempt);

        $score = 0;

        foreach ($attempt->responses as $response) {
            $score += $response->answer->marks;
        }

        $max = Question::count() * 4;

        $percentage = $max ? ($score / $max) * 100 : 0;

        if ($percentage <= 25) {
            $msg = "Need urgent intervention";
        } elseif ($percentage <= 50) {
            $msg = "You can do better";
        } elseif ($percentage <= 75) {
            $msg = "Almost there";
        } else {
            $msg = "You are good";
        }

        $attempt->update([
            'percentage' => round($percentage, 2),
            'recommendation' => $msg,
            'completed_at' => now(),
        ]);

        return view('survey.result', [
            'percentage' => round($percentage, 2),
            'message' => $msg
        ]);
    }
}