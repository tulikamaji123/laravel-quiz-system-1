<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI;


class AIQuizController extends Controller
{
    //
     public function generateQuestions(Request $request)
    {
        $topic = $request->input('topic');

        $client = OpenAI::client(env('OPENAI_API_KEY'));

        $response = $client->chat()->create([
            'model' => 'gpt-4o-mini', // or gpt-5 if available
            'messages' => [
                ['role' => 'system', 'content' => 'You are a quiz generator AI.'],
                ['role' => 'user', 'content' => "Generate 5 multiple choice questions with 4 options each on the topic: $topic. Return as JSON."]
            ],
        ]);

        $questions = json_decode($response->choices[0]->message->content, true);

        return view('ai_quiz', compact('questions', 'topic'));
    }

    public function checkAnswers(Request $request)
    {
        $topic = $request->input('topic');
        $answers = $request->input('answers');

        $client = OpenAI::client(env('OPENAI_API_KEY'));

        $response = $client->chat()->create([
            'model' => 'gpt-4o-mini',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a quiz evaluator AI.'],
                ['role' => 'user', 'content' => "Evaluate these answers for topic $topic:\n" . json_encode($answers)]
            ],
        ]);

        $result = $response->choices[0]->message->content;

        return view('ai_result', compact('result', 'topic'));
    }
}
