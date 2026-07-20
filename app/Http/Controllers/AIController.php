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

    $response = Http::timeout(30)->post(
    "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}",
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

if ($response->successful()) {

    $reply = $response['candidates'][0]['content']['parts'][0]['text']
        ?? 'No response from AI.';

} elseif ($response->status() == 429) {

    $reply = "⚠️ Batas penggunaan AI telah tercapai. Silakan coba lagi nanti.";

} elseif ($response->status() == 503) {

    $reply = "⚠️ AI sedang sibuk. Silakan coba lagi beberapa saat.";

} else {

    $reply = "⚠️ Terjadi kesalahan saat menghubungi AI.";
}
    return view('ai.index', compact('message', 'reply'));
}
}
