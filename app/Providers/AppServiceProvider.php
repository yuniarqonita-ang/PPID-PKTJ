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

if (!function_exists('is_previewable')) {
    function is_previewable($file_path) {
        if (!$file_path || $file_path === '#' || $file_path === '') {
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

