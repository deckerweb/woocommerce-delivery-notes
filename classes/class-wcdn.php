<?php

/**
 * Delivery notes class
 *
 * @since 1.0
 */
if ( !class_exists( 'WooCommerce_Delivery_Notes' ) ) {

	class WooCommerce_Delivery_Notes {
	
		public $prefix;
		public $plugin_url;
		public $plugin_path;
		public $plugin_basename;
		public $plugin_basefile;
		
		public $print;
		public $settings;
		public $writepanel;
		
		/**
		 * Constructor
		 *
		 * @since 1.0
		 */
		public function __construct() {
			// Defaults
			$this->prefix = 'wcdn_';
			$this->plugin_basename = plugin_basename(dirname(dirname(__FILE__)));
			$this->plugin_basefile = $this->plugin_basename . '/' . $this->plugin_basename . '.php';
			$this->plugin_url = plugin_dir_url( $this->plugin_basefile );
			$this->plugin_path = plugin_dir_path( $this->plugin_basefile );
				
			// Load the plugin when woocommerce is activated
			if ( $this->is_woocommerce_activated() ) {
				// Include the classes
				$this->includes();
				
				// Instances
				//$this->writepanel = new WooCommerce_Delivery_Notes_Writepanel();
				//$this->settings = new WooCommerce_Delivery_Notes_Settings();

				// Hooks
				add_action( 'init', array( $this, 'load_hooks' ) );
			}
		}
		
		/**
		 * Load the main plugin classes and functions
		 * 
		 * @since 1.0
		 */
		public function includes() {				
			require_once 'class-wcdn-base.php';
			require_once 'class-wcdn-writepanel.php';
			require_once 'class-wcdn-settings.php';
		}
		
		/**
		 * Load the hooks
		 *
		 * @since 1.0
		 */
		public function load_hooks() {				
			load_plugin_textdomain( 'woocommerce-delivery-notes', false, $this->plugin_basename . '/languages' );
		}
		
		/**
		 * Check if woocommerce is activated
		 *
		 * @since 1.0
		 */
		public function is_woocommerce_activated() {
			if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
				return true;
			} else {
				return false;
			}
		}
		
		/**
		 * Get the prefix
		 *
		 * @since 1.0
		 */
		public static function get_prefix() {
			return $this->prefix;
		}
	}

}