<?php
/**
 * Load help tabs for admin settings page and support links on plugins listing page.
 *
 * @package    WooCommerce Delivery Notes
 * @subpackage Help
 * @author     David Decker - DECKERWEB
 * @copyright  Copyright 2011-2012, David Decker - DECKERWEB
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL v3.0 (or later)
 * @link       http://genesisthemes.de/en/wp-plugins/woocommerce-delivery-notes/
 * @link       http://twitter.com/#!/deckerweb
 *
 * @since 1.0
 */

add_filter( 'plugin_row_meta', 'ddw_wcdn_plugin_links', 10, 2 );
/**
 * Add various support links to plugin page
 *
 * @since 1.0
 *
 * @param  $wcdn_links
 * @param  $wcdn_file
 * @return strings plugin links
 */
function ddw_wcdn_plugin_links( $wcdn_links, $wcdn_file ) {

	if ( !current_user_can( 'install_plugins' ) )
		return $wcdn_links;

	if ( $wcdn_file == WCDN_PLUGIN_BASEDIR . '/woocommerce-delivery-notes.php' ) {
		$wcdn_links[] = '<a href="http://wordpress.org/extend/plugins/woocommerce-delivery-notes/faq/" target="_new" title="' . __( 'FAQ', 'woocommerce-delivery-notes' ) . '">' . __( 'FAQ', 'woocommerce-delivery-notes' ) . '</a>';
		$wcdn_links[] = '<a href="http://wordpress.org/tags/woocommerce-delivery-notes?forum_id=10" target="_new" title="' . __( 'Support', 'woocommerce-delivery-notes' ) . '">' . __( 'Support', 'woocommerce-delivery-notes' ) . '</a>';
		$wcdn_links[] = '<a href="' . __( 'http://genesisthemes.de/en/donate/', 'woocommerce-delivery-notes' ) . '" target="_new" title="' . __( 'Donate', 'woocommerce-delivery-notes' ) . '">' . __( 'Donate', 'woocommerce-delivery-notes' ) . '</a>';
	}

	return $wcdn_links;
}


add_action( 'admin_menu', 'ddw_wcdn_help_tab_init', 15 );
/**
 * Load help tab on settings page
 *
 * @since 1.0
 *
 * global $_wcdn_settings_pagehook
 */
function ddw_wcdn_help_tab_init() {

	// Pagehook for settings page
	global $_wcdn_settings_pagehook;

	// Load help tabs for WordPress 3.3 and higher
	add_action( 'load-'.$_wcdn_settings_pagehook, 'ddw_wcdn_help_tabs' );
}


/**
 * Set up the help tab titles for the settings page - for WordPress 3.3 and higher
 *
 * @since 1.0
 *
 * global $_wcdn_settings_pagehook
 */
function ddw_wcdn_help_tabs() {

	// Pagehook for settings page
	global $_wcdn_settings_pagehook;

	// Check current admin screen
	$screen = get_current_screen();

	// Don't load help tab system prior WordPress 3.3
	if( !class_exists( 'WP_Screen' ) || !$screen || $screen->id != $_wcdn_settings_pagehook )
		return;

	// Create arrays with help tab titles
	$screen->add_help_tab(array(
		'id' => 'wcdn-usage',
		'title' => __( 'What the Plugin Does', 'woocommerce-delivery-notes' ),
		'content' => ddw_wcdn_help_tab_content( 'wcdn-usage' )
	) );
	$screen->add_help_tab(array(
		'id' => 'wcdn-faq',
		'title' => __( 'FAQ - Frequently Asked Questions', 'woocommerce-delivery-notes' ),
		'content' => ddw_wcdn_help_tab_content( 'wcdn-faq' )
	) );
	$screen->add_help_tab(array(
		'id' => 'wcdn-support-donation-rating-tips',
		'title' => __( 'Support - Donations - Rating &amp; Tips', 'woocommerce-delivery-notes' ),
		'content' => ddw_wcdn_help_tab_content( 'wcdn-support-donation-rating-tips' )
	) );
	$screen->add_help_tab(array(
		'id' => 'wcdn-autor-license',
		'title' => __( 'Author - License', 'woocommerce-delivery-notes' ),
		'content' => ddw_wcdn_help_tab_content( 'wcdn-author-license' )
	) );

	// Create help sidebar
	$screen->set_help_sidebar(
		'<p><strong>' . __( 'Feedback and more about the Author', 'woocommerce-delivery-notes' ) . '</strong></p>'.
		'<p><a href="' . __( 'http://genesisthemes.de/en/', 'woocommerce-delivery-notes' ) . '" target="_blank" title="' . __( 'Website', 'woocommerce-delivery-notes' ) . '">' . __( 'Website', 'woocommerce-delivery-notes' ) . '</a></p>'.
		'<p>' . __( 'Social:', 'woocommerce-delivery-notes' ) . '<br /><a href="http://twitter.com/#!/deckerweb" target="_blank">' . __( 'Twitter', 'woocommerce-delivery-notes' ) . '</a> | <a href="http://www.facebook.com/deckerweb.service" target="_blank">' . __( 'Facebook', 'woocommerce-delivery-notes' ) . '</a> | <a href="http://deckerweb.de/gplus" target="_blank">' . __( 'Google+', 'woocommerce-delivery-notes' ) . '</a></p>'.
		'<p><a href="http://profiles.wordpress.org/users/daveshine/" target="_blank">' . __( 'at WordPress.org', 'woocommerce-delivery-notes' ) . '</a></p>'
	);

}


