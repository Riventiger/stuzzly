<?php

namespace Everlee\Evolution;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class ImageGenerator
{
    protected string $apiKey;
    protected string $endpoint;

    public function __construct()
    {
        $this->apiKey = config('everlee.ai.gpt.api_key');
        $this->endpoint = 'https://api.openai.com/v1/images/generations';
    }

    /**
     * Generate an image from a prompt and save it to disk.
     */
    public function generate(string $prompt, string $saveAs, int $size = 512): ?string
    {
        try {
            $response = Http::withToken($this->apiKey)
                ->timeout(60)
                ->post($this->endpoint, [
                    'prompt' => $prompt,
                    'n' => 1,
                    'size' => "{$size}x{$size}",
                    'response_format' => 'url',
                ]);

            if (!$response->successful()) {
                Log::error('[Everlee] Image generation failed', ['status' => $response->status(), 'body' => $response->body()]);
                return null;
            }

            $data = $response->json();
            $imageUrl = $data['data'][0]['url'] ?? null;

            if (!$imageUrl) {
                return null;
            }

            $imageData = file_get_contents($imageUrl);
            $fullPath = public_path('storage/branding/' . ltrim($saveAs, '/'));

            File::ensureDirectoryExists(dirname($fullPath));
            File::put($fullPath, $imageData);

            return asset('storage/branding/' . ltrim($saveAs, '/'));
        } catch (\Throwable $e) {
            Log::error('[Everlee] Image generation error', ['message' => $e->getMessage()]);
            return null;
        }
    }
}
