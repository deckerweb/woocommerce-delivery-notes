<?php
/**
 * All core plugin classes.
 *
 * @package   WooCommerce Delivery Notes
 * @author    David Decker - DECKERWEB
 * @copyright Copyright 2011-2012, David Decker - DECKERWEB
 * @license   http://www.opensource.org/licenses/gpl-license.php GPL v3.0 (or later)
 * @link      http://genesisthemes.de/en/wp-plugins/woocommerce-delivery-notes/
 * @link      http://twitter.com/#!/deckerweb
 *
 * @since 1.0
 */

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

		/**
		 * Constructor
		 *
		 * @since 1.0
		 */
		public function WooCommerce_Delivery_Notes() {
			$this->prefix = 'wcdn_';
			$this->plugin_url = plugin_dir_url( __FILE__ );
			$this->plugin_path = plugin_dir_path( __FILE__ );
		}

	}  // enf of class WooCommerce_Delivery_Notes

}  // enf of conditional


/**
 * Admin class
 *
 * @since 1.0
 */
if ( !class_exists( 'WooCommerce_Delivery_Notes_Admin' ) ) {

	class WooCommerce_Delivery_Notes_Admin extends WooCommerce_Delivery_Notes {

		/**
		 * Constructor
		 *
		 * @since 1.0
		 */
		public function WooCommerce_Delivery_Notes_Admin() {
			parent::WooCommerce_Delivery_Notes();

			// Load the plugin when WooCommerce is enabled
			if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
				add_action( 'init', array( $this, 'load_all_hooks' ) );
			}
		}

		/**
		 * Load the admin hooks
		 *
		 * @since 1.0
		 */
		public function load_all_hooks() {	

			add_action( 'admin_print_styles', array( $this, 'add_styles' ) );
			add_action( 'admin_print_scripts', array( $this, 'add_scripts' ) );
			add_action( 'add_meta_boxes', array( $this, 'add_box' ) );
			add_action( 'admin_menu', array( $this, 'add_menu' ) );
		}

		/**
		 * Add the styles
		 *
		 * @since 1.0
		 */
		public function add_styles() {
			wp_enqueue_style( 'thickbox' );
		}

		/**
		 * Add the scripts
		 *
		 * @since 1.0
		 */
		public function add_scripts() {
			wp_enqueue_script( 'media-upload' );
			wp_enqueue_script( 'thickbox' );
		}

		/**
		 * Add the meta box on the single order page
		 *
		 * @since 1.0
		 */
		public function add_box() {
			add_meta_box( 'woocommerce-delivery-notes-box', __( 'Delivery Note', 'woocommerce-delivery-notes' ), array( $this, 'create_box_content' ), 'shop_order', 'side', 'default' );
		}

		/**
		 * Create the meta box content on the single order page
		 *
		 * @since 1.0
		 */
		public function create_box_content() {
			global $post_id;

			?>
			<table class="form-table">
				<tr>
					<td><a href="<?php echo $this->plugin_url; ?>wcdn-print.php?order=<?php echo $post_id; ?>" id="print_delivery_note" class="button button-primary" target="_blank"><?php _e( 'View &amp; Print Delivery Note', 'woocommerce-delivery-notes' ); ?></a></td>
				</tr>
			</table>
			<?php
		}

		/**
		 * Add the sub menu entry for the WooCommerce admin page menu
		 *
		 * @since 1.0
		 */
		public function add_menu() {

			// Pagehook for settings page
			global $_wcdn_settings_pagehook;

			// Register settings page menu
			$_wcdn_settings_pagehook = add_submenu_page( 'woocommerce', __( 'Delivery Notes Settings', 'woocommerce-delivery-notes' ), __( 'Delivery Notes Settings', 'woocommerce-delivery-notes' ), 'manage_woocommerce', 'woocommerce_delivery_notes', array($this, 'ddw_wcdn_settings_page' ) );
		}

		/**
		 * Create the settings page content
		 *
		 * @since 1.0
		 * @version 1.1
		 */
		public function ddw_wcdn_settings_page() {

			// Check the user capabilities
			if ( !current_user_can( 'manage_woocommerce' ) ) {
				wp_die( __( 'You do not have sufficient permissions to access this page.', 'woocommerce-delivery-notes' ) );
			}

			// Save the field values
			$fields_submitted = $this->prefix . 'fields_submitted';
			if ( isset( $_POST[ $fields_submitted ] ) && $_POST[ $fields_submitted ] == 'submitted' ) {
				foreach ( $_POST as $key => $value ) {
					if ( get_option( $key ) != $value ) {
						update_option( $key, $value );
					}
					else {
						add_option( $key, $value, '', 'no' );
					}
				}

				?><div id="setting-error-settings_updated" class="updated settings-error">
				<p><strong><?php _e( 'Settings saved.', 'woocommerce-delivery-notes' ); ?></strong></p>
			</div><?php
			}

			// Show page content and settings fields
			?>
			<div class="wrap">
				<div id="icon-options-general" class="icon32">
					<br />
				</div>
				<h2><?php _e( 'WooCommerce - Delivery Notes Settings', 'woocommerce-delivery-notes' ); ?></h2>

				<p><?php _e( 'All setting fields below are optional - you can leave them empty to not use them at all or only apply what you need.', 'woocommerce-delivery-notes' ); ?></p>

				<form method="post" action="">
					<input type="hidden" name="<?php echo $fields_submitted; ?>" value="submitted">

					<table class="form-table">
						<tbody>
							<tr>
								<th>
									<label for="<?php echo $this->prefix; ?>custom_company_name"><b><?php _e( 'Company/Shop Name:', 'woocommerce-delivery-notes' ); ?></b></label>
								</th>
								<td>
									<textarea name="<?php echo $this->prefix; ?>custom_company_name" rows="1" class="large-text"><?php echo wp_kses_stripslashes( get_option( $this->prefix . 'custom_company_name' ) ); ?></textarea>
									<span class="description"><?php
										echo __( 'Your custom company or shop name for the Delivery Note.', 'woocommerce-delivery-notes' );
										echo '<br /><strong>' . __( 'Note:', 'woocommerce-delivery-notes' ) . '</strong> ';
										echo __( 'Leave blank to use your default Website/ Blog title defined in WordPress settings.', 'woocommerce-delivery-notes' );
									?></span>
								</td>
							</tr>
							<tr>
								<th>
									<label for="<?php echo $this->prefix; ?>company_address"><b><?php _e( 'Company/Shop Address:', 'woocommerce-delivery-notes' ); ?></b></label>
								</th>
								<td>
									<textarea name="<?php echo $this->prefix; ?>company_address" rows="6" class="large-text"><?php echo wp_kses_stripslashes( get_option( $this->prefix . 'company_address' ) ); ?></textarea>
									<span class="description"><?php
										echo __( 'The postal address of the company/shop, which gets printed right of the company/shop name, above the order listings.', 'woocommerce-delivery-notes' );
										echo '<br /><strong>' . __( 'Note:', 'woocommerce-delivery-notes' ) . '</strong> ';
										echo __( 'Here, you can also add some other contact information like the telephone and email.', 'woocommerce-delivery-notes' );
									?></span>
								</td>
							</tr>
							<tr>
								<th>
									<label for="<?php echo $this->prefix; ?>personal_notes"><b><?php _e( 'Personal Notes:', 'woocommerce-delivery-notes' ); ?></b></label>
								</th>
								<td>
									<textarea name="<?php echo $this->prefix; ?>personal_notes" rows="3" class="large-text"><?php echo wp_kses_stripslashes( get_option( $this->prefix . 'personal_notes' ) ); ?></textarea>
									<span class="description"><?php
										echo __( 'Add some personal notes, or season greetings or whatever (e.g. Thank You for Your Order!, Merry Christmas!, etc.).', 'woocommerce-delivery-notes' );
										echo '<br /><strong>' . __( 'Note:', 'woocommerce-delivery-notes' ) . '</strong> ';
										echo __( 'This info gets printed below the order listings but above the regular shipping notes (added at WooCommerce single order pages). These personal notes here will get styled with bigger font size.', 'woocommerce-delivery-notes' );
									?></span>
								</td>
							</tr>
							<tr>
								<th>
									<label for="<?php echo $this->prefix; ?>policies_conditions"><b><?php _e( 'Returns Policy, Conditions, etc.:', 'woocommerce-delivery-notes' ); ?></b></label>
								</th>
								<td>
									<textarea name="<?php echo $this->prefix; ?>policies_conditions" rows="6" class="large-text"><?php echo wp_kses_stripslashes( get_option( $this->prefix . 'policies_conditions' ) ); ?></textarea>
									<span class="description"><?php
										echo __( 'Here you can add some more policies, conditions etc. For example add a returns policy in case the client would like to send back some goods.', 'woocommerce-delivery-notes' );
										echo '<br /><strong>' . __( 'Note:', 'woocommerce-delivery-notes' ) . '</strong> ';
										echo __( 'In some countries (e.g. in the European Union) this is required so please add any required info in accordance with the statutory regulations.', 'woocommerce-delivery-notes' );
									?></span>
								</td>
							</tr>
							<tr>
								<th>
									<label for="<?php echo $this->prefix; ?>footer_imprint"><b><?php _e( 'Footer Imprint:', 'woocommerce-delivery-notes' ); ?></b></label>
								</th>
								<td>
									<textarea name="<?php echo $this->prefix; ?>footer_imprint" rows="2" class="large-text"><?php echo wp_kses_stripslashes( get_option( $this->prefix . 'footer_imprint' ) ); ?></textarea>
									<span class="description"><?php
										echo __( 'Add some further footer imprint, copyright notes etc. to get the printed sheets a bit more branded to your needs.', 'woocommerce-delivery-notes' );
										echo '<br /><strong>' . __( 'Note:', 'woocommerce-delivery-notes' ) . '</strong> ';
										echo __(' This footer info gets printed in lower font size and a bit lighter text color.', 'woocommerce-delivery-notes' );
										?></span>
								</td>
							</tr>
						</tbody>
					</table>

					<p class="submit">
						<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'woocommerce-delivery-notes' ); ?>" />
					</p>
				</form>
			</div><!-- .wrap -->
			<?php

		}  // end of function ddw_wcdn_settings_page

	}  // end of class WooCommerce_Delivery_Notes_Admin

}  // end of conditional


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

		private $order;

		/**
		 * Constructor
		 *
		 * @since 1.0
		 */
		public function WooCommerce_Delivery_Notes_Print() {
			parent::WooCommerce_Delivery_Notes();

			$this->template_name = 'template.php';
			$this->template_dir_name = 'delivery-note-template/';
			$this->template_dir_url = $this->plugin_url . $this->template_dir_name;
			$this->template_dir_path = $this->plugin_path . $this->template_dir_name;
		}

		/**
		 * Read the template file
		 *
		 * @since 1.0
		 */
		public function get_template_content() {

			// Check for a custom template folder in the theme
			$is_custom_html = @file_exists( trailingslashit( get_stylesheet_directory() ) . 'woocommerce/' . $this->template_dir_name . $this->template_name);
			if ( $is_custom_html ) {
				$this->template_dir_url = trailingslashit( get_stylesheet_directory_uri() ) . 'woocommerce/' . $this->template_dir_name;
				$this->template_dir_path = trailingslashit( get_stylesheet_directory() ) . 'woocommerce/' . $this->template_dir_name;

			}  // end-if

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
		 *
		 * @global $woocommerce
		 * @global $_product
		 */
		public function get_order_items( $order_id ) {

			global $woocommerce;
			global $_product;

			$order = $this->get_order( $order_id );
			$items = $order->get_items();
			$data_list = array();
		
			foreach ( $items as $item ) {

				// Get product item data
				$product = $order->get_product_from_item( $item );

				// Helper code: Get product price - line total
				$pricehelp = $order->get_line_total( $item );

				// Helper code: Calculate single product price
				$singlepricehelp = ( $pricehelp / $item['qty'] );

				// Array: Get array with data for printing template
				$data = array();

				// Get item name
				$data['name'] = $item['name'];

				// Check for item variation
				$data['variation'] = null;

				// Get item quantity
				$data['quantity'] = ( $pricehelp / $singlepricehelp );

				// Get item price
				$data['price'] = woocommerce_price( $pricehelp / $item['qty'], array( 'ex_tax_label' => 1 ) );

				// Get item tax rate
				$data['taxrate'] = $item['taxrate'];

				// Get item SKU
				$data['sku'] = $product->sku;

				// Get item weight
				$data['weight'] = $product->weight;

				// Check for item variations
				if ( isset( $item['variation_id'] ) && $item['variation_id'] > 0 ) {
					$product = new woocommerce_product_variation( $item['variation_id'] );
					$data['variation'] = woocommerce_get_formatted_variation( $product->get_variation_attributes(), true );
				}

				$data_list[] = $data;
			}

			return $data_list;
		}

		/**
		 * Get the content for an option
		 *
		 * @since 1.0
		 *
		 * @return option
		 */
		public function get_setting( $name ) {
			return get_option( $this->prefix . $name );
		}

	}  // enf of class WooCommerce_Delivery_Notes_Print

}  // enf of conditional
