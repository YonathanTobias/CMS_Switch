<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageService
{
    /**
     * Compress, resize, and convert uploaded image to WebP format.
     *
     * @param UploadedFile $file
     * @param string $folder Destination folder inside public disk (e.g. 'carousels', 'posts', 'team')
     * @param int $maxWidth Max allowed width (defaults to 1600px)
     * @param int $quality WebP quality 1-100 (defaults to 82 for visual lossless)
     * @return string Public URL path (e.g. '/storage/posts/xyz.webp')
     */
    public static function uploadAndOptimize(UploadedFile $file, string $folder, int $maxWidth = 1600, int $quality = 82): string
    {
        // If GD extension is available and file is not SVG, convert & compress to WebP
        if (extension_loaded('gd') && function_exists('imagewebp') && $file->getClientOriginalExtension() !== 'svg') {
            try {
                $imageContent = file_get_contents($file->getRealPath());
                $srcImage = @imagecreatefromstring($imageContent);

                if ($srcImage !== false) {
                    $origWidth = imagesx($srcImage);
                    $origHeight = imagesy($srcImage);

                    // Calculate new dimensions if original exceeds maxWidth
                    if ($origWidth > $maxWidth) {
                        $newWidth = $maxWidth;
                        $newHeight = (int) round(($origHeight / $origWidth) * $maxWidth);
                    } else {
                        $newWidth = $origWidth;
                        $newHeight = $origHeight;
                    }

                    // Create canvas with true color & transparency support
                    $destImage = imagecreatetruecolor($newWidth, $newHeight);
                    imagealphablending($destImage, false);
                    imagesavealpha($destImage, true);
                    $transparent = imagecolorallocatealpha($destImage, 255, 255, 255, 127);
                    imagefilledrectangle($destImage, 0, 0, $newWidth, $newHeight, $transparent);
                    imagealphablending($destImage, true);

                    // High-quality resampling
                    imagecopyresampled($destImage, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);

                    // Output to WebP buffer
                    ob_start();
                    imagewebp($destImage, null, $quality);
                    $webpData = ob_get_clean();

                    imagedestroy($srcImage);
                    imagedestroy($destImage);

                    if ($webpData && strlen($webpData) > 0) {
                        $filename = Str::random(40) . '.webp';
                        $path = $folder . '/' . $filename;
                        Storage::disk('public')->put($path, $webpData);

                        return '/storage/' . $path;
                    }
                }
            } catch (\Throwable $e) {
                // Fallback to standard upload if anything fails during GD processing
            }
        }

        // Standard fallback upload (e.g. for SVG or if GD is disabled)
        $path = $file->store($folder, 'public');
        return '/storage/' . $path;
    }
}
