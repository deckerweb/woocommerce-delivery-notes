<?php

/**
 * Base class
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

		/**
		 * Constructor
		 *
		 * @since 1.0
		 */
		public function __construct() {
			$this->prefix = 'wcdn_';
			$this->plugin_basename = plugin_basename(dirname(dirname(__FILE__)));
			$this->plugin_basefile = $this->plugin_basename . '/' . $this->plugin_basename . '.php';
			$this->plugin_url = plugin_dir_url( $this->plugin_basefile );
			$this->plugin_path = plugin_dir_path( $this->plugin_basefile );

			if ( $this->is_woocommerce_activated() ) {
				add_action( 'init', array( $this, 'load_all_hooks' ) );
			}	
		}
		
		/**
		 * Load the hooks
		 *
		 * @since 1.0
		 */
		public function load_all_hooks() {				
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
	
	}
	
}

?>