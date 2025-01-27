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
    public function getJsPath()
    {
        $theme = $this->getActiveTheme();
        $fallbackTheme = $this->getFallbackTheme();

        // Ensure the JS file exists for the active theme
        $jsPath = public_path("themes/{$theme}/assets/js/custom/custom.js");

        // Return active theme's JS, fallback to default if not found
        return file_exists($jsPath) 
            ? asset("themes/{$theme}/assets/js/custom/custom.js") 
            : asset("themes/{$fallbackTheme}/assets/js/custom/custom.js");
    }
}

