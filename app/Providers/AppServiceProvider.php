<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

if (!function_exists('has_valid_document')) {
    function has_valid_document($file_path) {
        if (!$file_path || !is_string($file_path)) {
            return false;
        }

        $clean = trim($file_path);
        if ($clean === '' || $clean === '#' || $clean === '-' || in_array(strtolower($clean), ['null', 'tidak ada', 'tanpa preview', 'n/a', 'none', 'undefined', 'javascript:void(0)', '#!'])) {
            return false;
        }

        // Web URLs (Google Drive, Cloud links, etc.)
        if (str_starts_with($clean, 'http://') || str_starts_with($clean, 'https://')) {
            return true;
        }

        // Must have a valid document / media file extension
        $parsedUrl = parse_url($clean);
        $cleanPath = $parsedUrl['path'] ?? $clean;
        $extension = strtolower(pathinfo($cleanPath, PATHINFO_EXTENSION));
        
        $validExtensions = [
            'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 
            'jpg', 'jpeg', 'png', 'webp', 'gif', 'zip', 'rar', 'csv'
        ];

        return in_array($extension, $validExtensions);
    }
}

if (!function_exists('is_previewable')) {
    function is_previewable($file_path) {
        if (!has_valid_document($file_path)) {
            return false;
        }
        
        // Check if Google Drive/Docs link
        if (str_contains($file_path, 'drive.google.com') || str_contains($file_path, 'docs.google.com')) {
            return true;
        }

        // Parse path to ignore query parameters
        $parsedUrl = parse_url($file_path);
        $path = $parsedUrl['path'] ?? $file_path;
        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        
        $previewableExtensions = [
            'pdf', 'jpg', 'jpeg', 'png', 'webp', 'gif',
            'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'
        ];
        
        return in_array($extension, $previewableExtensions);
    }
}

