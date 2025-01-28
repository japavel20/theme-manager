<?php
namespace ThemeManager;

class Theme
{
    /**
     * Get the active theme.
     *
     * @return string
     */
    public function getActiveTheme()
    {
        return config('theme.active', 'treezo'); // Default to 'treezo' if no active theme is set
    }

    /**
     * Get the fallback theme.
     *
     * @return string
     */
    public function getFallbackTheme()
    {
        return config('theme.fallback', 'default'); // Get the fallback theme from config
    }

    /**
     * Get the theme's CSS path.
     *
     * @return string
     */
    public function getCssFiles()
    {
        $theme = $this->getActiveTheme(); // Get the active theme
        $fallbackTheme = $this->getFallbackTheme(); // Get the fallback theme

        // Define the list of CSS files related to the active theme
        $cssFiles = [
            "themes/{$theme}/assets/css/sidebar-menu.css",
            "themes/{$theme}/assets/css/simplebar.css",
            "themes/{$theme}/assets/css/apexcharts.css",
            "themes/{$theme}/assets/css/prism.css",
            "themes/{$theme}/assets/css/rangeslider.css",
            "themes/{$theme}/assets/css/sweetalert.min.css",
            "themes/{$theme}/assets/css/quill.snow.css",
            "themes/{$theme}/assets/css/google-icon.css",
            "themes/{$theme}/assets/css/remixicon.css",
            "themes/{$theme}/assets/css/swiper-bundle.min.css",
            "themes/{$theme}/assets/css/fullcalendar.main.css",
            "themes/{$theme}/assets/css/style.css", // Main theme CSS
            "themes/{$theme}/assets/images/favicon.png", // Theme icon
        ];

        // Check if each file exists, and return the correct CSS file paths
        $validCssFiles = [];
        foreach ($cssFiles as $cssFile) {
            $filePath = public_path($cssFile);

            // Check if the CSS file exists for the active theme, fallback to the default theme if not
            if (file_exists($filePath)) {
                $validCssFiles[] = asset($cssFile);
            } else {
                // Fallback to the default theme if the file is not found for the active theme
                $fallbackFilePath = str_replace("themes/{$theme}", "themes/{$fallbackTheme}", $cssFile);
                $validCssFiles[] = asset($fallbackFilePath);
            }
        }

        return $validCssFiles; // Return the list of valid CSS files
    }

    /**
     * Get the theme's JS path.
     *
     * @return string
     */
    public function getJsFiles()
    {
        $theme = $this->getActiveTheme(); // Get the active theme
        $fallbackTheme = $this->getFallbackTheme(); // Get the fallback theme

        // Define the list of JS files related to the active theme
        $jsFiles = [
            "themes/{$theme}/assets/js/bootstrap.bundle.min.js",
            "themes/{$theme}/assets/js/sidebar-menu.js",
            "themes/{$theme}/assets/js/dragdrop.js",
            "themes/{$theme}/assets/js/rangeslider.min.js",
            "themes/{$theme}/assets/js/sweetalert.js",
            "themes/{$theme}/assets/js/quill.min.js",
            "themes/{$theme}/assets/js/data-table.js",
            "themes/{$theme}/assets/js/prism.js",
            "themes/{$theme}/assets/js/clipboard.min.js",
            "themes/{$theme}/assets/js/feather.min.js",
            "themes/{$theme}/assets/js/simplebar.min.js",
            "themes/{$theme}/assets/js/apexcharts.min.js",
            "themes/{$theme}/assets/js/swiper-bundle.min.js",
            "themes/{$theme}/assets/js/fullcalendar.main.js",
            "themes/{$theme}/assets/js/custom/apexcharts.js",
            "themes/{$theme}/assets/js/custom/custom.js",
        ];

        // Check if each file exists, and return the correct JS file paths
        $validJsFiles = [];
        foreach ($jsFiles as $jsFile) {
            $filePath = public_path($jsFile);

            // Check if the JS file exists for the active theme, fallback to the default theme if not
            if (file_exists($filePath)) {
                $validJsFiles[] = asset($jsFile);
            } else {
                // Fallback to the default theme if the file is not found for the active theme
                $fallbackFilePath = str_replace("themes/{$theme}", "themes/{$fallbackTheme}", $jsFile);
                $validJsFiles[] = asset($fallbackFilePath);
            }
        }

        return $validJsFiles; // Return the list of valid JS files
    }
}
