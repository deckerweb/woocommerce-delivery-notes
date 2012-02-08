<?php
/**
 * Load all available data for the Delivery Notes printing page.
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
 * Load Wordpress to use its functions
 *
 * @since 1.0
 */
if ( !defined( 'ABSPATH' ) ) {
	require_once '../../../wp-load.php';
}


/**
 * Check the current user capabilities
 *
 * @since 1.0
 */
if ( !current_user_can( 'manage_options' ) || !$_GET['order'] ) {
	wp_die( __( 'You do not have sufficient permissions to access this page.', 'woocommerce-delivery-notes' ) );
}


/**
 * Load the plugin's classes
 *
 * @since 1.0
 */
require_once 'wcdn-classes.php';


/**
 * Create plugin instance
 *
 * @since 1.0
 */
$wcdn_print = new WooCommerce_Delivery_Notes_Print();


/**
 * Return Delivery Note template url
 *
 * @since 1.0
 */
if ( !function_exists( 'wcdn_template_url' ) ) {
	function wcdn_template_url() {
		global $wcdn_print;
		return $wcdn_print->template_dir_url;
	}
}


/**
 * Return default title name of Delivery Note (= default Website Name)
 *
 * @since 1.0
 */
if ( !function_exists( 'wcdn_company_name' ) ) {
	function wcdn_company_name() {
		return get_bloginfo( 'name' );
	}
}


/**
 * Return custom title name of Delivery Note (= custom title)
 *
 * @since 1.0
 *
 * @global $wcdn_print
 * @return string company name
 */
if ( !function_exists( 'wcdn_custom_company_name' ) ) {
	function wcdn_custom_company_name() {
		global $wcdn_print;
		return wpautop( wp_kses_stripslashes( $wcdn_print->get_setting( 'custom_company_name' ) ) );
	}
}


/**
 * Return shop/company info if provided
 *
 * @since 1.0
 *
 * @global $wcdn_print
 * @return string company address
 */
if (!function_exists( 'wcdn_company_info' ) ) {
	function wcdn_company_info() {
		global $wcdn_print;
		return wpautop( wptexturize( $wcdn_print->get_setting( 'company_address' ) ) );
	}
}


/**
 * Return shipping name
 *
 * @since 1.0
 *
 * @global $wcdn_print
 * @return string shipping name
 */
if ( !function_exists( 'wcdn_shipping_name' ) ) {
	function wcdn_shipping_name() {
		global $wcdn_print;
		return $wcdn_print->get_order( $_GET['order'] )->shipping_first_name . ' ' . $wcdn_print->get_order( $_GET['order'] )->shipping_last_name;
	}
}


/**
 * Return shipping company
 *
 * @since 1.0
 *
 * @global $wcdn_print
 * @return string shipping company
 */
if ( !function_exists( 'wcdn_shipping_company' ) ) {
	function wcdn_shipping_company() {
		global $wcdn_print;
		return $wcdn_print->get_order( $_GET['order'] )->shipping_company;
	}
}


/**
 * Return shipping address 1
 *
 * @since 1.0
 *
 * @global $wcdn_print
 * @return string shipping address
 */
if ( !function_exists( 'wcdn_shipping_address_1' ) ) {
	function wcdn_shipping_address_1() {
		global $wcdn_print;
		return $wcdn_print->get_order( $_GET['order'] )->shipping_address_1;
	}
}


/**
 * Return shipping address 2
 *
 * @since 1.0
 *
 * @global $wcdn_print
 * @return string shipping address 2
 */
if ( !function_exists( 'wcdn_shipping_address_2' ) ) {
	function wcdn_shipping_address_2() {
		global $wcdn_print;
		return $wcdn_print->get_order( $_GET['order'] )->shipping_address_2;
	}
}


/**
 * Return shipping city
 *
 * @since 1.0
 *
 * @global $wcdn_print
 * @return string shipping city
 */
if ( !function_exists( 'wcdn_shipping_city' ) ) {
	function wcdn_shipping_city() {
		global $wcdn_print;
		return $wcdn_print->get_order( $_GET['order'] )->shipping_city;
	}
}


/**
 * Return shipping state
 *
 * @since 1.0
 *
 * @global $wcdn_print
 * @return string shipping state
 */
if ( !function_exists( 'wcdn_shipping_state' ) ) {
	function wcdn_shipping_state() {
		global $wcdn_print;
		return $wcdn_print->get_order( $_GET['order'] )->shipping_state;
	}
}


/**
 * Return shipping postcode
 *
 * @since 1.0
 *
 * @global $wcdn_print
 * @return string shipping postcode
 */
if ( !function_exists( 'wcdn_shipping_postcode' ) ) {
	function wcdn_shipping_postcode() {
		global $wcdn_print;
		return $wcdn_print->get_order( $_GET['order'] )->shipping_postcode;
	}
}


/**
 * Return shipping country
 *
 * @since 1.0
 *
 * @global $wcdn_print
 * @return string shipping country
 */
if ( !function_exists( 'wcdn_shipping_country' ) ) {
	function wcdn_shipping_country() {
		global $wcdn_print;
		return $wcdn_print->get_order( $_GET['order'] )->shipping_country;
	}
}


/**
 * Return shipping notes
 *
 * @since 1.0
 *
 * @global $wcdn_print
 * @return string shipping notes
 */
if ( !function_exists( 'wcdn_shipping_notes' ) ) {
	function wcdn_shipping_notes() {
		global $wcdn_print;
		return wpautop( wptexturize( $wcdn_print->get_order( $_GET['order'] )->customer_note ) );
	}
}


/**
 * Return order id
 *
 * @since 1.0
 *
 * @global $wcdn_print
 * @return string order id
 */
