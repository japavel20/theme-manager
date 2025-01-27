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
    public function getCssPath()
    {
        $theme = $this->getActiveTheme();
        $fallbackTheme = $this->getFallbackTheme();

        // Ensure the CSS file exists for the active theme
        $cssPath = public_path("themes/{$theme}/assets/css/style.css");

        // Return active theme's CSS, fallback to default if not found
        return file_exists($cssPath) 
            ? asset("themes/{$theme}/assets/css/style.css") 
            : asset("themes/{$fallbackTheme}/assets/css/style.css");
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

