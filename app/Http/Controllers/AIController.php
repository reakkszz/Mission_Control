<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AIController extends Controller
{
    public function index()
    {
        return view('ai.index', [
            'header' => 'AI Assistant'
        ]);
    }

    public function ask(Request $request)
{
    $request->validate([
        'message' => 'required'
    ]);

    $message = $request->message;

    $apiKey = env('GEMINI_API_KEY');

    $response = Http::post(
        "https://generativelanguage.googleapis.com/v1beta/models/gemini-3.5-flash:generateContent?key={$apiKey}",
        [
            "contents" => [
                [
                    "parts" => [
                        [
                            "text" => $message
                        ]
                    ]
                ]
            ]
        ]
    );

    if ($response->status() === 429) {
        $reply ="⚠️ AI sedang mencapai batas penggunaan Gemini. Silahkan coba lagi beberapa saat.";

    } elseif ($response->successful()) {
        $reply = $response['candidates'][0]['content']['parts'][0]['text']
        ?? 'No response from AI.';

    } else {
        $reply = 'Error: '. $response->body();
    }

    return view('ai.index', compact('message', 'reply'));
}
}
