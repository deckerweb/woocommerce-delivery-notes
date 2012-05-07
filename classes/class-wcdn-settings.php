<?php

/**
 * Settings class
 *
 * @since 1.0
 */
if ( ! class_exists( 'WooCommerce_Delivery_Notes_Settings' ) ) {

	class WooCommerce_Delivery_Notes_Settings {
	
		private $tab_name;
		private $hidden_submit;
		
		/**
		 * Constructor
		 *
		 * @since 1.0
		 */
		public function __construct() {			
			$this->tab_name = 'delivery-notes';
			$this->hidden_submit = WooCommerce_Delivery_Notes::$plugin_prefix . 'submit';
		}

		/**
		 * Load the class
		 *
		 * @since 1.0
		 */
		public function load() {
			add_action( 'admin_init', array( $this, 'load_hooks' ) );
		}

		/**
		 * Load the admin hooks
		 *
		 * @since 1.0
		 */
		public function load_hooks() {	
			add_filter( 'plugin_action_links_' . WooCommerce_Delivery_Notes::$plugin_basefile, array( $this, 'add_settings_link') );
			add_filter( 'woocommerce_settings_tabs_array', array( $this, 'add_settings_tab' ) );
			add_action( 'woocommerce_settings_tabs_' . $this->tab_name, array( $this, 'create_settings_page' ) );
			add_action( 'woocommerce_update_options_' . $this->tab_name, array( $this, 'save_settings_page' ) );
			add_action( 'admin_init', array( $this, 'load_help' ), 20 );
		}
		
		/**
		 * Add "Settings" link to plugin page
		 *
		 * @since 1.0
		 */
		public function add_settings_link( $links ) {
			$settings = sprintf( '<a href="%s" title="%s">%s</a>' , admin_url( 'admin.php?page=woocommerce&tab=delivery-notes' ) , __( 'Go to the settings page', 'woocommerce-delivery-notes' ) , __( 'Settings', 'woocommerce-delivery-notes' ) );
			array_unshift( $links, $settings );
		
			return $links;	
		}
		
		/**
		 * Load the help system
		 *
		 * @since 1.0
		 */
		public function load_help() {
			// Get the hookname and load the help tabs
			if ( isset($_GET['page']) && isset( $_GET['tab'] ) && $_GET['tab'] == $this->tab_name ) {
				$menu_slug = plugin_basename( $_GET['page'] );
				$hookname = get_plugin_page_hookname( $menu_slug, '' );
		
				add_action( 'load-' . $hookname, array( $this, 'add_help_tabs' ) );
			}
		}
		
		/**
		 * Add the help tabs
		 *
		 * @since 1.0
		 */
		public function add_help_tabs() {
			// Check current admin screen
			$screen = get_current_screen();
		
			// Don't load help tab system prior WordPress 3.3
			if ( ! class_exists( 'WP_Screen' ) || ! $screen ) {
				return;
			}
		
			// Remove all existing tabs
			$screen->remove_help_tabs();
			
			// Create arrays with help tab titles
			$screen->add_help_tab(array(
				'id' => 'wcdn-usage',
				'title' => __( 'About the Plugin', 'woocommerce-delivery-notes' ),
				'content' => 
					'<h3>' . __( 'Plugin: WooCommerce Print Invoices & Delivery Notes', 'woocommerce-delivery-notes' ) . '</h3>' .
					'<h4>' . __( 'About the Plugin', 'woocommerce-delivery-notes' ) . '</h4>' .
					'<p>' . __( 'This plugin enables you to add a Invoice or simple Delivery Note page for printing for your orders in WooCommerce shop plugin. You can add your company postal address, further add personal notes, refund or other policies and a footer note/branding. This helps speed up your daily shop and order management. In some countries (e.g. in the European Union) it is also required to advice the customer with proper refund policies so this little plugin might help you a bit with that too.', 'woocommerce-delivery-notes' ) . '</p>' .
					'<p>' . sprintf( __( 'Just look under <a href="%1$s">WooCommerce > Orders</a> and there go to a single order view. On the right side you will see the Order Print meta box. Click one of the buttons and you get the invoice or delivery note printing page. Yes, it is that easy :-).', 'woocommerce-delivery-notes' ), admin_url( 'edit.php?post_type=shop_order' ) ) . '</p>'
			) );

			// Create help sidebar
			$screen->set_help_sidebar(
				'<p><strong>' . __( 'For more information:', 'woocommerce-delivery-notes' ) . '</strong></p>'.
				'<p><a href="http://wordpress.org/extend/plugins/woocommerce-delivery-notes/faq/" target="_blank">' . __( 'Frequently Asked Questions', 'woocommerce-delivery-notes' ) . '</a></p>' .
				'<p><a href="http://wordpress.org/extend/plugins/woocommerce-delivery-notes/" target="_blank">' . __( 'Project on WordPress.org', 'woocommerce-delivery-notes' ) . '</a></p>' .
				'<p><a href="https://github.com/deckerweb/woocommerce-delivery-notes" target="_blank">' . __( 'Project on GitHub', 'woocommerce-delivery-notes' ) . '</a></p>' . 
				'<p><a href="http://wordpress.org/tags/woocommerce-delivery-notes?forum_id=10" target="_blank">' . __( 'Discuss in the Forum', 'woocommerce-delivery-notes' ) . '</a></p>'
			);
		}
		
		/**
		 * Add a tab to the settings page
		 *
		 * @since 1.0
		 */
		public function add_settings_tab($tabs) {
			$tabs[$this->tab_name] = __( 'Print', 'woocommerce-delivery-notes' );
			
			return $tabs;
		}

		/**
		 * Create the settings page content
		 *
		 * @since 1.0
		 * @version 1.1
		 */
		public function create_settings_page() {
			?>
			<h3><?php _e( 'Invoices and Delivery Notes', 'woocommerce-delivery-notes' ); ?></h3>
			<table class="form-table">
				<tbody>
					<tr>
						<th>
							<label for="<?php echo WooCommerce_Delivery_Notes::$plugin_prefix; ?>company_logo"><?php _e( 'Company/Shop Logo', 'woocommerce-delivery-notes' ); ?></label>
						</th>
						<td>
							<input type="text" name="<?php echo WooCommerce_Delivery_Notes::$plugin_prefix; ?>company_logo" rows="2" class="regular-text" value="<?php echo get_option( WooCommerce_Delivery_Notes::$plugin_prefix . 'company_logo' ); ?>" />
							<span class="description">
								<?php _e( 'A company/shop logo representing your business.', 'woocommerce-delivery-notes' ); ?>
								<br /><strong><?php _e( 'Note:', 'woocommerce-delivery-notes' ); ?></strong>
								<?php _e( 'The Logo will be resized when it is bigger than 320px &times; 320px.', 'woocommerce-delivery-notes' ); ?>
							</span>
						</td>
					</tr>
					<tr>
						<th>
							<label for="<?php echo WooCommerce_Delivery_Notes::$plugin_prefix; ?>custom_company_name"><?php _e( 'Company/Shop Name', 'woocommerce-delivery-notes' ); ?></label>
						</th>
						<td>
							<textarea name="<?php echo WooCommerce_Delivery_Notes::$plugin_prefix; ?>custom_company_name" rows="2" class="large-text"><?php echo wp_kses_stripslashes( get_option( WooCommerce_Delivery_Notes::$plugin_prefix . 'custom_company_name' ) ); ?></textarea>
							<span class="description">
								<?php _e( 'Your company/shop name for the Delivery Note.', 'woocommerce-delivery-notes' ); ?>
								<br /><strong><?php _e( 'Note:', 'woocommerce-delivery-notes' ); ?></strong>
								<?php _e( 'Leave blank to use the default Website/ Blog title defined in WordPress settings.', 'woocommerce-delivery-notes' ); ?>
							</span>
						</td>
					</tr>
					<tr>
						<th>
							<label for="<?php echo WooCommerce_Delivery_Notes::$plugin_prefix; ?>company_address"><?php _e( 'Company/Shop Address', 'woocommerce-delivery-notes' ); ?></label>
						</th>
						<td>
							<textarea name="<?php echo WooCommerce_Delivery_Notes::$plugin_prefix; ?>company_address" rows="5" class="large-text"><?php echo wp_kses_stripslashes( get_option( WooCommerce_Delivery_Notes::$plugin_prefix . 'company_address' ) ); ?></textarea>
							<span class="description">
								<?php _e( 'The postal address of the company/shop, which gets printed right of the company/shop name, above the order listings.', 'woocommerce-delivery-notes' ); ?>
								<br /><strong><?php _e( 'Note:', 'woocommerce-delivery-notes' ); ?></strong>
								<?php _e('Leave blank to not print an address.', 'woocommerce-delivery-notes' ); ?>
							</span>
						</td>
					</tr>
					<tr>
						<th>
							<label for="<?php echo WooCommerce_Delivery_Notes::$plugin_prefix; ?>personal_notes"><?php _e( 'Personal Notes', 'woocommerce-delivery-notes' ); ?></label>
						</th>
						<td>
							<textarea name="<?php echo WooCommerce_Delivery_Notes::$plugin_prefix; ?>personal_notes" rows="5" class="large-text"><?php echo wp_kses_stripslashes( get_option( WooCommerce_Delivery_Notes::$plugin_prefix . 'personal_notes' ) ); ?></textarea>
							<span class="description">
								<?php _e( 'Add some personal notes, or season greetings or whatever (e.g. Thank You for Your Order!, Merry Christmas!, etc.).', 'woocommerce-delivery-notes' ); ?>
								<br /><strong><?php _e( 'Note:', 'woocommerce-delivery-notes' ); ?></strong>
								<?php _e('Leave blank to not print any personal notes.', 'woocommerce-delivery-notes' ); ?>
							</span>
						</td>
					</tr>
					<tr>
						<th>
							<label for="<?php echo WooCommerce_Delivery_Notes::$plugin_prefix; ?>policies_conditions"><?php _e( 'Returns Policy, Conditions, etc.:', 'woocommerce-delivery-notes' ); ?></label>
						</th>
						<td>
							<textarea name="<?php echo WooCommerce_Delivery_Notes::$plugin_prefix; ?>policies_conditions" rows="5" class="large-text"><?php echo wp_kses_stripslashes( get_option( WooCommerce_Delivery_Notes::$plugin_prefix . 'policies_conditions' ) ); ?></textarea>
							<span class="description">
								<?php _e( 'Here you can add some more policies, conditions etc. For example add a returns policy in case the client would like to send back some goods. In some countries (e.g. in the European Union) this is required so please add any required info in accordance with the statutory regulations.', 'woocommerce-delivery-notes' ); ?>
								<br /><strong><?php _e( 'Note:', 'woocommerce-delivery-notes' ); ?></strong> 
								<?php _e('Leave blank to not print any policies or conditions.', 'woocommerce-delivery-notes' ); ?>
							</span>
						</td>
					</tr>
					<tr>
						<th>
							<label for="<?php echo WooCommerce_Delivery_Notes::$plugin_prefix; ?>footer_imprint"><?php _e( 'Footer Imprint', 'woocommerce-delivery-notes' ); ?></label>
						</th>
						<td>
							<textarea name="<?php echo WooCommerce_Delivery_Notes::$plugin_prefix; ?>footer_imprint" rows="5" class="large-text"><?php echo wp_kses_stripslashes( get_option( WooCommerce_Delivery_Notes::$plugin_prefix . 'footer_imprint' ) ); ?></textarea>
							<span class="description">
								<?php _e( 'Add some further footer imprint, copyright notes etc. to get the printed sheets a bit more branded to your needs.', 'woocommerce-delivery-notes' ); ?>
								<br /><strong><?php _e( 'Note:', 'woocommerce-delivery-notes' ); ?></strong> 
								<?php _e('Leave blank to not print a footer.', 'woocommerce-delivery-notes' ); ?>
							</span>
						</td>
					</tr>
				</tbody>
			</table>
			<h3><?php _e( 'Preview Options', 'woocommerce-delivery-notes' ); ?></h3>
			<table class="form-table">
				<tbody>	
					<tr>
						<th>
							<?php _e( 'Preview opens', 'woocommerce-delivery-notes' ); ?>
						</th>
						<td>
							<input name="<?php echo WooCommerce_Delivery_Notes::$plugin_prefix; ?>open_print_window" type="hidden" value="no" />
							<label for="<?php echo WooCommerce_Delivery_Notes::$plugin_prefix; ?>open_print_window"><input name="<?php echo WooCommerce_Delivery_Notes::$plugin_prefix; ?>open_print_window" type="checkbox" value="yes" <?php checked( get_option( WooCommerce_Delivery_Notes::$plugin_prefix . 'open_print_window' ), 'yes' );?> /> <?php _e( 'Start printing when the preview page opens', 'woocommerce-delivery-notes' ); ?></label>
						</td>
					</tr>
				</tbody>
			</table>
			<h3><?php _e( 'Order Numbering Options', 'woocommerce-delivery-notes' ); ?></h3>
			<table class="form-table">
				<tbody>		
					<tr>
						<th>
							<label for="<?php echo WooCommerce_Delivery_Notes::$plugin_prefix; ?>before_order_number"><?php _e( 'Before order number', 'woocommerce-delivery-notes' ); ?></label>
						</th>
						<td>
							<input name="<?php echo WooCommerce_Delivery_Notes::$plugin_prefix; ?>before_order_number" type="text" value="<?php echo wp_kses_stripslashes( get_option( WooCommerce_Delivery_Notes::$plugin_prefix . 'before_order_number' ) ); ?>" />
							<span class="description"><?php _e( 'This text will be placed before the order number ie. "YOUR-TEXT123".', 'woocommerce-delivery-notes' ); ?></span>
						</td>
					</tr>
					<tr>
						<th>
							<label for="<?php echo WooCommerce_Delivery_Notes::$plugin_prefix; ?>after_order_number"><?php _e( 'After order number', 'woocommerce-delivery-notes' ); ?></label>
						</th>
						<td>
							<input name="<?php echo WooCommerce_Delivery_Notes::$plugin_prefix; ?>after_order_number" type="text" value="<?php echo wp_kses_stripslashes( get_option( WooCommerce_Delivery_Notes::$plugin_prefix . 'after_order_number' ) ); ?>" />
							<span class="description"><?php _e( 'This text will be placed after the order number ie. "123YOUR-TEXT".', 'woocommerce-delivery-notes' ); ?></span>
						</td>
					</tr>
					<tr>
						<th>
							<label for="<?php echo WooCommerce_Delivery_Notes::$plugin_prefix; ?>order_number_offset"><?php _e( 'Number Offset', 'woocommerce-delivery-notes' ); ?></label>
						</th>
						<td>
							<?php $value = intval( get_option( WooCommerce_Delivery_Notes::$plugin_prefix . 'order_number_offset' ) ); ?>
							<input name="<?php echo WooCommerce_Delivery_Notes::$plugin_prefix; ?>order_number_offset" type="text" value="<?php echo ( is_int( $value ) ? wp_kses_stripslashes( $value ) : '' ); ?>" />
							<span class="description"><?php _e( 'This adds an offset to the WooCommerce order number. Helpful for a contiguous numbering.', 'woocommerce-delivery-notes' ); ?>
							<strong><?php _e( 'Note:', 'woocommerce-delivery-notes' ); ?></strong> 
							<?php _e( 'Only positive or negative numbers are allowed.', 'woocommerce-delivery-notes' ); ?></span>
						</td>
					</tr>
				</tbody>
			</table>
			
			<input type="hidden" name="<?php echo $this->hidden_submit; ?>" value="submitted">
			<?php
		}
		
		/**
		 * Save all settings
		 *
		 * @since 1.0
		 * @version 1.1
		 */
		public function save_settings_page() {
			if ( isset( $_POST[ $this->hidden_submit ] ) && $_POST[ $this->hidden_submit ] == 'submitted' ) {
				foreach ( $_POST as $key => $value ) {
					if ( $key != $this->hidden_submit && strpos( $key, WooCommerce_Delivery_Notes::$plugin_prefix ) !== false ) {
						if ( empty( $value ) ) {
							delete_option( $key );
						} else {
							if ( get_option( $key ) && get_option( $key ) != $value ) {
								update_option( $key, $value );
							}
							else {
								add_option( $key, $value );
							}
						}
					}
				}
			}
		}
	
	}
	
}
