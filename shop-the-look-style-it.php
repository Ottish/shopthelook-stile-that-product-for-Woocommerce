<?php
/*
Plugin Name: ShopTheLook - Style It for WooCommerce
Description:  Shop The Look Stile it is a plugin to create and manage product looks for WooCommerce.
Version: 1.0.1
Author: SHOPTHELOOK SRL
*/


if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Include necessary files
include_once(plugin_dir_path(__FILE__) . 'includes/class-shop-the-look-style-it.php');

// Initialize the plugin
function initialize_shop_the_look_style_it() {
    new Shop_The_Look_Style_It();
}
add_action('plugins_loaded', 'initialize_shop_the_look_style_it');

// Add a link to the Shopthelook website
function shop_the_look_style_it_plugin_action_links($links) {
    $b2b_link = '<a href="https://b2b.shopthelook.it" target="_blank">Visit B2B Site</a>';
    array_unshift($links, $b2b_link);
    return $links;
}
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'shop_the_look_style_it_plugin_action_links');
?>