if ( !function_exists( 'wcdn_order_number' ) ) {
	function wcdn_order_number() {
		return $_GET['order'];
	}
}


/**
 * Return the order date
 *
 * @since 1.0
 *
 * @global $wcdn_print
 * @return string order date
 */
if ( !function_exists( 'wcdn_order_date')) {
	function wcdn_order_date() {
		global $wcdn_print;
		$order = $wcdn_print->get_order( $_GET['order'] );
		return date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) );
	}
}


/**
 * Return the order items
 *
 * @since 1.0
 *
 * @global $wcdn_print
 * @return strings order items
 */
if ( !function_exists( 'wcdn_get_order_items' ) ) {
	function wcdn_get_order_items() {
		global $wcdn_print;
		return $wcdn_print->get_order_items( $_GET['order'] );
	}
}


/**
 * Return the order items price
 *
 * @since 1.0
 *
 * @global $wcdn_print
 * @return string items price
 */
if ( !function_exists( 'wcdn_format_price' ) ) {
	function wcdn_format_price( $price, $tax_rate = 0 ) {
		$tax_included = ( $tax_rate > 0 ) ? 0 : 1;
		return woocommerce_price( ( ( $price / 100 ) * $tax_rate ) + $price, array( 'ex_tax_label' => $tax_included ) );
	}
}


/**
 * Return the order subtotal
 *
 * @since 1.0
 *
 * @global $wcdn_print
 * @return string order subtotal
 */
if ( !function_exists( 'wcdn_order_subtotal' ) ) {
	function wcdn_order_subtotal() {
		global $wcdn_print;
		return $wcdn_print->get_order( $_GET['order'] )->get_subtotal_to_display();
	}
}


/**
 * Return the order tax
 *
 * @since 1.0
 *
 * @global $wcdn_print
 * @return string order tax
 */
if ( !function_exists( 'wcdn_order_tax' ) ) {
	function wcdn_order_tax() {
		global $wcdn_print;
		return woocommerce_price( $wcdn_print->get_order( $_GET['order'] )->get_total_tax() );
	}
}


/**
 * Return the order shipping cost
 *
 * @since 1.0
 *
 * @global $wcdn_print
 * @return string order shipping cost
 */
if ( !function_exists( 'wcdn_order_shipping' ) ) {
	function wcdn_order_shipping() {
		global $wcdn_print;
		return $wcdn_print->get_order( $_GET['order'] )->get_shipping_to_display();
	}
}


/**
 * Return the order discount
 *
 * @since 1.0
 *
 * @global $wcdn_print
 * @return string order discount
 */
if ( !function_exists( 'wcdn_order_discount' ) ) {
	function wcdn_order_discount() {
		global $wcdn_print;
		return woocommerce_price( $wcdn_print->get_order( $_GET['order'] )->order_discount );
	}
}


/**
 * Return the order grand total
 *
 * @since 1.0
 *
 * @global $wcdn_print
 * @return string grand total
 */
if ( !function_exists( 'wcdn_order_total' ) ) {
	function wcdn_order_total() {
		global $wcdn_print;
		return woocommerce_price( $wcdn_print->get_order( $_GET['order'] )->order_total );
	}
}


/**
 * Return if the order has a shipping
 *
 * @since 1.0
 *
 * @global $wcdn_print
 * @return boolean
 */
if ( !function_exists( 'wcdn_has_shipping' ) ) {
	function wcdn_has_shipping() {
		global $wcdn_print;
		return ( $wcdn_print->get_order( $_GET['order'] )->order_shipping > 0 ) ? true : false;
	}
}


/**
 * Return if the order has a tax
 *
 * @since 1.0
 *
 * @global $wcdn_print
 * @return boolean
 */
if ( !function_exists( 'wcdn_has_tax' ) ) {
	function wcdn_has_tax() {
		global $wcdn_print;
		return ( $wcdn_print->get_order( $_GET['order'] )->get_total_tax() > 0) ? true : false;
	}
}


/**
 * Return if the order has a discount
 *
 * @since 1.0
 *
 * @global $wcdn_print
 * @return boolean
 */
if ( !function_exists( 'wcdn_has_discount' ) ) {
	function wcdn_has_discount() {
		global $wcdn_print;
		return ( $wcdn_print->get_order( $_GET['order'] )->order_discount > 0 ) ? true : false;
	}
}


/**
 * Return personal notes, season greetings etc.
 *
 * @since 1.0
 *
 * @global $wcdn_print
 * @return string personal notes
 */
if ( !function_exists( 'wcdn_personal_notes' ) ) {
	function wcdn_personal_notes() {
		global $wcdn_print;
		return wpautop( wptexturize( $wcdn_print->get_setting( 'personal_notes' ) ) );
	}
}


/**
 * Return policy for returns
 *
 * @since 1.0
 *
 * @global $wcdn_print
 * @return string policy
 */
if ( !function_exists( 'wcdn_policies_conditions' ) ) {
	function wcdn_policies_conditions() {
		global $wcdn_print;
		return wpautop( wptexturize( $wcdn_print->get_setting( 'policies_conditions' ) ) );
	}
}


/**
 * Return shop/company footer imprint, copyright etc.
 *
 * @since 1.0
 *
 * @global $wcdn_print
 * @return string footer imprint
 */
if ( !function_exists( 'wcdn_footer_imprint' ) ) {
	function wcdn_footer_imprint() {
		global $wcdn_print;
		return wpautop( wptexturize( $wcdn_print->get_setting( 'footer_imprint' ) ) );
	}
}


/*
 * Finally output the template
 *
 * @since 1.0
 */
echo $wcdn_print->get_template_content();
