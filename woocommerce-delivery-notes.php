<?php
/**
 * This plugin adds simple Delivery Notes for the WooCommerce Shop Plugin. You can add company/shop info as well as personal notes and policies to the print page.
 *
 * @package   WooCommerce Delivery Notes
 * @link      http://twitter.com/#!/deckerweb
 * @copyright Copyright 2011 Steve Clark, Trigvvy Gunderson, David Decker - DECKERWEB
 *
 * @credits Inspired and based on the plugin "Jigoshop Delivery Notes" by Steve Clark and Trigvvy Gunderson
 * @link http://www.clark-studios.co.uk/blog/
 * @link https://github.com/piffpaffpuff
 *
 * Plugin Name: WooCommerce Delivery Notes
 * Plugin URI: http://genesisthemes.de/en/wp-plugins/woocommerce-delivery-notes/
 * Description: This plugin adds simple Delivery Notes for the WooCommerce Shop Plugin. You can add company/shop info as well as personal notes and policies to the print page.
 * Version: 1.1
 * Author: Steve Clark, Triggvy Gunderson, David Decker
 * Author URI: http://deckerweb.de/
 * License: GPLv3
 * Text Domain: woocommerce-delivery-notes
 * Domain Path: /languages/
 *
 * Copyright 2011-2012 Steve Clark, Trigvvy Gunderson, David Decker - DECKERWEB
		
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
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
