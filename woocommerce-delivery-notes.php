<?php
/**
 * Main plugin file. This plugin adds simple Delivery Notes for the WooCommerce Shop Plugin. You can add company/shop info as well as personal notes and policies to the print page.
 *
 * @package   WooCommerce Delivery Notes
 * @author    David Decker
 * @link      http://twitter.com/#!/deckerweb
 * @copyright Copyright 2011-2012, David Decker - DECKERWEB
 *
 * @credits Inspired and based on the plugin "Jigoshop Delivery Notes" by Steve Clark and Trigvvy Gunderson
 * @link http://www.clark-studios.co.uk/blog/
 * @link https://github.com/piffpaffpuff
 *
 * Plugin Name: WooCommerce Delivery Notes
 * Plugin URI: http://wordpress.org/extend/plugins/woocommerce-delivery-notes/
 * Description: This plugin adds simple Delivery Notes for the WooCommerce Shop Plugin. You can add company/shop info as well as personal notes and policies to the print page.
 * Version: 1.1.1
 * Author: David Decker, Triggvy Gunderson, Steve Clark
 * Author URI: http://deckerweb.de/
 * License: GPLv3
 * Text Domain: woocommerce-delivery-notes
 * Domain Path: /languages/
 */


/**
 * Load the main plugin classes and functions
 * 
 * @since 1.0
 */
require_once 'classes/class-wcdn-base.php';
require_once 'classes/class-wcdn-writepanel.php';
require_once 'classes/class-wcdn-settings.php';

/**
 * Create a writepanel instance
 * 
 * @since 1.0
 */
$wcdn_writepanel = new WooCommerce_Delivery_Notes_Writepanel();

/**
 * Create a settings instance
 * 
 * @since 1.0
 */
$wcdn_settings = new WooCommerce_Delivery_Notes_Settings();
