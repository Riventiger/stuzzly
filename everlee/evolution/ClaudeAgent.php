<?php

namespace Everlee\Evolution;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ClaudeAgent
{
    protected string $apiKey;
    protected string $model;

    public function __construct()
    {
        $this->apiKey = config('everlee.ai.claude.api_key');
        $this->model = config('everlee.ai.claude.model', 'claude-3-sonnet-20240229');
    }

    public function sendPrompt(string $prompt, array $context = []): ?string
    {
        $messages = array_merge(
            [['role' => 'user', 'content' => $prompt]],
            $context
        );

        try {
            $response = Http::withHeaders([
                    'x-api-key' => $this->apiKey,
                    'anthropic-version' => '2023-06-01',
                ])
                ->timeout(60)
                ->post('https://api.anthropic.com/v1/messages', [
                    'model' => $this->model,
                    'max_tokens' => 2048,
                    'messages' => $messages,
                    'temperature' => 0.7,
                ]);

            if ($response->successful()) {
                $output = $response->json();
                return $output['content'][0]['text'] ?? null;
            } else {
                Log::error('ClaudeAgent failed', ['status' => $response->status(), 'body' => $response->body()]);
            }
        } catch (\Throwable $e) {
            Log::error('ClaudeAgent exception', ['message' => $e->getMessage()]);
        }

        return null;
    }
}
