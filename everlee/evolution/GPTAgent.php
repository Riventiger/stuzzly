<?php

namespace Everlee\Evolution;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GPTAgent
{
    protected string $apiKey;
    protected string $model;

    public function __construct()
    {
        $this->apiKey = config('everlee.ai.gpt.api_key');
        $this->model = config('everlee.ai.gpt.model', 'gpt-4');
    }

    public function sendPrompt(string $prompt, array $context = []): ?string
    {
        $messages = array_merge(
            [['role' => 'system', 'content' => 'You are Everlee, an expert Laravel + Vue developer.']],
            $context,
            [['role' => 'user', 'content' => $prompt]]
        );

        try {
            $response = Http::withToken($this->apiKey)
                ->timeout(60)
                ->post('https://api.openai.com/v1/chat/completions', [
                    'model' => $this->model,
                    'messages' => $messages,
                    'temperature' => 0.7,
                ]);

            if ($response->successful()) {
                $output = $response->json();
                return $output['choices'][0]['message']['content'] ?? null;
            } else {
                Log::error('GPTAgent failed', ['status' => $response->status(), 'body' => $response->body()]);
            }
        } catch (\Throwable $e) {
            Log::error('GPTAgent exception', ['message' => $e->getMessage()]);
        }

        return null;
    }
}
