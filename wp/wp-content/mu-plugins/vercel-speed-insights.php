<?php
/**
 * Plugin Name: Vercel Speed Insights
 * Plugin URI: https://vercel.com/docs/speed-insights
 * Description: Adds Vercel Speed Insights tracking to your WordPress site
 * Version: 1.0.0
 * Author: Vercel
 * License: Apache-2.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add Vercel Speed Insights script to wp_head
 */
function vercel_speed_insights_inject_script() {
    // Determine the environment
    $is_development = defined('WP_DEBUG') && WP_DEBUG;
    
    // Set script source based on environment
    if ($is_development) {
        $script_src = 'https://va.vercel-scripts.com/v1/speed-insights/script.debug.js';
    } else {
        $script_src = 'https://va.vercel-scripts.com/v1/speed-insights/script.js';
    }
    
    ?>
    <script>
        window.si = window.si || function () {
            (window.siq = window.siq || []).push(arguments);
        };
    </script>
    <script defer src="<?php echo esc_url($script_src); ?>" data-sdk-v="2.0.0" data-sdk-n="@vercel/speed-insights"></script>
    <?php
}

// Hook into wp_head to inject the Speed Insights script
add_action('wp_head', 'vercel_speed_insights_inject_script', 1);
