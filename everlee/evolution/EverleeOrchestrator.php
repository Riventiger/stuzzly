<?php

namespace Everlee\Evolution;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class EverleeOrchestrator
{
    protected SelfUpgradeEngine $engine;

    public function __construct()
    {
        $this->engine = new SelfUpgradeEngine();
    }

    /**
     * Run the full AI evolution process with a given user prompt.
     */
    public function execute(string $prompt): array
    {
        $run = $this->engine->run($prompt);

        if (!isset($run['final']) || empty(trim($run['final']))) {
            Log::warning('[Everlee] No output from AI engines.');
            return ['status' => 'error', 'message' => 'No response from AI.'];
        }

        $filename = $this->suggestFilename($prompt);
        $success = $this->engine->saveToStaging($filename, $run['final']);

        return [
            'status' => $success ? 'success' : 'error',
            'file' => $filename,
            'output' => $run['final'],
            'source' => $run,
        ];
    }

    /**
     * Generate a clean filename from the prompt.
     */
    protected function suggestFilename(string $prompt): string
    {
        $slug = Str::slug(Str::limit($prompt, 60));
        $filename = $slug . '.txt';

        return $filename;
    }
}
