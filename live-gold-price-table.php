<?php
/**
*  @package LiveGoldPriceTablePlugin
*/

/*
*  Plugin Name: Live Gold Price Table
*  Description: Display live price of Gold, Silver, and Platinum
*  Version: 1.0
*  Author: auronum
*  Author URI: https://auronum.co.uk
*  License: GPLv2
*  Text Domain: live-gold-price-table
*/

if( !defined('ABSPATH') ) {
    header("Location: /");
    die("");
}

function goldPrice_shortcode($atts) {
    // Default attributes
    $default_atts = array(
        'theme' => 'brand' // Default theme is 'brand'
    );

    // Merge default attributes with user-defined attributes
    $atts = shortcode_atts($default_atts, $atts);

    // Sanitize attributes
    $theme = esc_attr($atts['theme']);

    // Set fixed values for height, width, and src
    $height = '170px';
    $width = '300px';
    $src = 'https://gpl.auronum.co.uk/';

    // Adjust src URL based on theme
    if ($theme === 'dark' || $theme === 'light') {
        $src .= '?theme=' . $theme;
    }

    // Output HTML embed
    $output = '<embed src="' . $src . '" type="text/html" height="' . $height . '" width="' . $width . '" rel="noopener" />';
    
    return $output;
}
add_shortcode('live_gold', 'goldPrice_shortcode');

// Add a menu item in the WordPress dashboard
function add_gold_price_menu_item() {
    add_menu_page(
        'Live Gold Price', // Page title
        'Live Gold Price', // Menu title
        'manage_options', // Capability required
        'live-gold-price-settings', // Menu slug
        'gold_price_settings_page', // Callback function to display the settings page
        'dashicons-chart-line', // Icon URL
        30 // Menu position
    );
}
add_action('admin_menu', 'add_gold_price_menu_item');

// Callback function to display the settings page
function gold_price_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php echo esc_html__('Welcome to Live Gold Price Guide', 'live-gold-price-table'); ?></h1>
        <p><?php echo esc_html__('Thank you for choosing Live Gold Price to display live prices of Gold, Silver, and Platinum on your WordPress site.', 'live-gold-price-table'); ?></p>

        <h2><?php echo esc_html__('How to Use', 'live-gold-price-table'); ?></h2>
        <p><?php echo esc_html__('To display the live gold price table, simply use the shortcode [live_gold] in your posts, pages, or widgets.', 'live-gold-price-table'); ?></p>

        <h2><?php echo esc_html__('Customization', 'live-gold-price-table'); ?></h2>
        <p><?php echo esc_html__('You can customize the appearance of the price table by specifying a theme. The default theme is "brand", and additional themes available are "dark" and "light". To specify a theme, use the attribute "theme" in the shortcode. For example: [live_gold theme="dark"]', 'live-gold-price-table'); ?></p>

        <p><?php echo esc_html__('For technical support, please contact us at', 'live-gold-price-table'); ?> <a href="mailto:support@auronum.co.uk">support@auronum.co.uk</a>.</p>

        <p><?php echo esc_html__('Visit our website at', 'live-gold-price-table'); ?> <a href="https://auronum.co.uk" target="_blank">auronum.co.uk</a>.</p>

        <p><strong><?php echo esc_html__('Thank you for using Live Gold Price!', 'live-gold-price-table'); ?></strong></p>
    </div>

    <style>
        .wrap {
            margin: 20px;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        h1 {
            color: #c89d58; /* Your brand color */
        }

        p {
            margin-bottom: 15px;
        }

        a {
            color: #0073aa;
        }
    </style>
    <?php
}

