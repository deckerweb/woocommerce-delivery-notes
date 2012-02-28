<?php

/**
 * Writepanel class
 *
 * @since 1.0
 */
if ( !class_exists( 'WooCommerce_Delivery_Notes_Writepanel' ) ) {

	class WooCommerce_Delivery_Notes_Writepanel extends WooCommerce_Delivery_Notes_Base {

		/**
		 * Constructor
		 *
		 * @since 1.0
		 */
		public function __construct() {
			parent::__construct();

			if ( $this->is_woocommerce_activated() ) {
				add_action( 'admin_init', array( $this, 'load_all_hooks' ) );
			}
		}

		/**
		 * Load the admin hooks
		 *
		 * @since 1.0
		 */
		public function load_all_hooks() {	
			add_filter( 'plugin_row_meta', array( $this, 'add_support_links' ), 10, 2 );			
			add_action( 'add_meta_boxes_shop_order', array( $this, 'add_box' ) );
		}

		/**
		 * Add various support links to plugin page
		 *
		 * @since 1.0
		 */
		public function add_support_links( $links, $file ) {
			if ( !current_user_can( 'install_plugins' ) ) {
				return $links;
			}
		
			if ( $file == $this->plugin_basefile ) {
				$links[] = '<a href="http://wordpress.org/extend/plugins/woocommerce-delivery-notes/faq/" target="_new" title="' . __( 'FAQ', 'woocommerce-delivery-notes' ) . '">' . __( 'FAQ', 'woocommerce-delivery-notes' ) . '</a>';
				$links[] = '<a href="http://wordpress.org/tags/woocommerce-delivery-notes?forum_id=10" target="_new" title="' . __( 'Support', 'woocommerce-delivery-notes' ) . '">' . __( 'Support', 'woocommerce-delivery-notes' ) . '</a>';
				$links[] = '<a href="' . __( 'http://genesisthemes.de/en/donate/', 'woocommerce-delivery-notes' ) . '" target="_new" title="' . __( 'Donate', 'woocommerce-delivery-notes' ) . '">' . __( 'Donate', 'woocommerce-delivery-notes' ) . '</a>';
			}
		
			return $links;
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
					<td><a href="<?php echo $this->plugin_url; ?>woocommerce-delivery-notes-print.php?order=<?php echo $post_id; ?>" id="print_delivery_note" class="button button-primary" target="_blank"><?php _e( 'View &amp; Print Delivery Note', 'woocommerce-delivery-notes' ); ?></a></td>
				</tr>
			</table>
			<?php
		}
		
	}
	
} 

?>