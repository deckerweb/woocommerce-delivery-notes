<?php
/**
 * Main plugin file. This plugin adds simple Delivery Notes for the WooCommerce Shop Plugin. You can add company/shop info as well as personal notes and policies to the print page.
 *
 * @package   WooCommerce Delivery Notes
 * @author    David Decker
 * @link      http://twitter.com/#!/deckerweb
 * @copyright Copyright 2011-2012, David Decker - DECKERWEB
 *
 * @credits Inspired and based on the plugin "Jigoshop Delivery Notes" by Steve Clark, Trigvvy Gunderson and PiffPaffPuff
 * @link http://www.clark-studios.co.uk/blog/
 * @link https://github.com/piffpaffpuff
 *
 * Plugin Name: WooCommerce Delivery Notes
 * Plugin URI: http://genesisthemes.de/en/wp-plugins/woocommerce-delivery-notes/
 * Description: This plugin adds simple Delivery Notes for the WooCommerce Shop Plugin. You can add company/shop info as well as personal notes and policies to the print page.
 * Version: 1.1
 * Author: David Decker - DECKERWEB
 * Author URI: http://deckerweb.de/
 * License: GPLv3
 * Text Domain: woocommerce-delivery-notes
 * Domain Path: /languages/
 */

/**
 * Setting constants
 *
 * @since 1.0
 */
define( 'WCDN_PLUGIN_DIR', dirname( __FILE__ ) );
define( 'WCDN_PLUGIN_BASEDIR', dirname( plugin_basename( __FILE__ ) ) );


add_action( 'init', 'ddw_wcdn_init' );
/**
 * Load the text domain for translation of the plugin
 * 
 * @since 1.0
 * @version 1.1
 */
function ddw_wcdn_init() {

	load_plugin_textdomain( 'woocommerce-delivery-notes', false, WCDN_PLUGIN_BASEDIR . '/languages' );
}


add_filter( 'plugin_action_links_' . plugin_basename(__FILE__) , 'ddw_wcdn_settings_link' );
/**
 * Add "Settings" link to plugin page
 *
 * @since 1.0
 *
 * @param  $links
 * @param  $ddw_wcdn_settings_link
 * @return string settings link
 */
function ddw_wcdn_settings_link( $links ) {

	$ddw_wcdn_settings_link = sprintf( '<a href="%s" title="%s">%s</a>' , admin_url( 'admin.php?page=woocommerce_delivery_notes' ) , __( 'Go to the settings page', 'woocommerce-delivery-notes' ) , __( 'Settings', 'woocommerce-delivery-notes' ) );
	
	array_unshift( $links, $ddw_wcdn_settings_link );

	return $links;

}


/**
 * Load admin help tabs and support links on plugins listing page
 * 
 * @since 1.0
 */
require_once 'wcdn-help.php';


/**
 * Load the main plugin classes and functions
 * 
 * @since 1.0
 */
require_once 'wcdn-classes.php';


/**
 * Create an admin instance
 * 
 * @since 1.0
 */
$wcdn_admin = new WooCommerce_Delivery_Notes_Admin();
