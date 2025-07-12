<?php

namespace Everlee\Evolution;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class VisualFallbackHandler
{
    protected string $fallbackPath;

    public function __construct()
    {
        $this->fallbackPath = public_path('storage/branding/default-placeholder.png');
    }

    /**
     * Return a fallback image URL if nothing else is available.
     */
    public function get(): string
    {
        if (!File::exists($this->fallbackPath)) {
            $this->createFallbackImage();
        }

        return asset('storage/branding/default-placeholder.png');
    }

    /**
     * Generate a basic placeholder image if not already present.
     */
    protected function createFallbackImage(): void
    {
        try {
            $width = 512;
            $height = 512;
            $image = imagecreatetruecolor($width, $height);

            $bg = imagecolorallocate($image, 240, 240, 240);
            imagefilledrectangle($image, 0, 0, $width, $height, $bg);

            $textColor = imagecolorallocate($image, 100, 100, 100);
            imagestring($image, 5, 130, 250, 'NO IMAGE', $textColor);

            File::ensureDirectoryExists(dirname($this->fallbackPath));
            imagepng($image, $this->fallbackPath);
            imagedestroy($image);
        } catch (\Throwable $e) {
            Log::error('[Everlee] Failed to create fallback image', ['message' => $e->getMessage()]);
        }
    }
}
