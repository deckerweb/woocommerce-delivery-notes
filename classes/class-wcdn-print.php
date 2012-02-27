<?php

/**
 * Print class
 *
 * @since 1.0
 */
if ( !class_exists( 'WooCommerce_Delivery_Notes_Print' ) ) {

	class WooCommerce_Delivery_Notes_Print extends WooCommerce_Delivery_Notes {

		public $template_name;
		public $template_dir_name;
		public $template_dir_url;
		public $template_dir_path;
		public $template_base;
		public $template_base_in_theme;

		private $order;

		/**
		 * Constructor
		 *
		 * @since 1.0
		 */
		public function __construct() {
			parent::__construct();

			$this->template_name = 'print.php';
			$this->template_dir_name = 'delivery-notes/';
			$this->template_base = 'templates/';
			$this->template_base_in_theme = 'woocommerce/';
		}

		/**
		 * Read the template file
		 *
		 * @since 1.0
		 */
		public function get_template_content() {

			// Check for a custom template folder in the theme
			$is_custom_html = @file_exists( trailingslashit( get_stylesheet_directory() ) . $this->template_base_in_theme . $this->template_dir_name . $this->template_name);
			if ( $is_custom_html ) {
				$this->template_dir_url = trailingslashit( get_stylesheet_directory_uri() ) . $this->template_base_in_theme . $this->template_dir_name;
				$this->template_dir_path = trailingslashit( get_stylesheet_directory() ) . $this->template_base_in_theme . $this->template_dir_name;
			} else {
				$this->template_dir_url = $this->template_base . $this->template_dir_name;
				$this->template_dir_path = $this->template_base . $this->template_dir_name;
			}
			
			// Legacy support for old custom template folder structure
			$legacy_is_custom_html = @file_exists( trailingslashit( get_stylesheet_directory() ) . $this->template_base_in_theme . 'delivery-note-template/template.php' );
			if( $legacy_is_custom_html ) {
				$this->template_dir_url = trailingslashit( get_stylesheet_directory_uri() ) . $this->template_base_in_theme . 'delivery-note-template/';
				$this->template_dir_path = trailingslashit( get_stylesheet_directory() ) . $this->template_base_in_theme . 'delivery-note-template/';
				$this->template_name = 'template.php';
			}
			
			// Read the file
			ob_start();
			require_once $this->template_dir_path . $this->template_name;
			$content = ob_get_clean();

			return $content;
		}

		/**
		 * Get the current order
		 *
		 * @since 1.0
		 */
		public function get_order( $order_id ) {
			if ( !isset( $this->order ) && $order_id ) {
				$this->order = new woocommerce_order( $order_id );
			}
			return $this->order;
		}

		/**
		 * Get the current order items
		 *
		 * @since 1.0
		 * @version 1.1
		 */
		public function get_order_items( $order_id ) {

			global $woocommerce;
			global $_product;

			$order = $this->get_order( $order_id );
			$items = $order->get_items();
			$data_list = array();
		
			if ( sizeof( $items ) > 0 ) {
				foreach ( $items as $item ) {
					// Array with data for the printing template
					$data = array();
					
					// Create the product
					if ( isset( $item['variation_id'] ) && $item['variation_id'] > 0 ) {
						$product = new WC_Product_Variation( $item['variation_id'] );
						$data['variation'] = woocommerce_get_formatted_variation( $product->get_variation_attributes(), true );
					} else {
						$product = new WC_Product( $item['id'] );
						$data['variation'] = null;
					}
					
					// Set item name
					$data['name'] = $item['name'];
					
					// Set item quantity
					$data['quantity'] = $item['qty'];
					
					// Set item meta
					$meta = new order_item_meta( $item['item_meta'] );
					$data['meta'] = $meta->display(true, true);
					
					// Set item download url
					$data['download_url'] = null;
					if ( $product->exists && $product->is_downloadable() && $order->status == 'completed' ) {
						$data['download_url'] = $order->get_downloadable_file_url( $item['id'], $item['variation_id'] );
					}

					// Set the price
					$data['price'] = $order->get_formatted_line_subtotal($item);
					
					// Set the single price
					$data['single_price'] = $product->get_price();
									
					// Set item SKU
					$data['sku'] = $product->get_sku();
	
					// Set item weight
					$data['weight'] = $product->get_weight();
					
					// Set item dimensions
					$data['weight'] = $product->get_dimensions();
					
					$data_list[] = $data;
				}
			}

			return $data_list;
		}

		/**
		 * Get the content for an option
		 *
		 * @since 1.0
		 */
		public function get_setting( $name ) {
			return get_option( $this->prefix . $name );
		}
	
	}

}

?> 