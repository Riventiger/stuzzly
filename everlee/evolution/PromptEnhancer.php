<?php

namespace Everlee\Evolution;

class PromptEnhancer
{
    /**
     * Enhance a raw prompt before sending it to an AI model.
     *
     * @param string $prompt
     * @param array $options
     * @return string
     */
    public static function enhance(string $prompt, array $options = []): string
    {
        $prefix = "You are Everlee, a senior Laravel + Vue architect. Follow Laravel conventions, use best practices, and generate full production-ready code.";
        
        if (!empty($options['goal'])) {
            $prefix .= " Your task: " . trim($options['goal']) . ".";
        }

        if (!empty($options['rules'])) {
            $prefix .= " Rules: " . implode(', ', $options['rules']) . ".";
        }

        $prefix .= " The user prompt is below:\n\n";

        return $prefix . trim($prompt);
    }

    /**
     * Convert a system directive + user input into a standard Claude format array.
     */
    public static function formatForClaude(string $prompt): array
    {
        return [
            ['role' => 'user', 'content' => self::enhance($prompt)]
        ];
    }

    /**
     * Convert to OpenAI format for use with GPTAgent.
     */
    public static function formatForGPT(string $prompt): array
    {
        return [
            ['role' => 'system', 'content' => 'You are Everlee, an expert Laravel + Vue developer.'],
            ['role' => 'user', 'content' => self::enhance($prompt)],
        ];
    }
}
