<?php

namespace Everlee\Evolution;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class SelfUpgradeEngine
{
    protected GPTAgent $gpt;
    protected ClaudeAgent $claude;

    public function __construct()
    {
        $this->gpt = new GPTAgent();
        $this->claude = new ClaudeAgent();
    }

    /**
     * Run an upgrade cycle using both AI agents and compare outputs.
     */
    public function run(string $userPrompt): array
    {
        $enhanced = PromptEnhancer::enhance($userPrompt);

        $gptOutput = $this->gpt->sendPrompt($enhanced);
        $claudeOutput = $this->claude->sendPrompt($enhanced);

        $decision = $this->debate($gptOutput, $claudeOutput, $userPrompt);

        Log::info('[Everlee] Self-upgrade completed', [
            'prompt' => $userPrompt,
            'gpt' => $gptOutput,
            'claude' => $claudeOutput,
            'final' => $decision,
        ]);

        return [
            'gpt' => $gptOutput,
            'claude' => $claudeOutput,
            'final' => $decision,
        ];
    }

    /**
     * Compare and decide which AI output to use (or merge).
     */
    protected function debate(?string $gptOutput, ?string $claudeOutput, string $prompt): ?string
    {
        if ($gptOutput && $claudeOutput) {
            if (strlen($claudeOutput) > strlen($gptOutput) * 1.1) {
                return $claudeOutput;
            } elseif (strlen($gptOutput) > strlen($claudeOutput) * 1.1) {
                return $gptOutput;
            }

            return $gptOutput . "\n\n<!--- CLAUDE RESPONSE BELOW --->\n\n" . $claudeOutput;
        }

        return $gptOutput ?? $claudeOutput ?? null;
    }

    /**
     * Save upgrade result to staging area.
     */
    public function saveToStaging(string $filename, string $content): bool
    {
        $stagingPath = base_path('everlee/staging/self-upgrades/' . ltrim($filename, '/'));

        try {
            File::ensureDirectoryExists(dirname($stagingPath));
            File::put($stagingPath, $content);
            return true;
        } catch (\Throwable $e) {
            Log::error('[Everlee] Failed to save staging file', ['error' => $e->getMessage()]);
            return false;
        }
    }
}