/**
 * Add the actual help tabs content for the settings page - for WordPress 3.3 and higher
 *
 * @since 1.0
 *
 * @return help tab strings
 */
function ddw_wcdn_help_tab_content( $tab = 'wcdn-usage' ) {	// Tab general info
	if ( $tab == 'wcdn-usage' ) {

		ob_start();
			echo '<h3>' . __( 'Plugin: WooCommerce Delivery Notes', 'woocommerce-delivery-notes' ) . '</h3>';

			echo '<h4>' . __( 'What the Plugin Does', 'woocommerce-delivery-notes' ) . '</h4>';
			echo '<p>' . __( 'This plugin enables you to add a simple Delivery Note page for printing for your orders in WooCommerce shop plugin. You can add your company postal address, further add personal notes, refund or other policies and a footer note/branding. This helps speed up your daily shop and order management. In some countries (e.g. in the European Union) it is also required to advice the customer with proper refund policies so this little plugin might help you a bit with that too.', 'woocommerce-delivery-notes' ) . '</p>';
			echo '<p>' . sprintf( __( 'Just look under <a href="%1$s">WooCommerce > Orders</a> and there go to a single order view. On the right side you will see the Delivery Note meta box. Click and you get the delivery Note printing page. Yes, it is that easy :-).', 'woocommerce-delivery-notes' ), admin_url( 'edit.php?post_type=shop_order' ) ) . '</p>';

		return ob_get_clean();

	} elseif ( $tab == 'wcdn-faq' ) {	// Tab FAQ area

		ob_start();
			echo '<h3>' . __( 'Plugin: WooCommerce Delivery Notes', 'woocommerce-delivery-notes' ) . '</h3>';

			echo '<h4>' . __( 'FAQ - Frequently Asked Questions', 'woocommerce-delivery-notes' ) . '</h4>';

			// First FAQ entry
			echo '<p><em><strong>' . __( 'Question:', 'woocommerce-delivery-notes' ) . '</strong> ';
			echo __( 'Can I use a Custom Template for the printing page?', 'woocommerce-delivery-notes' ) . '</em><br />';
			echo '<strong>' . __( 'Answer:', 'woocommerce-delivery-notes' ) . '</strong> ';
			echo __( 'If you want to use your own template then all you need to do is copy the <code>/wp-content/plugins/woocommerce-delivery-notes/delivery-note-template</code> folder and paste it inside your <code>/wp-content/themes/your-theme-name/woocommerce</code> folder (if not there just create it). The folder from the plugin comes with the default template and the basic CSS stylesheet file. You can modifiy this to fit your own needs.', 'woocommerce-delivery-notes' );
			echo '<br />' . __( 'Note: This works with both single themes and child themes (if you use some framework like Genesis). If your current active theme is a child theme put the custom folder there! (e.g. <code>/wp-content/themes/your-child-theme-name/woocommerce</code>)', 'woocommerce-delivery-notes' ) . '</p>';

			// Second FAQ entry - show this one only for admins
			if ( current_user_can( 'install_plugins' ) ) {
				echo '<p><em><strong>' . __( 'Question:', 'woocommerce-delivery-notes' ) . '</strong> ';
				echo __( 'What Template Functions can I use?', 'woocommerce-delivery-notes' ) . '</em><br />';
				echo '<strong>' . __( 'Answer:', 'woocommerce-delivery-notes' ) . '</strong> ';
				echo __( 'Arbitrary php code and all WordPress functions are available in the template. Besides that there are many Delivery Notes specific template functions. Open the <code>woocommerce-delivery-notes/wcdn-print.php</code> file to see all available functions.', 'woocommerce-delivery-notes' );
				echo '<br />' . __( 'Important note: This is only intended for developers who know what they do! Please be careful with adding any code/functions! The default template and functions should fit most use cases.', 'woocommerce-delivery-notes' ) . '</p>';
			}

		return ob_get_clean();

	} elseif ( $tab == 'wcdn-support-donation-rating-tips' ) {	// Tab support, donation, rating, tips

		ob_start();
			echo '<h3>' . __( 'Plugin: WooCommerce Delivery Notes', 'woocommerce-delivery-notes' ) . '</h3>';

			echo '<h4>' . __( 'Support - Donations - Rating &amp; Tips', 'woocommerce-delivery-notes' ) . '</h4>';
			echo '<p>&bull; ' . sprintf( __( '<strong>Donations:</strong> Please %1$sdonate to support the further maintenance and development%2$s of the plugin. <em>Thank you in advance!</em>', 'woocommerce-delivery-notes' ), '<a href="' . __( 'http://genesisthemes.de/en/donate/', 'woocommerce-delivery-notes' ) . '" target="_new">', '</a>' ) . '</p>';
			echo '<p>&bull; ' . sprintf( __( '<strong>Support:</strong> Done via %1$sWordPress.org plugin page support forum%2$s. - Maybe I will setup my own support forum in the future, though.', 'woocommerce-delivery-notes' ), '<a href="http://wordpress.org/tags/woocommerce-delivery-notes?forum_id=10" target="_new" title="WordPress.org Plugin Support Forum ...">', '</a>' ) . '</p>';
			echo '<p>&bull; ' . sprintf( __( '<strong>Rating &amp; Tips:</strong> If you like the plugin please %1$srate at WordPress.org%2$s with 5 stars. <em>Thank you!</em> &mdash; %3$sMore plugins for WordPress by DECKERWEB%2$s', 'woocommerce-delivery-notes' ), '<a href="http://wordpress.org/extend/plugins/genesis-layout-extras/" target="_new">', '</a>', '<a href="http://wordpress.org/extend/plugins/tags/deckerweb" target="_new" title="DECKERWEB WordPress Plugins ...">' ) . '</p>';

		return ob_get_clean();

	} elseif ( $tab == 'wcdn-author-license' ) {	// Tab author and license

		ob_start();
			echo '<h3>' . __( 'Plugin: WooCommerce Delivery Notes', 'woocommerce-delivery-notes' ) . '</h3>';

			echo '<h4>' . __( 'Author - License', 'woocommerce-delivery-notes' ) . '</h4>';
			echo '<p>&bull; ' . sprintf( __( '<strong>Author:</strong> David Decker of %1$sdeckerweb.de%2$s and %3$sGenesisThemes%2$s - Join me at %4$sTwitter%2$s, %5$sFacebook%2$s and %6$sGoogle Plus%2$s :-)', 'woocommerce-delivery-notes' ), '<a href="http://deckerweb.de/" target="_new">', '</a>', '<a href="http://genesisthemes.de/en/" target="_new">', '<a href="http://twitter.com/#!/deckerweb" target="_new" title="Twitter @deckerweb ...">', '<a href="http://www.facebook.com/deckerweb.service" target="_new" title="deckerweb Facebook ...">', '<a href="http://deckerweb.de/gplus" target="_new" title="deckerweb Google Plus ...">' ) . '</p>';
	echo '<p>&bull; ' . sprintf( __( '<strong>License:</strong> GPL v3 - %1$sMore info on the GPL license ...%2$s', 'woocommerce-delivery-notes' ), '<a href="http://www.opensource.org/licenses/gpl-license.php" target="_new" title="GPL ...">', '</a>' ) . '</p>';

		return ob_get_clean();

	}  // end elseif

}  // end of function ddw_wcdn_help_tab_content
