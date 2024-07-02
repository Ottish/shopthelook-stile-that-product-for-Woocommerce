<?php
/*
Plugin Name: ShopTheLook - Style It for WooCommerce
Description:  Shop The Look Stile it is a plugin to create and manage product looks for WooCommerce.
Version: 1.0.0
Author: SHOPTHELOOK SRL
*/
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Include necessary files
include_once('includes/class-shop-the-look-style-it.php');

// Initialize the plugin
function initialize_shop_the_look_style_it() {
    new Shop_The_Look_Style_It();
}
add_action('plugins_loaded', 'initialize_shop_the_look_style_it');
?>
