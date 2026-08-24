<?php

use App\Models\Setting;

if (!function_exists('get_setting')) {
    /**
     * Helper to get site setting
     */
    function get_setting(string $key, mixed $default = null): mixed
    {
        return Setting::get($key, $default);
    }
}

if (!function_exists('format_file_size')) {
    /**
     * Helper to format bytes to human readable
     */
    function format_file_size($bytes): string
    {
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            return $bytes . ' bytes';
        } elseif ($bytes == 1) {
            return $bytes . ' byte';
        } else {
            return '0 bytes';
        }
    }
}

if (!function_exists('get_nav_menus')) {
    /**
     * Helper to get active navigation menus with hierarchical submenus
     */
    function get_nav_menus()
    {
        try {
            $menus = \App\Models\NavMenu::whereNull('parent_id')
                ->with(['children' => function ($q) {
                    $q->active()->ordered();
                }])
                ->active()
                ->ordered()
                ->get();

            if ($menus->isEmpty()) {
                $defaults = array_map(function ($m) {
                    $obj = (object)$m;
                    $obj->children = collect();
                    return $obj;
                }, \App\Models\NavMenu::getDefaultMenus());

                return collect($defaults);
            }
            return $menus;
        } catch (\Throwable $e) {
            return collect();
        }
    }
}
